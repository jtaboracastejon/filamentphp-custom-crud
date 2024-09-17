<?php

namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;


/*

Sources [
    https://gist.github.com/pekka/c9c9503b1ddd2c4ed6b762711d2e59af
    https://laraveldaily.com/post/filament-laravel-delete-unused-files-model-updated-deleted]

*/
class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        if ($book->isDirty('cover')) {

            $originalFieldContents = $book->getOriginal('cover');
            $newFieldContents = $book->cover;

            # We attempt to JSON decode the field. If it is an array, this is an indication we have ->multiple() activated
            if (is_array($originalFieldContents)) {
                $originalFieldContentsDecoded = $originalFieldContents;
            } else {
                $originalFieldContentsDecoded = json_decode($originalFieldContents);
            }

            # Clean up empty entries in the resulting array
            if (is_array($originalFieldContentsDecoded)) $originalFieldContentsDecoded = array_filter($originalFieldContentsDecoded);

            # Simple case: one file
            if (!is_array($originalFieldContentsDecoded) or count($originalFieldContentsDecoded) == 0) {
                Storage::disk(name: 'local')->delete($originalFieldContents);
            }

            # Complex case: multiple files
            else {
                foreach ($originalFieldContentsDecoded as $originalFile) {
                    if (trim($originalFile) != null && !in_array($originalFile, $newFieldContents)) {
                        Storage::disk('local')->delete($originalFile);
                    }
                }
            }
        }
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        if (! is_null(value: $book->cover)) {

            $originalFieldContents = $book->getOriginal('cover');

            # We attempt to JSON decode the field. If it is an array, there are multiple files
            if (is_array($originalFieldContents)) {
                $originalFieldContentsDecoded = $originalFieldContents;
            } else {
                $originalFieldContentsDecoded = json_decode($originalFieldContents);
            }

            # Simple case: one file
            if (!is_array($originalFieldContentsDecoded)) {
                Storage::disk('local')->delete($book->cover);
            }

            # Complex case: multiple files
            else {

                foreach ($originalFieldContentsDecoded as $file) {
                    Storage::disk('local')->delete($file);
                }
            }
        }
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
