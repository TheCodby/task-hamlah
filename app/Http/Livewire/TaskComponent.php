<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskComponent extends Component
{
    public $tasks, $title, $description, $priority = 'medium', $due_date, $assigned_to;
    public $filter = 'all', $search = '';
    public $users;

    public function mount()
    {
        $this->users = User::where('id', '!=', Auth::id())->get();
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $query = Task::where('user_id', Auth::id())->orWhere('assigned_to', Auth::id());

        if ($this->filter === 'complete') {
            $query->where('completed', true);
        } elseif ($this->filter === 'incomplete') {
            $query->where('completed', false);
        }

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        $this->tasks = $query->orderBy('priority', 'asc')->orderBy('due_date', 'asc')->get();
    }

    public function createTask()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'assigned_to' => $this->assigned_to,
            'completed' => false,
        ]);

        $this->reset(['title', 'description', 'priority', 'due_date', 'assigned_to']);
        $this->loadTasks();
        session()->flash('message', 'Task added successfully!');
    }
}
