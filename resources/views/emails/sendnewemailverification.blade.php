@component('mail::message')
# Introduction

Please click button below to verify your new email.

@component('mail::button', ['url' => $url])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
