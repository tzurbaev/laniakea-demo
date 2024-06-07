<?php

declare(strict_types=1);

namespace App\ViewComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class MainMenuViewComposer
{
    /**
     * Pass main menu to the resources/views/layouts/app.blade.php template.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('mainMenu', [
            [
                'title' => 'Books',
                'url' => '/',
                'active' => false,
            ],
            [
                'title' => 'Authors',
                'url' => '/authors',
                'active' => Route::is('authors.*'),
            ],
            [
                'title' => 'Genres',
                'url' => '/genres',
                'active' => Route::is('genres.*'),
            ],
        ]);
    }
}
