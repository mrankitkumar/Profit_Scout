@component('mail::message')


<p>Hi {{ $user->name }},</p>

<p>We received a request to reset your password for your BloxBay.gg account. Click the button below to proceed:</p>

<div style="text-align: center; margin: 20px 0;">
    @component('mail::button', ['url' => url('resetpassword/' . $user->remember_token)])
    Reset Password
    @endcomponent
</div>
<p>If the button doesn’t work, copy and paste the following link into your browser:</p>
<p style="word-wrap: break-word;">
    <a href="{{ url('resetpassword/' . $user->remember_token) }}">{{ url('resetpassword/' . $user->remember_token) }}</a>
</p>

<p>This link will expire in 24 hours. If you didn’t request this, contact us at <a href="mailto:profitscout.help@gmail.com">bloxbay.help@gmail.com</a>.</p>

Best regards,  
The ProfitScout Team
@endcomponent
