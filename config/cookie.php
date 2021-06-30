<?php

return[

'COOKIE_SECRITE_KEY'  	=>  '0U1D3V3L0PER%2F@',
'COOKIE_SECURED_SSL'  	=> @($_SERVER['HTTPS'] == 'on') ? true : false ,
'COOKIE_DOMAIN'  		=> str_replace('www', '', $_SERVER['SERVER_NAME']),

];