# Laravel Nova Havingable

Allow filtering of values calculated by aggregate functions like `withSum`, `withCount`, etc.

## Installation

```sh
composer require webard/nova-havingable
```

## Description

Let’s say you have a Resource that calculates aggregated values, such as an Order resource that calculates the total amount of ordered products:

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

If you want to make these fields filterable, the `filterable()` method doesn’t work because it is based on the `WHERE` clause instead of `HAVING`.

This package provides a `havingable()` macro for fields, making them available for filtering.

## Usage

Simply add the `->havingable()` method to your Resource field:

```php
Number::make('Items sum', 'lines_sum_quantity')
    ->sortable()
    ->exceptOnForms()
    ->havingable()
```

## TODO

- [ ] add tests

## Contributing

We welcome contributions to improve this plugin! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them with descriptive messages.
4. Push your changes to your forked repository.
5. Open a pull request to the main repository.

## License

This project is licensed under the MIT License. See the [LICENSE.md](LICENSE.md) file for more details.

## Contact

For questions or support, please open an issue on GitHub.
