<?php

namespace Webard\NovaHavingable;

class TextComparison
{
    public function __invoke($request, $query, $value, $attribute)
    {
        return $query->having($attribute, $value);
    }
}
