<?php

if (!function_exists('indonesian_currency')) {
    /**
     * Ubah mata uang menjadi format indonesia
     *
     * @param Integer $number
     * @return String
     */
    function indonesian_currency(int $number): String
    {
        return 'Rp' . number_format((int) $number, 2, ',',);
    }
}
