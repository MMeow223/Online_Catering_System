@component('mail::message')
# Membership Reactivation

Dear user,

You have successfully reactivated membership.
Enjoy shopping!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/customer'])
Back to Page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
