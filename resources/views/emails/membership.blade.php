@component('mail::message')
# Membership Expiration

Dear user,

Your membership is going to expire after 10 days.
If you wish to renew your membership, please navigate to our website.

@component('mail::button', ['url' => '']) //navigate to membership page
Renw
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
