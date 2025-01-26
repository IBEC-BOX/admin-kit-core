<x-filament::page>
    <div class="flex flex-col items-center justify-center space-y-4">
        <h1 class="text-2xl font-bold">Срок действия вашего пароля истек</h1>
        <p class="text-gray-600">Чтобы продолжить, пожалуйста, обновите свой пароль. После обновления пароля, вам потребуется перезайти.</p>
        <x-filament-panels::form wire:submit="submit">
            {{ $this->form }}
            <x-filament-panels::form.actions :actions="$this->getFormActions()"/>
        </x-filament-panels::form>
    </div>
</x-filament::page>
