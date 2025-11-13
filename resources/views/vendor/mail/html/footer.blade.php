@php
    $appUrl  = config('app.url');

    $wUrl    = env('MAIL_WHATSAPP_URL', 'https://wa.me/51900000000');
    $iUrl    = env('MAIL_INSTAGRAM_URL', 'https://www.instagram.com/');
    $fUrl    = env('MAIL_FACEBOOK_URL', 'https://www.facebook.com/');

    $wIcon   = env('MAIL_WHATSAPP_ICON',  $appUrl.'/image/svg/whatsapp.svg');
    $iIcon   = env('MAIL_INSTAGRAM_ICON', $appUrl.'/image/svg/instagram.svg');
    $fIcon   = env('MAIL_FACEBOOK_ICON',  $appUrl.'/image/svg/facebook.svg');
@endphp

<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation"
       style="background:#b10000; color:#fff; border-radius:0 0 8px 8px; padding:20px 0;">
<tr>
<td align="center">
    <p style="margin:0 0 12px 0; font-size:13px; color:#fff;">
        Adler • Mochilas de emergencia
    </p>

    <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 12px auto;">
        <tr>
            <td style="padding:0 6px;">
                <a href="{{ $wUrl }}" style="display:inline-block;">
                    <img src="{{ $wIcon }}" alt="WhatsApp" style="height:24px;">
                </a>
            </td>
            <td style="padding:0 6px;">
                <a href="{{ $iUrl }}" style="display:inline-block;">
                    <img src="{{ $iIcon }}" alt="Instagram" style="height:24px;">
                </a>
            </td>
            <td style="padding:0 6px;">
                <a href="{{ $fUrl }}" style="display:inline-block;">
                    <img src="{{ $fIcon }}" alt="Facebook" style="height:24px;">
                </a>
            </td>
        </tr>
    </table>

    <p style="margin-top:4px; font-size:11px; color:#ffdede;">
        {{ date('Y') }} Adler. "Adler Emergency derechos reservados”. Aplican <a href="{{asset('')}}"> terminos y condiciones</a>
    </p>
</td>
</tr>
</table>
</td>
</tr>
