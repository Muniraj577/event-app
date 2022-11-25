<?php

if (!function_exists('formatDate')){
    function formatDate(string $format, string $date){
        return date($format, strtotime($date));
    }
}
