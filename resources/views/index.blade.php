
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">



<div class="w-full max-w-md bg-white p-6 rounded-xl shadow-lg">

    <!-- Header -->
    
    <form method="POST" action="{{ route('logout') }}" class="text-right mb-4">
    @csrf
    <button 
        type="submit"
        class="text-sm text-gray-500 hover:text-red-500 transition"
    >
        Logout
    </button>
</form>
    <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">
        Task Manager
    </h1>

    <!-- ADD TASK FORM -->
    <form 
        method="POST" 
        action="/tasks"
        x-data="{ loading: false }"
        @submit="loading = true"
        class="mb-6"
    >
        @csrf

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Add new task
        </label>

        <div class="relative">
            <!-- Icon -->
            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                📝
            </span>

            <input
                type="text"
                name="title"
                placeholder="Type your task..."
                class="w-full pl-10 pr-24 py-2 border rounded-lg
                       bg-white
                       text-gray-900
                       border-gray-300
                       focus:outline-none focus:ring-2 focus:ring-blue-500
                       transition"
            />

            <!-- Submit Button -->
            <button
                type="submit"
                class="absolute right-1 top-1 bottom-1
                       bg-blue-500 hover:bg-blue-600
                       text-white px-4 rounded-md
                       text-sm font-medium transition
                       disabled:opacity-60"
                x-bind:disabled="loading"
            >
                <span x-show="!loading">Add</span>
                <span x-show="loading">...</span>
            </button>
        </div>

        <!-- Validation Error -->
        @error('title')
            <p class="text-sm text-red-500 mt-1 animate-pulse">
                {{ $message }}
            </p>
        @enderror
    </form>

    <!-- TASK LIST -->
    <ul class="space-y-2">
        @forelse ($tasks as $task)
            <li class="flex items-center justify-between bg-gray-50
                       px-3 py-2 rounded-lg">

                <span class="text-gray-800">
                    {{ $task->title }}
                </span>

                <!-- DELETE -->
                <form method="POST" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:text-red-700 text-sm">
                        Delete
                    </button>
                </form>
            </li>
        @empty
            <li class="text-center text-gray-500 text-sm">
                No tasks yet 👀
            </li>
        @endforelse
    </ul>

</div>

<!-- Alpine -->
<script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>