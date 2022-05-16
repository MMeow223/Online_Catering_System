@component('mail::message')
# Vouchers!

Congratulations! You have received a voucher! Please click the button below to claim it. Have a good day!

@component('mail::button', ['url' => ' http://127.0.0.1:8000/claim-voucher/VOUCHER1'])
Claim
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
