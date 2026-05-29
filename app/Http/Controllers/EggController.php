<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class EggController extends Controller
{
    private string $owner = 'reviactyl';
    private string $repo = 'eggs';
    private string $branch = 'main';

    public function index(): JsonResponse
    {
        $data = $this->getEggData();

        if ($data === null) {
            return response()->json([
                'error' => 'Sorry, someone probably ate all eggs?',
            ], 500);
        }

        return response()->json($data);
    }

    public function overview(Request $request): View
    {
        $data = $this->getEggData() ?? [
            'available_nests' => 0,
            'available_eggs' => 0,
            'nests' => [],
            'cached_at' => null,
        ];

        $selectedNest = $request->query('nest');
        $nests = $data['nests'] ?? [];
        $selectedNest = array_key_exists((string) $selectedNest, $nests) ? $selectedNest : null;
        $eggs = collect($nests)
            ->when($selectedNest, function ($collection) use ($selectedNest) {
                return $collection->only($selectedNest);
            })
            ->flatMap(function (array $nest, string $nestName) {
                return collect($nest['eggs'] ?? [])->map(function (array $egg, string $fileName) use ($nestName) {
                    return [
                        'nest' => $nestName,
                        'file' => $fileName,
                        'slug' => $this->eggFileToSlug($fileName),
                        'name' => data_get($egg, 'data.name', $this->eggFileToTitle($fileName)),
                        'description' => data_get($egg, 'data.description'),
                        'image' => data_get($egg, 'data.image'),
                        'author' => data_get($egg, 'data.author'),
                        'download' => $egg['download'] ?? null,
                    ];
                });
            })
            ->values();

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginatedEggs = new LengthAwarePaginator(
            $eggs->forPage($currentPage, $perPage),
            $eggs->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ],
        );

        return view('pages.eggs.index', [
            'data' => $data,
            'nests' => $nests,
            'selectedNest' => $selectedNest,
            'eggs' => $paginatedEggs,
        ]);
    }

    public function show(string $nest, string $egg): View
    {
        $eggData = $this->findEgg($nest, $egg);

        abort_if($eggData === null, 404);

        return view('pages.eggs.show', [
            'nest' => $nest,
            'file' => $eggData['file'],
            'slug' => $egg,
            'egg' => $eggData['egg'],
            'data' => $eggData['egg']['data'] ?? [],
        ]);
    }

    public function download(string $nest, string $egg)
    {
        $eggData = $this->findEgg($nest, $egg);

        abort_if($eggData === null || empty($eggData['egg']['download']), 404);

        $response = Http::get($eggData['egg']['download']);

        abort_unless($response->successful(), 404);

        return response($response->body(), 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $eggData['file'] . '"',
        ]);
    }

    private function getEggData(): ?array
    {
        return Cache::remember('eggs-api-v1', now()->addHour(), function () {
            $apiBase = "https://api.github.com/repos/{$this->owner}/{$this->repo}/contents";

            $response = Http::withHeaders([
                'Accept' => 'application/vnd.github+json',
                'User-Agent' => 'Professional-Egg-Eater',
            ])->get($apiBase);

            if (!$response->successful()) {
                return null;
            }

            $nests = [];
            $availableNests = 0;
            $availableEggs = 0;

            foreach ($response->json() as $item) {
                if (($item['type'] ?? null) !== 'dir') {
                    continue;
                }

                $nestName = $item['name'];
                $availableNests++;

                $nestResponse = Http::withHeaders([
                    'Accept' => 'application/vnd.github+json',
                    'User-Agent' => 'Professional-Egg-Eater',
                ])->get($item['url']);

                if (!$nestResponse->successful()) {
                    continue;
                }

                $eggs = [];
                $eggCount = 0;

                foreach ($nestResponse->json() as $file) {
                    if (
                        ($file['type'] ?? null) !== 'file' ||
                        !str_ends_with($file['name'], '.json')
                    ) {
                        continue;
                    }

                    $eggContent = Http::get($file['download_url'])->json();

                    $eggs[$file['name']] = [
                        'download' => $file['download_url'],
                        'data' => $eggContent,
                    ];

                    $eggCount++;
                    $availableEggs++;
                }

                $nests[$nestName] = [
                    'egg_counts' => $eggCount,
                    'eggs' => $eggs,
                ];
            }

            return [
                'available_nests' => $availableNests,
                'available_eggs' => $availableEggs,
                'nests' => $nests,
                'cached_at' => now()->toISOString(),
            ];
        });
    }

    private function findEgg(string $nest, string $egg): ?array
    {
        $data = $this->getEggData();

        if ($data === null || !isset($data['nests'][$nest])) {
            return null;
        }

        foreach ($data['nests'][$nest]['eggs'] ?? [] as $file => $eggData) {
            if ($this->eggFileToSlug($file) === $egg) {
                return [
                    'file' => $file,
                    'egg' => $eggData,
                ];
            }
        }

        return null;
    }

    private function eggFileToSlug(string $fileName): string
    {
        return str($fileName)
            ->replaceStart('egg-', '')
            ->replaceEnd('.json', '')
            ->toString();
    }

    private function eggFileToTitle(string $fileName): string
    {
        return str($this->eggFileToSlug($fileName))
            ->replace(['-', '_'], ' ')
            ->title()
            ->toString();
    }
}
