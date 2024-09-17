<x-filament-panels::page>
    <x-filament::breadcrumbs :breadcrumbs="[
        '/admin/list-books' => 'Books',
        '' => 'View',
    ]" />
    <livewire:books.view-book :record="$record" />
</x-filament-panels::page>
