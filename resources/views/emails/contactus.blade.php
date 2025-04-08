@component('mail::message')
@component('mail::table')
|              |                                 |
| -------------|---------------------------------|
| Company      | {{ $data->company_name ?? '-' }}|
| Name         | {{ $data->name ?? '-' }}        |
| Location     | {{ $data->location ?? '-' }}    |
| Phone        | {{ $data->phone ?? '-' }}       |
| Message      | {{ $data->message ?? '-' }}     |
@endcomponent
<br>
Thanks, <br>
ssabaccreditation.com

@component('mail::panel')
    This email was sent from ssabaccreditation.com
@endcomponent
@endcomponent
