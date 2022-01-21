@component('mail::message')
# Introduction
{{-- <h1>hello {{$client->name}}</h1> --}}
<p>{{$client->pin_code}}</p>


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
