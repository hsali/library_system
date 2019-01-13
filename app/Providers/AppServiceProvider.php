<?php

namespace App\Providers;

use App\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('racks_limit', function($attribute, $value, $parameters) {
            $books_count = Book::where([$attribute => $value])->count();
            return $books_count < config("ls.rack.limit");
        });

        Validator::extend('racks_limit_updated', function($attribute, $value, $parameters) {
            $books_count = Book::where([$attribute => $value])->count();
            $rack_id = Book::find(request()->segment(2))->rack_id;
            if($rack_id == $value)
                return true;
            else
                return $books_count < config("ls.rack.limit");
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
