<?php

if (!function_exists('indonesianCurrency')) {
    /**
     * Ubah mata uang menjadi format indonesia
     *
     * @param Integer $number
     * @return String
     */
    function indonesianCurrency(int $number): String
    {
        return 'Rp' . number_format((int) $number, 2, ',',);
    }
}
