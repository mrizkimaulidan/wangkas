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
        return 'Rp' . number_format($number, 2, ',',);
    }
}

if (!function_exists('paid_status')) {
    /**
     * Ubah status menjadi string lunas/belum lunas.
     *
     * @param Integer $status
     * @return String
     */
    function paid_status(int $status): String
    {
        return $status === 1 ? 'Lunas' : 'Belum Lunas';
    }
}
