<?php
if (!function_exists('getGreeting')) {
    function getGreeting()
    {
        $hour = date('H');

        if ($hour < 12) {
            return "Chào buổi sáng";
        } elseif ($hour < 18) {
            return "Chào buổi chiều";
        } else {
            return "Chào buổi tối";
        }
    }
}