# Laravel 6 Todo APP API 

This is a todo with JWT for users authentication made with laravel 6 and mongoDB as database server


# HOW TO START

npm install<br>

php artisan serve<br>

db name = aostodo<br>

Apllicarion will start on port 8000

##API ROUTES


api/login : Route::post("login", "AuthController@login") :  To connect a user; <br>

api/register :  Route::post("register", "AuthController@register"); : To register a new user <br>

api/logout : Route::get("logout", "AuthController@logout"); : To logout a user <br>


    Route::resource("tasks", "TaskController"); <br>


GET api/tasks : All tasks for an authenticated user <br>

POST api/tasks : Create a task <br>

PATCH api/tasks/{id} : update a task <br>

DELETE  api/tasks/{id} : Delete a task <br>





