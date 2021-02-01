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
