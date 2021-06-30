<?php

return[

'SESSION_SAVE_PATH'  	=> __SESSION__,
'SESSION_PATH'  		=>  '/',
'SESSION_NAME'  		=>  'OULDEVELOPER',
'SESSION_SECRITE_KEY'  	=>  '0U1D3V3L0PER%2F@',
'SESSION_SECURED_SSL'  	=> @($_SERVER['HTTPS'] == 'on') ? true : false ,
'SESSION_DOMAIN'  		=> str_replace('www', '', $_SERVER['SERVER_NAME']),
'SESSION_MAX_LIFE_TIME' => 0,
'TTL'  					=> 1,

];