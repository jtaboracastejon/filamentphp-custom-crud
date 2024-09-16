<?php

namespace App\Filament\Pages\Books;

use Filament\Actions\Action;
use Filament\Pages\Page;

class CreateBooks extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.books.create-books';

    //Hide the page from the navigation
    protected static bool $shouldRegisterNavigation = false;

    //Modify the URL of the page
    protected static ?string $slug = 'books/create';
}
