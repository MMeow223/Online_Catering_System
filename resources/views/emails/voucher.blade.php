@component('mail::message')
# Vouchers!

Congratulations! You have received a voucher! Please click the button below to claim it. Have a good day!

@component('mail::button', ['url' => ''])
Claim
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
