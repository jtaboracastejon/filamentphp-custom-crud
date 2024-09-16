<div>
    <form wire:submit="save">
        {{ $this->form }}
        <br>
        <x-filament::button type="submit">
            Save changes
        </x-filament::button>
    </form>

</div>
