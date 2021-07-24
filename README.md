# Introduction

**Logging** helps you to log the user or application activity. It records every **URL**, **Method**, **Data** with **User detail** along with his IP. You will get two drivers, **file** and **database**. File driver log the activity in a file and database driver put the logs in database. When using File driver, logs can be found in *storage/logs/user-log-(date).log*. Its creates a new file daily to log the activity.

## Installation

    composer require takshak/logging

You can use it with middleware if you want to track some specific url, but if you want to log every route, you can add it in AppServiceProvider.php

### Using Middleware

    'logging' => \Takshak\Logging\Http\Middleware\Logging::class

Add the above code to routeMiddleware group and call the middleware using your route file:

    Route::get('dashboard', [HomeController::class, 'dashboard'])->middleware(['logging']);

To log into database you need to pass a key database to middleware, 'logging:database'. By default it will write the logs into file.

If you are using database for logging, you need to run the migration which will create a table named loggings.
php artisan migrate

### Using AppServiceProvider
To log every route you need to use **LoggingTrait** in your **AppServiceProvider** and call **logActivity** function in boot method.

    use Takshak\Logging\Traits\LoggingTrait;
    class AppServiceProvider extends ServiceProvider
    {
            use LoggingTrait;
        
        public function boot()
        {
            $this->logActivity();
        }
    }


If you are using databse for logging, you need to show this logs in any dashboard or admin panel. In that case you can use **Logging** model : **use Takshak\Logging\Models\Logging;**