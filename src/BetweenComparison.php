<?php

namespace Webard\NovaHavingable;

class BetweenComparison
{
    public function __invoke($request, $query, $value, $attribute)
    {
        [$min, $max] = $value;

        if (! is_null($min) && ! is_null($max)) {
            return $query->havingBetween($attribute, [$min, $max]);
        } elseif (! is_null($min)) {
            return $query->having($attribute, '>=', $min);
        }

        return $query->having($attribute, '<=', $max);
    }
}
