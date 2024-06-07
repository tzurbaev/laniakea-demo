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
     */
    public function compose(View $view): void
    {
        $view->with('mainMenu', [
            [
                'title' => 'Books',
                'url' => '/',
                'active' => Route::is('books.*'),
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
