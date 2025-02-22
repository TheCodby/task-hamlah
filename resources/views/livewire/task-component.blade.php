<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4 text-center text-primary">Task Manager</h3>

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <!-- Task Form -->
        <form wire:submit.prevent="createTask" class="border p-4 rounded bg-light">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <input type="text" wire:model.defer="title" placeholder="Task Title" class="form-control">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <input type="date" wire:model.defer="due_date" class="form-control">
                    @error('due_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-2">
                <textarea wire:model.defer="description" placeholder="Task Description" class="form-control"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <select wire:model.defer="priority" class="form-control">
                        <option value="low">Low Priority</option>
                        <option value="medium">Medium Priority</option>
                        <option value="high">High Priority</option>
                    </select>
                </div>

                <div class="col-md-6 mb-2">
                    <select wire:model.defer="assigned_to" class="form-control">
                        <option value="">Assign Task To...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Add Task</button>
        </form>

        <!-- Filters & Search -->
        <div class="mt-4 d-flex justify-content-between">
            <select wire:model="filter" class="form-control w-50">
                <option value="all">All Tasks</option>
                <option value="complete">Completed</option>
                <option value="incomplete">Incomplete</option>
            </select>
            <input type="text" wire:model="search" placeholder="Search tasks..." class="form-control w-50">
        </div>

        <!-- Task List -->
        <ul class="list-group mt-4">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 {{ $task->completed ? 'text-decoration-line-through' : '' }}">
                            {{ $task->title }} ({{ ucfirst($task->priority) }})
                        </h5>
                        <small>Due: {{ $task->due_date ?? 'No due date' }}</small><br>
                        <small>Assigned to: {{ $task->assignedTo->name ?? 'Not Assigned' }}</small>
                    </div>
                    <div>
                        <button wire:click="toggleTaskStatus({{ $task->id }})" class="btn btn-sm btn-warning">
                            {{ $task->completed ? 'Undo' : 'Complete' }}
                        </button>
                        <button wire:click="deleteTask({{ $task->id }})" class="btn btn-sm btn-danger">Delete</button>
                        <button wire:click="$emit('showTaskComments', {{ $task->id }})" class="btn btn-sm btn-info">Comments</button>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Task Comments Component -->
        @livewire('task-comments')

    </div>
</div>
