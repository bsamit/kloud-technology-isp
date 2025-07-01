@component('mail::message')
# Test Email

This is a test email from {{ config('app.name') }}. If you received this email, your email configuration is working correctly.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
