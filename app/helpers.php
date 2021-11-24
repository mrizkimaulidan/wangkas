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

if (!function_exists('get_gender_name')) {
    /**
     * Mengubah angka menjadi nama jenis kelamin.
     * 1 = Laki-laki
     * 2 = Perempuan
     *
     * @param Integer $value
     * @return String
     */
    function get_gender_name(int $value): String
    {
        return $value === 1 ? 'Laki-laki' : 'Perempuan';
    }
}
