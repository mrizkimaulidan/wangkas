<?php

if (! function_exists('local_amount_format')) {
    function local_amount_format($num)
    {
        return 'Rp'.number_format($num, 0, ',', '.');
    }
}
