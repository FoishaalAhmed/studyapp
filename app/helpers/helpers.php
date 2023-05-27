<?php

if (!function_exists('dataTableOptions')) {

    function dataTableOptions(array $options = [])
    {
        $default = [
            'order' => [[0, 'desc']],
            'pageLength' => 50
        ];

        return array_merge($default, $options);
    }
}
