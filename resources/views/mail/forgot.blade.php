@component('mail::message')
Hello {{ $user->name }},

<p>You requested a password reset. Click the button below to reset your password.</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>In case you have any issuw recovering your password, plase contact us. </p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
