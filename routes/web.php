<?php


//Router::add('/',function(){
//	echo OULDEVELOPER\LIBRARIES\Security::crypt_pwd('abdellah');
//});

Router::add('/offers','offer@list','get');
Router::add('/offers/list','offer@list','get');

Router::add('/offers/add','offer@add','get');
Router::add('/offers/add','offer@add','post');

Router::add('/offers/delete/{id}',function(){

});


Router::add('/offers/edit/{id}','offer@edit','get');
Router::add('/offers/edit','offer@edit','post');




Router::add('info/add','info@add','get');
Router::add('info/add','info@add','post');

Router::add('info/show','info@default','get');
