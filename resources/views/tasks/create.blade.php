<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div>
                <x-input-label for="description" :value="__('Task Description')" />
                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" maxlength="255" required autofocus />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="w-full">
                    {{ __('Add Task') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>