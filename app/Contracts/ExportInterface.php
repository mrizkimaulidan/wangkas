<?php

namespace App\Contracts;

interface ExportInterface
{
    public static function setStyle(): array;
    public static function outputTheExcel(object $spreadsheet, string $fileName): void;
}
