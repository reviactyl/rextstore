<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{
    public string $email;
    public int $size;
    public string $default;
    public string $rating;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $email,
        int $size = 40,
        string $default = 'mp',
        string $rating = 'g'
    ) {
        $this->email = $email;
        $this->size = $size;
        $this->default = $default;
        $this->rating = $rating;
    }

    public function url(): string
    {
        $hash = md5(strtolower(trim($this->email)));

        return "https://www.gravatar.com/avatar/{$hash}?s={$this->size}&d={$this->default}&r={$this->rating}";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.avatar');
    }
}