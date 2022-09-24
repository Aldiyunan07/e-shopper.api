<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Setting;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $brand = Brand::orderby('isOn', 'DESC')->paginate(10);
        $type = Type::orderby('isOn', 'DESC')->paginate(10);
        return view('setting/index',compact('type','brand','setting'));
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $setting = Setting::findOrFail($id);

        if($request->file('logo')){
            $data['logo'] = $request->file('logo')->store(
                'assets/setting/logo' , 'public'
            ) ;
            Storage::delete($setting->logo);
        }else{
            $data['logo'] = $setting->logo;
        }

        if($request->file('icon')){
            $data['icon'] = $request->file('icon')->store(
                'assets/setting/icon' , 'public'
                ) ;
            Storage::delete($setting->icon);
        }else{
            $data['icon'] = $setting->icon;
        }
        $setting->update([
            'name' => $request->name,
            'icon' => $data['icon'],
            'logo' => $data['logo']
        ]);
        return redirect('setting');
        
    }

    public function mark()
    {
        return 'ok';
    }
}
