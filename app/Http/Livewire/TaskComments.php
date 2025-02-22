<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TaskComment;
use Illuminate\Support\Facades\Auth;

class TaskComments extends Component
{
    public $task_id, $comment, $comments;

    protected $listeners = ['showTaskComments'];

    public function showTaskComments($taskId)
    {
        $this->task_id = $taskId;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = TaskComment::where('task_id', $this->task_id)
            ->latest()
            ->get();
    }

    public function addComment()
    {
        $this->validate([
            'comment' => 'required|min:3',
        ]);

        TaskComment::create([
            'task_id' => $this->task_id,
            'user_id' => Auth::id(),
            'comment' => $this->comment,
        ]);

        $this->reset('comment');
        $this->loadComments();
    }

    public function render()
    {
        return view('livewire.task-comments');
    }
}
