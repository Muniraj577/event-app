<?php

if (!function_exists('formatDate')){
    function formatDate($format, $date){
        return date($format, strtotime($date));
    }
}
