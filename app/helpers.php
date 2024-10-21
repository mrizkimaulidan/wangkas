<?php

use Illuminate\Support\Number;

/**
 * Format a number as a local currency amount.
 */
if (! function_exists('local_amount_format')) {
    function local_amount_format(int|float $num): string
    {
        return Number::currency($num, in: 'IDR', locale: 'id');
    }
}
