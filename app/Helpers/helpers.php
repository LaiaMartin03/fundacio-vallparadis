<?php

if (!function_exists('formatHours')) {
    function formatHours($hours) {
        $h = floor($hours);
        $m = round(($hours - $h) * 60);
        return "{$h}h {$m}min";
    }
}
