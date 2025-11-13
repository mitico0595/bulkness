@props(['url'])

@php
    $appUrl   = config('app.url');
    $logoUrl  = env('MAIL_LOGO_URL', $appUrl.'/image/adler.png');
    $homeUrl  = $url ?? $appUrl;
@endphp

<tr>
<td class="header" style="padding:25px 0; text-align:center; background:#b10000;">
    <a href="{{ $homeUrl }}" style="display:inline-block;">
        <img src="{{ $logoUrl }}" alt="Adler" style="height:55px; display:block;">
    </a>
</td>
</tr>
