<?php

if (!function_exists('get_initials')) {
    /**
     * Get initials from a name (first 2 letters)
     *
     * @param string $name The name to extract initials from
     * @return string The initials (maximum 2 characters)
     */
    function get_initials(string $name): string
    {
        $words = explode(' ', $name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        
        return substr($initials, 0, 2);
    }
}