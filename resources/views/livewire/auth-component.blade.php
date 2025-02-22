<div class="container mt-5">

    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">

            @if ($page === 'login')

                <h2 class="text-center mb-4">Login</h2>

                @if($errorMessage)
                    <div class="alert alert-danger">{{ $errorMessage }}</div>
                @endif

                <form wire:submit.prevent="login">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model.defer="email" class="form-control">

                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" wire:model.defer="password" class="form-control">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-center mt-3">
                    Don't have an account? <a href="#" wire:click.prevent="showRegister">Register</a>
                </p>

            @else

                <h2 class="text-center mb-4">Register</h2>

                <form wire:submit.prevent="register">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model.defer="email" class="form-control">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" wire:model.defer="password" class="form-control">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" wire:model.defer="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>

                <p class="text-center mt-3">
                    Already have an account? <a href="#" wire:click.prevent="showLogin">Login</a>
                </p>

            @endif

        </div>
    </div>

</div>
