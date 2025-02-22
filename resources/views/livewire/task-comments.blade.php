<div class="container mt-3">
    @if ($task_id)
        <div class="card shadow p-3">
            <h5 class="text-primary">Task Comments</h5>

            <div class="mb-3">
                <textarea wire:model.defer="comment" placeholder="Add a comment..." class="form-control"></textarea>
                @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                <button wire:click="addComment" class="btn btn-success mt-2 w-100">Post Comment</button>
            </div>

            <ul class="list-group mt-3">
                @foreach ($comments as $c)
                    <li class="list-group-item">
                        <strong>{{ $c->user->name }}</strong>: {{ $c->comment }}
                        <span class="text-muted float-end">{{ $c->created_at->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
