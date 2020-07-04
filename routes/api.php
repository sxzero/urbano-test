<?php
$router = new \Klein\Klein();

$router->with('/api', function () use ($router) {

    /*
    * =================================
    * |    Clients
    * =================================
    */
    $router->respond('GET', '/clients', function ($request, $response) {
        $clients = new \App\Http\Controllers\ClientController();
        
        $clients->index();
    });

    $router->respond('POST', '/clients', function ($request) {
        $clients = new \App\Http\Controllers\ClientController();

        $clients->store($request);
    });

    /*
    * =================================
    * |    Client Groups
    * =================================
    */
    $router->respond('GET', '/client-groups/?', function ($request) {
        $client_groups = new \App\Http\Controllers\ClientGroupController($request->format);
        $client_groups->index();

        return;
    });

    $router->respond('POST', '/client-groups/?', function ($request) {
        $client_groups = new \App\Http\Controllers\ClientGroupController($request->format);
        $client_groups->store($request);

        return;
    });

    $router->respond('GET', '/client-groups/[i:id]/?', function ($request) {
        $client_groups = new \App\Http\Controllers\ClientGroupController($request->format);
        $client_groups->get($request->id);
        
        return;
    });

    $router->respond('POST', '/client-groups/[i:id]/?', function ($request) {
        $client_groups = new \App\Http\Controllers\ClientGroupController($request->format);
        $client_groups->update($request->id, $request);

        return;
    });

    $router->respond('DELETE', '/client-groups/[i:id]/?', function ($request) {
        $client_groups = new \App\Http\Controllers\ClientGroupController($request->format);
        $client_groups->destroy($request->id);

        return;
    });

});

$router->dispatch();