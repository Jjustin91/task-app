<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen py-12 antialiased text-slate-800">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">My Tasks</h1>
            <span class="text-sm font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                {{ $tasks->count() }} total
            </span>
        </div>
        
        <!-- Add Task Form -->
        <form method="POST" action="/tasks" class="flex gap-3 mb-8">
            @csrf
            <input 
                type="text" 
                name="title" 
                class="flex-1 border border-slate-300 rounded-xl px-4 py-3 outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-400" 
                placeholder="What needs to be done?" 
                required
                autocomplete="off"
            >
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition-colors duration-200 shadow-sm shadow-indigo-200">
                Add
            </button>
        </form>
        
        <!-- Task List -->
        <div class="space-y-3">
            @forelse($tasks as $task)
                <div class="group flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-xl hover:bg-indigo-50 hover:border-indigo-100 transition-all duration-200">
                    
                    <div class="flex items-center gap-4">
                        <!-- Toggle Form -->
                        <form method="POST" action="/tasks/{{ $task->id }}" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <button class="flex items-center justify-center w-6 h-6 rounded-full border-2 transition-colors duration-200 {{ $task->is_done ? 'bg-green-500 border-green-500 text-white' : 'border-slate-300 hover:border-indigo-400 text-transparent' }}">
                                <!-- A simple checkmark character -->
                                <span class="text-sm leading-none font-bold pb-[2px]">&#10003;</span>
                            </button>
                        </form>
                        
                        <!-- Task Title -->
                        <span class="text-lg {{ $task->is_done ? 'line-through text-slate-400' : 'text-slate-700 font-medium' }} transition-colors duration-200">
                            {{ $task->title }}
                        </span>
                    </div>
                    
                    <!-- Delete Form (Shows on Hover) -->
                    <form method="POST" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-slate-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-all duration-200 p-2 font-medium text-sm rounded-lg hover:bg-red-50">
                            Delete
                        </button>
                    </form>

                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-10">
                    <p class="text-slate-500 font-medium">You're all caught up!</p>
                    <p class="text-slate-400 text-sm mt-1">Add a task above to get started.</p>
                </div>
            @endforelse
        </div>

    </div>

</body>
</html>