# Laravel Nova Havingable

Allow filter values calculated by aggregate functions like `withSum`, `withCount` etc.

## Installation

```sh
composer require webard/nova-havingable
```

## Description

Let's say you have Resource that calculates aggregated values, e.g. Order resource calculates ordered products amount:

```php
class Order extends Resource
{
    public static $model = \App\Models\Order::class;

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query
            ->withSum('lines', 'amount')
            ->withSum('lines', 'quantity');
    }

    public function resourceFields(NovaRequest $request): array
    {
        return [
            ID::make('ID', 'id'),

            Number::make('Items Sum', 'lines_sum_quantity')
                ->sortable()
                ->exceptOnForms(),

            Number::make('Amount Sum', 'lines_sum_amount')
                ->sortable()
                ->exceptOnForms(),
        ];
    }
}
```

If you want to make this field filterable, `filterable()` method isn't works because it base on `WHERE` clause instead of `HAVING`.

This package provides `havingable()` macro for fields, makes them available for filter.

## Usage

Just add `->havingable()` method to your Resource field:

```php
Number::make('Items sum', 'lines_sum_quantity')
    ->sortable()
    ->exceptOnForms()
    ->havingable()
```

## TODO

- [ ] tests
