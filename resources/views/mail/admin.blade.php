@component('mail::message')
# Hello {{ $patient_name }},

{!! htmlspecialchars_decode($content) !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent