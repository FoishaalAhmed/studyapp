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

            $darkLogoOld = Setting::where(['name' => 'dark_logo', 'type' => 'General'])->first()->value;
            $darkLogo = $request->file('dark_logo');

            if ($darkLogo) {
                $response = uploadImage($darkLogo, 'public/images/settings/', 'dark_logo', $darkLogoOld);

                if (!$response['status']) {
                    DB::rollBack();
                    return [
                        'alert' => 'error',
                        'message' => $response['message']
                    ];
                }

                Setting::where(['name' => 'dark_logo', 'type' => 'General'])->update(['value' => 'public/images/settings/' . $response['file_name']]);
            }

            $lightLogoOld = Setting::where(['name' => 'light_logo', 'type' => 'General'])->first()->value;
            $lightLogo = $request->file('light_logo');

            if ($lightLogo) {
                $response = uploadImage($lightLogo, 'public/images/settings/', 'light_logo', $lightLogoOld);

                if (!$response['status']) {
                    DB::rollBack();
                    return [
                        'alert' => 'error',
                        'message' => $response['message']
                    ];
                }

                Setting::where(['name' => 'light_logo', 'type' => 'General'])->update(['value' => 'public/images/settings/' . $response['file_name']]);
            }

            $smallLogoOld = Setting::where(['name' => 'small_logo', 'type' => 'General'])->first()->value;
            $smallLogo = $request->file('small_logo');

            if ($smallLogo) {
                $response = uploadImage($smallLogo, 'public/images/settings/', 'small_logo', '22*22', $smallLogoOld);
                if (!$response['status']) {
                    DB::rollBack();
                    return [
                        'alert' => 'error',
                        'message' => $response['message']
                    ];
                }

                Setting::where(['name' => 'small_logo', 'type' => 'General'])->update(['value' => 'public/images/settings/' . $response['file_name']]);
            }

            $favIconOld = Setting::where(['name' => 'favicon', 'type' => 'General'])->first()->value;
            $favIcon = $request->file('favicon');

            if ($favIcon) {
                $response = uploadImage($favIcon, 'public/images/settings/', 'favicon', '22*22', $favIconOld);
                if (!$response['status']) {
                    DB::rollBack();
                    return [
                        'alert' => 'error',
                        'message' => $response['message']
                    ];
                }
                
                Setting::where(['name' => 'favicon', 'type' => 'General'])->update(['value' => 'public/images/settings/' . $response['file_name']]);
            }

            Setting::where(['name' => 'name', 'type' => 'General'])->update(['value' => $request->name]);
            Setting::where(['name' => 'row_per_page', 'type' => 'General'])->update(['value' => $request->row_per_page]);
            Setting::where(['name' => 'max_file_size', 'type' => 'General'])->update(['value' => $request->max_file_size]);
            Setting::where(['name' => 'admin_security', 'type' => 'General'])->update(['value' => $request->admin_security]);
            Setting::where(['name' => 'ip_address', 'type' => 'General'])->update([
                'value' => $request->ip_address != null ? implode(',', array_column(json_decode($request->ip_address), 'value')) : null
            ]);

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
