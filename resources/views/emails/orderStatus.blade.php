@component('mail::message')
#Your order status has been updated!

The body of your message.

@component('mail::button', ['url' => '']) //navigate to order page
Your Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
