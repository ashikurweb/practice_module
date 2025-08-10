<x-layout></x-layout>
    <x-slot name="title">Forgot Password</x-slot>

    <div class="container">
        <h1>Forgot Password</h1>
        <form method="POST">
            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </form>
    </div>
</x-layout>