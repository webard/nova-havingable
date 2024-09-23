<?php

namespace Webard\NovaHavingable;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Number;

class NovaHavingableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if (! Field::hasMacro('filterable')) {
            Field::macro(
                'havingable',
                function () {
                    /** @var Field $this */
                    return match (\get_class($this)) {
                        Date::class => $this->filterable((new BetweenComparison)(...)),
                        DateTime::class => $this->filterable((new BetweenComparison)(...)),
                        Number::class => $this->filterable((new BetweenComparison)(...)),
                        default => $this->filterable((new EqualComparison)(...)),
                    };
                }

            );
        }
    }

    /**
     * Register the application services.
     */
    public function register() {}
}
