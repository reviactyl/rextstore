<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PublicProfileController extends Controller
{
    /**
     * Render the public profile page.
     */
    public function show(User $user): View
    {
        return view('pages.profile', [
            'user' => $user,
        ]);
    }
}
