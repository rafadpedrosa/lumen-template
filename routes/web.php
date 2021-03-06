<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
// cors problem....
/*
Route::options( '/{any:.*}', [
       'middleware' => ['cors'], function () {
           return response(['status' => 'success']);
       }
   ]
);
*/
/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     @SWG\SecurityScheme(
 *         securityDefinition="api_key",
 *         type="apiKey",
 *         name="Authorization",
 *         in="header",
 *         scopes={"scope": "Description of scope."}
 *     ),
 *     @SWG\Info(title="TODO LIST API", version="0.1",
 *      @SWG\Contact(name="Rafael Pedrosa", url="https://www.rafadpedrosa.com.br"),
 *     )
 * )
 *
 * @SWG\Get(
 *     path="/api",
 *     summary="Verificar se a aplicação está funcionando", produces={"application/json"},
 *     @SWG\Response(response="200", description="An print showing laravel lumen message")
 * )
 */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/swagger-ui', function () {

    return file_get_contents('../public/swagger-ui.html');;
});

$router->get('/swagger', function () {
    return $content = file_get_contents('../public/swagger.json');
});

$router->group(['middleware' => [
    'cors',
    'JsonApiMiddleware'
], 'prefix' => '/api'], function () use ($router) {
});
