@component('mail::message')
#Order Placed!

Dear User,

Thank you for shopping on our page, we have received your order confirmation. You could check your order status on our page.
Happy shopping!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/order-status'])
Your Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
