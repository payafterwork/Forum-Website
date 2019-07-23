@component('mail::message')
# One Last Step

Just go and have fun.

@component('mail::button',['url' => url('/register/confirm?token=' . $user->confirmation_token)])
Confirm email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
