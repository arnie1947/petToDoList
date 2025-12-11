<x-guest-layout>
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
        @endif
        @endauth
    </div>
    @endif
    <div class="py-12">
        <h2 class="font-semibold text-xl pb-3 text-center text-gray-800 leading-tight">
            {{ __('To Do List') }}
        </h2>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-6">
            @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <a href="{{route('tasks.create')}}"
                class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 text-center block">
                Create
            </a>
            <ul>
                @foreach($tasks as $task)
                <li class="flex justify-between items-center p-2 border {{ $task->is_completed ? 'text-green-600' : 'text-black-600' }}">
                    <a class="block w-full" href="{{ route('tasks.edit', $task) }}">{{ Str::limit($task->description, 50) }}</a>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-primary-button class=" text-red-600">Delete</x-primary-button>
                    </form>
                </li>
                @endforeach
            </ul>
            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-guest-layout>