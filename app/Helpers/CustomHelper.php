<?php

function active_class($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function is_active_route($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

function show_class($path) {
    return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

if (!function_exists('formatCurrency')) {
    function formatCurrency($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('hitungSisaPagu')) {
    function hitungSisaPagu($pagu, $totalPengeluaran) {
        return formatCurrency($pagu - $totalPengeluaran);
    }
}