<?php
return [
'continue_url' => env('SUPPORT_CONTINUE_URL', '/'),


'phone' => env('SUPPORT_PHONE'),


// WhatsApp
'whatsapp' => [
'number' => env('SUPPORT_WHATSAPP'),
'message' => env('SUPPORT_WHATSAPP_MESSAGE', 'Hola, vengo desde Soporte del cliente.'),
],


// Facebook
'facebook' => [
'page' => env('SUPPORT_FACEBOOK_PAGE'), // solo el handle
],


// Textos/horarios
'texts' => [
'callcenter_title' => env('SUPPORT_CALLCENTER_TITLE', 'Atención telefónica'),
'callcenter_sched_title' => env('SUPPORT_CALLCENTER_SCHEDULE_TITLE', 'Horario de atención de Centro de llamadas:'),
'callcenter_sched_l1' => env('SUPPORT_CALLCENTER_SCHEDULE_LINE1', 'Martes a Domingo:'),
'callcenter_sched_l2' => env('SUPPORT_CALLCENTER_SCHEDULE_LINE2', '10 a.m. - 5 p.m.'),


'virtual_title' => env('SUPPORT_VIRTUAL_TITLE', 'Canales virtuales:'),
'virtual_sched_l1' => env('SUPPORT_VIRTUAL_SCHEDULE_LINE1', 'Lunes a Domingo:'),
'virtual_sched_l2' => env('SUPPORT_VIRTUAL_SCHEDULE_LINE2', '10 a.m. - 10 p.m.'),
],
];