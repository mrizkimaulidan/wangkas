<?php

/**
 * Format a number as a local currency amount.
 */
if (! function_exists('local_amount_format')) {
    function local_amount_format(float $num): string
    {
        return 'Rp'.number_format($num, 0, ',', '.');
    }
}
