@component('mail::message')
# Raya Promotion!

Raya is here! Feel free to check out our products before the promotions end!

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Promotion
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
