<?php
if (! function_exists('durationToStr')) {
    function durationToStr ($duration) {
        $days = strlen($duration)/24;
        $hours = substr_count($duration,'1');
        return("$days ".__("days")." ($hours ".__('hours').')');
    }
}
