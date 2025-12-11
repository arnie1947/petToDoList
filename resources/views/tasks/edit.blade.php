<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="description" :value="__('Task Description')" />
                <textarea name="description" id="description" rows="5"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-500">{{ old('description', $task->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mb-4">
                <label>
                    <input type="radio" name="is_completed" value="1"
                        @checked(old('is_completed', $task->is_completed))>
                    Completed
                </label>
                <label class="ml-4">
                    <input type="radio" name="is_completed" value="0"
                        @checked(old('is_completed', !$task->is_completed))>
                    In Progress
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="w-full">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>