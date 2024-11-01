<?php

if (!function_exists('dataTableOptions')) {

    function dataTableOptions(array $options = [])
    {
        $default = [
            'order' => [[1, 'desc']],
            'pageLength' => settings('row_per_page')
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

/**
 * get Active modules.
 *
 * @return array
 */

if (!function_exists('getActiveModules')) {
    /**
     * get Active modules.
     *
     * @return array
     */
    function getActiveModules(): array
    {
        return \Nwidart\Modules\Facades\Module::getByStatus(1);
    }
}

if (!function_exists('uploadImage')) {

    /**
     * upload Image file
     *
     * @param string $file [original source]
     * @param string $location [file path where to upload]
     * @param string $name [file name]
     * @param string $size [optional - for resizing the main file]
     * @param string $old [optional - delete the old file(pass only name with extension)]
     *
     * @return Array
     */
    function uploadImage($file, $location, $name, $size = null, $old = null)
    {
        $response = [
            'status' => true,
            'message' => __('File uploaded successfully.')
        ];

        $path = makeDirectory($location);

        if (!$path) {
            $response = [
                'status' => false,
                'message' => __('Directory could not been created.'),
            ];
        }

        if (!empty($old)) {
            removeFile($old);
        }

        try {
            $filename = $name. '_'.time() . '.' . strtolower($file->extension());
            $image    = \Intervention\Image\Facades\Image::make($file);

            if (!empty($size)) {
                $size = explode('*', strtolower($size));
                $image->resize($size[0], $size[1]);
            }
            $image->save($location . '/' . $filename);

            $response['file_name'] = $filename;
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }
}

if (!function_exists('uploadFile')) {

    /**
     * upload Image file
     *
     * @param string $file [original source]
     * @param string $location [file path where to upload]
     * @param string $name [file name]
     * @param string $old [optional - delete the old file(pass only name with extension)]
     *
     * @return Array
     */
    function uploadFile($file, $location, $name, $old = null)
    {
        $response = [
            'status' => true,
            'message' => __('File uploaded successfully.')
        ];

        $path = makeDirectory($location);

        if (!$path) {
            $response = [
                'status' => false,
                'message' => __('Directory could not been created.'),
            ];
        }

        if (!empty($old)) {
            removeFile($old);
        }

        try {
            $filename = $name. '_'.time() . '.' . strtolower($file->extension());
            $file->move($location, $filename);

            $response['file_name'] = $filename;
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        return $response;
    }
}

if (!function_exists('makeDirectory')) {
    /**
     * making directory
     *
     * @param string $path
     * @param int $permission
     *
     * @return bool
     */
    function makeDirectory($path, $permission = null)
    {
        if (file_exists($path)) {
            return true;
        }

        $permission = !empty($permission) ? $permission : config('file_permission', 0755);
        return mkdir($path, $permission, true);
    }
}

if (!function_exists('removeFile')) {
    /**
     * making directory
     *
     * @param string $path
     *
     * @return bool
     */
    function removeFile($path)
    {
        return file_exists($path) && is_file($path) ? @unlink($path) : false;
    }
}

if (!function_exists('settings')) {

    /**
     * Get settings values
     *
     * @param string $field [return specific value, if don't match provide type values]
     *
     * @return string
     * @return array
     */
    function settings($field = null)
    {
        $setting = new \Modules\Setting\Entities\Setting();

        if (is_null($field)) {
            return $setting->all()->pluck('value', 'name')->toArray();
        }

        $settings = $setting->all()->pluck('value', 'name')->toArray();

        if (array_key_exists($field, $settings)) {
            $result = $settings[$field];
        } else {
            $result = $setting->all()->where('type', $field)->pluck('value', 'name')->toArray();
        }

        return $result;
    }
}

if (!function_exists('getFileExtensions')) {
    function getFileExtensions($type = 0)
    {
        $extensions = array(
            0 => ['jpg', 'jpeg', 'png', 'bmp', 'webp', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'pdf'],
            1 => ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'pdf'],
            2 => ['jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf'],
            3 => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'],
            4 => ['ico'],
            5 => ['doc', 'docx', 'xls', 'xlsx', 'csv', 'pdf'],
            6 => ['jpg', 'jpeg', 'png'],
            7 => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'ico'],
            8 => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'pdf']
        );
        return $extensions[$type];
    }
}

if (!function_exists('darkLogo')) {

    /**
     * Get system dark logo
     *
     * @return string
     */

    function darkLogo()
    {
        return !empty(settings('dark_logo')) && file_exists(settings('dark_logo')) ? settings('dark_logo') : 'public/images/dummy/logo-dark.png';
    }
}

if (!function_exists('lightLogo')) {

    /**
     * Get system light logo
     *
     * @return string
     */

    function lightLogo()
    {
        return !empty(settings('light_logo')) && file_exists(settings('light_logo')) ? settings('light_logo') : 'public/images/dummy/logo-light.png';
    }
}

if (!function_exists('smallLogo')) {

    function smallLogo()
    {
        return !empty(settings('small_logo')) && file_exists(settings('small_logo')) ? settings('small_logo') : 'public/assets/backend/images/logo-sm.png';
    }
}

if (!function_exists('getFavIcon')) {

    function getFavIcon()
    {
        return !empty(settings('favicon')) && file_exists(settings('favicon')) ? settings('favicon') : 'public/assets/backend/images/logo-sm.png';
    }
}

if (!function_exists('getSubjectsByCategory')) {
    function getSubjectsByCategory($categoryId)
    {
        $subjectIds = \Modules\Subject\Entities\CategorySubject::where('category_id', $categoryId)->pluck('subject_id')->toArray();

        return \Modules\Subject\Entities\Subject::whereIn('id', $subjectIds)->get(['id','name']);
    }
}

if (!function_exists('getSubjectsByChildCategory')) {
    function getSubjectsByChildCategory($childCategoryId)
    {
        
        $subCategoryId = \Modules\Category\Entities\ChildCategory::where('id', $childCategoryId)->first('sub_category_id');

        $categoryId = \Modules\Category\Entities\SubCategory::where('id', $subCategoryId)->first('category_id');

        $subjectIds = \Modules\Subject\Entities\CategorySubject::where('category_id', $categoryId)->pluck('subject_id')->toArray();

        return \Modules\Subject\Entities\Subject::whereIn('id', $subjectIds)->get(['id','name']);
    }
}


if (!function_exists('getChildCategoryByTypeAndSubCategory')) {
    function getChildCategoryByTypeAndSubCategory($subCategoryId, $type)
    {

        switch ($type) {
            case 'MCQ':
                $types = [\App\Enums\CategoryType::ModelTest, \App\Enums\CategoryType::CommonModelTest];
                break;
            case 'Ebook':
                $types = [\App\Enums\CategoryType::Ebook, \App\Enums\CategoryType::CommonEbook];
                break;
            default:
                $types = [\App\Enums\CategoryType::LectureSheet, \App\Enums\CategoryType::CommonLectureSheet];
                break;
        }

        return \Modules\Category\Entities\ChildCategory::whereIn('type', $types)->where('sub_category_id', $subCategoryId)->oldest('name')->get(['id', 'name']);
    }
}


