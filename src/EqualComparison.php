<?php

namespace Webard\NovaHavingable;

class EqualComparison
{
    public function __invoke($request, $query, $value, $attribute)
    {
        return $query->having($attribute, $value);
    }
}
