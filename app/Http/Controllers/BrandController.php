<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $type = Brand::where('isOn', 1)->count();
        
        $data['photo'] = $request->file('photo')->store(
            'assets/brand' , 'public'
        );

        $data['slug'] = Str::slug($request->name) . Str::random(4);
        if($type >= 6){
            $data['isOn'] = '0';
        }else{
            $data['isOn'] = $request->isDefault == null ? '0' : '1';  
        }
        Brand::create($data);
        return redirect('setting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $tipe = Brand::where('isOn', 1)->count();
        $type = Brand::where('id', $id)->first();
        
        if($request->photo !== null){
            Storage::delete($type->photo);
            $data['photo'] = $request->file('photo')->store(
                'assets/brand' , 'public'
            );
        }else{
            $data['photo'] = $type->photo;
        }
        
        if($type->isOn == true){
            if($request->isOn == null){
                $data['isOn'] = 0;
            }
        }else{
            if($tipe >= 5){
                $data['isOn'] = 0;
            }else{
                $data['isOn'] = $request->isOn == 1 ? '1' : '0';  
            }
        }
        $data['slug'] = Str::slug($request->name) . Str::random(4);
        $type->update([
            'name' => $request->name,
            'photo' => $data['photo'],
            'isOn' => $data['isOn'],
            'slug' => $data['slug'],
            'description' => $request->description
        ]);
        return redirect('setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
