<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\utils\imageManger;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index ()
    {
        return view('admin.settings.index');

    }

      public function update (SettingRequest $request)
    {
        $current_setting= Setting::findOrFail($request->setting_id);
        $setting=$current_setting->update($request->except(['_token', 'setting_id', 'logo', 'favicon']));

        if($request->hasFile('logo')){
           $this->updateLogo($request,$current_setting);
        }
         if($request->hasFile('favicon')){
           $this->updateFavicon($request , $current_setting);
        }
        if(!$setting){
            return redirect()->back()->with('error' , 'Try Again Latter');
        }

        return redirect()->back()->with('success' , 'Setting Update Successfully!');



    }
    private function updateLogo($request , $current_setting){
         imageManger::deleteImageFromLocal($current_setting->logo);
            $file= imageManger::generateImage($request->logo);
            $logo_path= imageManger:: storeImage($request->logo, 'setting', $file);
            $current_setting->update([
                'logo'=>$logo_path,
            ]);

    }
    private function updateFavicon($request , $current_setting){
         imageManger::deleteImageFromLocal($current_setting->favicon);
            $file= imageManger::generateImage($request->favicon);
            $favicon_path= imageManger:: storeImage($request->favicon, 'setting', $file);
                $current_setting->update([
                'favicon'=>$favicon_path,
            ]);
    }
}
