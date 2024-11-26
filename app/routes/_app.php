<?php

app()->get('/', 'UserController@index');
app()->get('/user/edit/{id}', 'UserController@edit');


 app()->group('/api/v1/connect-request', function() {
    $controller = 'ConnectRequestControlller';
    app()->get('/', "{$controller}@connectRequest");
    app()->get('/approve', "{$controller}@connectApprove");
    app()->get('/decline', "{$controller}@connectDecline");
    app()->get('/observe', "{$controller}@observeToken");
    app()->get('/finger-print-challenge', "{$controller}@fingerPrintChallengeApi");
    app()->get('/get-requests', "{$controller}@getRequests");
 });

 app()->get('/request-page/', "ConnectRequestControlller@connectRequestPage");

 //api

 app()->group('/api', function(){
    app()->post('/save-webauthn', "UserController@saveauthn");
    app()->get('/get-webauthn', "UserController@getauthn");
 });
 

 app()->get('/device/update-password',"DeviceController@updatePassword");
 app()->post('/device/update-password',"DeviceController@updatePassword");
 app()->get('/device/get-password',"DeviceController@getPassword");


