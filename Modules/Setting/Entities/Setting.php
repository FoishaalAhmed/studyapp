<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB, Exception;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'value', 'type'
    ];

    public function storeSetting(Object $request)
    {
        try {
            DB::beginTransaction();

            $largeLogoOld = Setting::where(['name' => 'large_logo', 'type' => 'General'])->first()->value;
            $largeLogo = $request->file('large_logo');

            if ($largeLogo) {
                $response = uploadImage($largeLogo, 'public/images/settings/', 'large_logo', '98*20', $largeLogoOld);

                if ($response['status'] === true) {
                    Setting::where(['name' => 'large_logo', 'type' => 'General'])->update(['value' => 'public/images/settings/' . $response['file_name']]);
                } else {
                    DB::rollBack();
                    return [
                        'alert' => 'error',
                        'message' => $response['message']
                    ];
                }
            }

            $smallLogoOld = Setting::where(['name' => 'small_logo', 'type' => 'General'])->first()->value;
            $smallLogo = $request->file('small_logo');

            if ($smallLogo) {
                $response = uploadImage($smallLogo, 'public/images/settings/', 'small_logo', '22*22', $smallLogoOld);
                if ($response['status'] === true) {
                    Setting::where(['name' => 'small_logo', 'type' => 'General'])->update(['value' => 'public/images/settings/' . $response['file_name']]);
                } else {
                    DB::rollBack();
                    return [
                        'alert' => 'error',
                        'message' => $response['message']
                    ];
                }
            }
            $favIconOld = Setting::where(['name' => 'favicon', 'type' => 'General'])->first()->value;
            $favIcon = $request->file('favicon');

            if ($favIcon) {
                $response = uploadImage($favIcon, 'public/images/settings/', 'favicon', '22*22', $favIconOld);
                if ($response['status'] === true) {
                    Setting::where(['name' => 'favicon', 'type' => 'General'])->update(['value' => 'public/images/settings/' . $response['file_name']]);
                } else {
                    DB::rollBack();
                    return [
                        'alert' => 'error',
                        'message' => $response['message']
                    ];
                }
            }

            Setting::where(['name' => 'row_per_page', 'type' => 'General'])->update(['value' => $request->row_per_page]);
            Setting::where(['name' => 'max_file_size', 'type' => 'General'])->update(['value' => $request->max_file_size]);

            DB::commit();

            return [
                'alert' => 'success',
                'message' => __('Setting Updated Successfully.')
            ];

        } catch (Exception $e) {
            DB::rollBack();
            return [
                'alert' => 'error',
                'message' => $e->getMessage()
            ];
        }
        
    }
    
    
}
