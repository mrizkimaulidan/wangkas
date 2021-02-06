<?php

if (!function_exists('count_data')) {
    /**
     * Hitung seluruh data, jika data kosong return 0. Jika data ada, maka hitung menggunakan method count().
     *
     * @param Object $data
     * @return Integer
     */
    function count_data(Object $data): Int
    {
        if ($data->isEmpty()) {
            return 0;
        }

        return $data->count();
    }
}

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
