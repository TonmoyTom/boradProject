Laravel 7 Application with QuizProject.

Laravel 7 Application with Multiple Authentication One To One Permissions. You can even use this application for your projects if you need multiple guards. Getting this app up and running

  *Make sure you already have xampp installed (easy to use).

 *Clone this repository to your local machine or just download the zip from the above green button.

 *Install Composer first, then run this command in your command-line (you should be inside your project directory).

            composer install
            
You can install the package via composer:

            composer require spatie/laravel-permission

Rename .env.example to .env and add your database.

            cp .env.example .env

Generate application key.

            php artisan key:generate

Create tables.

            php artisan migrate
            
Create Seed tables AdminSeed & RoleSeed.

            php artisan db:seed
            
            
Start the development server.

            php artisan serve
    

Usage

Flash Messages: use status key for success messages and error key for error messages.

Guards: web (default) and admin (custom).

Auth middleware for admin guard: auth:admin for authenticated users using admin guard.

Guest middleware for admin guard: guest:admin for unauthenticated users using admin guard.

This application has a custom middleware EnsureCustomGuardIsVerified that can be used for verifying emails of custom guards. This middleware is registered in the application as guard.verified and takes two arguments first guard name and second route name that will be used for redirecting unverified users. Example: guard.verified:admin,admin.verification.notice or guard.verified:customer,customers.verify-notice.

Don't use @auth or @guest directives for default guard, use Auth::guard('web')->check() with @if instead.

Admin and Default routes are seperated and all the admin routes are prefixed by admin.

"# QuizProjec " 
