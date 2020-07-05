<?php
$router = new \Klein\Klein();

/*
* =================================
* |    API
* =================================
*/
$router->with('/api/v1', function () use ($router) {

    /*
    * =================================
    * |    Clients
    * =================================
    */
    $router->respond('GET', '/clients/?', function ($request) {
        $clients = new \App\Http\Controllers\ClientController($request->format);
        $clients->index();

        return;
    });

    $router->respond('POST', '/clients/?', function ($request) {
        $clients = new \App\Http\Controllers\ClientController($request->format);
        $clients->store($request);

        return;
    });

    $router->respond('GET', '/clients/search/?', function ($request) {
        $clients = new \App\Http\Controllers\ClientController($request->format);
        $clients->filter($request);

        return;
    });

    $router->respond('GET', '/clients/[i:id]/?', function ($request) {
        $clients = new \App\Http\Controllers\ClientController($request->format);
        $clients->get($request->id);

        return;
    });

    $router->respond('POST', '/clients/[i:id]/?', function ($request) {
        $clients = new \App\Http\Controllers\ClientController($request->format);
        $clients->update($request->id, $request);

        return;
    });

    $router->respond('DELETE', '/clients/[i:id]/?', function ($request) {
        $clients = new \App\Http\Controllers\ClientController($request->format);
        $clients->destroy($request->id);

        return;
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

    $router->respond('GET', '/client-groups/search/?', function ($request) {
        $client_groups = new \App\Http\Controllers\ClientGroupController($request->format);
        $client_groups->filter($request);

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

/*
* =================================
* |    WEB
* =================================
*/
$router->respond('GET', '/', function ($request, $response, $service) {
    $service->title = 'Urbano Express | Exercise';
    $service->escape = function ($str) {
        return htmlentities($str);
    };

    $service->render(views_path('home.php'));

    return;
});

$router->respond('GET', '/home', function ($request, $response, $service) {
   $service->render(views_path('pages/home.php'));

   return;
});

$router->respond('GET', '/clients', function ($request, $response, $service) {
   $service->render(views_path('pages/clients.php'));

   return;
});

$router->respond('GET', '/clients-groups', function ($request, $response, $service) {
   $service->render(views_path('pages/clients_groups.php'));

   return;
});

$router->dispatch();