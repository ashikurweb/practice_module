@component('mail::message')
# Hello, {{ $user->name }}

Forgot your password? Don't worry, it happens to the best of us. 😊
Click the button below to reset your password:

@component('mail::button', ['url' => url('reset/'.$user->remember_token), 'color' => 'success'])
Reset Password
@endcomponent

If you didn't request a password reset, no further action is required.

Thanks,
{{ config('app.name') }}
@endcomponent
