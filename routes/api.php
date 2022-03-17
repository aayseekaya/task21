 <?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', 'App\Http\Controllers\PassportAuthController@register');
Route::post('/login',  'App\Http\Controllers\PassportAuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::get("/tasks", "App\Http\Controllers\Api\TaskController@index");
    Route::get("/tasks/{id}", "App\Http\Controllers\Api\TaskController@show");
    Route::post("/tasks", "App\Http\Controllers\Api\TaskController@store");

    Route::patch("/tasks/{id}", "App\Http\Controllers\Api\TaskController@update");
    Route::delete("/tasks/{id}", "App\Http\Controllers\Api\TaskController@delete");
});