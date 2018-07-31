@component('mail::message')
Hi {{ $user->name }},

@component('mail::panel')

Id&nbsp;: `{{ $user->email }}`
Password&nbsp;: `{{ $password }}`

@endcomponent

@component('mail::button', ['url' => route("admin.blog.login")])
Login page
@endcomponent


@endcomponent
