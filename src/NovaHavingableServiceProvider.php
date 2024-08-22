<?php

namespace Webard\NovaHavingable;

use Closure;
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
        if (! Number::hasMacro('havingable')) {
            Number::macro(
                'havingable',
                function () {
                    /** @var Number $this */
                    return $this->filterable((new NumberComparison)(...));
                }
            );
        }

        if (! Date::hasMacro('havingable')) {
            Date::macro(
                'havingable',
                function () {
                    /** @var Date $this */
                    return $this->filterable((new NumberComparison)(...));
                }
            );
        }

        if (! DateTime::hasMacro('havingable')) {
            DateTime::macro(
                'havingable',
                function () {
                    /** @var DateTime $this */
                    return $this->filterable((new NumberComparison)(...));
                }
            );
        }

        if (! Field::hasMacro('filterable')) {
            Field::macro(
                'filterable',
                function (Closure $callback) {
                    /** @var Field $this */
                    return $this->filterable((new TextComparison)(...));
                }
            );
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
