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

/**
 * Find a single module or collection
 *
 * @param string $name
 *
 * @return collection
 */

if (!function_exists('module')) {
    function module(String $name = null)
    {
        if (is_null($name)) {
            return \Nwidart\Modules\Facades\Module::all();
        }

        return \Nwidart\Modules\Facades\Module::find($name);
    }
}

/**
 * Checking if module active or not
 *
 * @param string $name
 *
 * @return bool
 */

if (!function_exists('isActive')) {
    function isActive(String $name = null)
    {
        if (is_null($name)) {
            return \Nwidart\Modules\Facades\Module::collections();
        }

        return \Nwidart\Modules\Facades\Module::collections()->has($name);
    }
}
