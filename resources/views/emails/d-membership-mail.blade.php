@component('mail::message')
# Membership Deactivation

Dear user,

You have successfully deactivated membership. If you change your mind, you can reactivate membership at our page.
Have a good day!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/customer'])
Back to Page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
