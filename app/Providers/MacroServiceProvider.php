<?php

namespace App\Providers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Builder::macro('whereLike', function($attributes, string $searchTerm) {
            foreach(Arr::wrap($attributes) as $attribute) {
                $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
            }
            return $this;
        });
    }
}
