<?php

app()->get('/', function () {
    response()->json(['message' => 'Congrats!! You\'re on Leaf API']);
});


 app()->group('/api/v1/connect-request', function() {
    $controller = 'ConnectRequestControlller';
    app()->get('/', "{$controller}@connectRequest");
    app()->get('/approve', "{$controller}@connectApprove");
    app()->get('/observe', "{$controller}@observeToken");
 });
