<?php

if (!function_exists('toCpfClear')) {
    function toCpfClear(string $string): string
    {
        return preg_replace('/[^A-Za-z0-9]/', '', $string);
    }
}

if (!function_exists('toOnlyDigits')) {
    function toOnlyDigits(string $string): string
    {
        return preg_replace('/\D/', '', $string);
    }
}

/**
 * @param string
 * @return string
 */
if (!function_exists('toCpfFormat')) {
    function toCpfFormat(string $cleanCpf): string
    {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", '$1.$2.$3-$4', $cleanCpf);
    }
}
