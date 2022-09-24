<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
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
        $type = Type::where('isOn', 1)->count();
        $data['slug'] = Str::slug($request->name) . Str::random(4);
        if($type >= 6){
            $data['isOn'] = '0';
        }else{
            $data['isOn'] = $request->isDefault == null ? '0' : '1';  
        }
        Type::create($data);
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
        $tipe = Type::where('isOn', 1)->count();
        $type = Type::where('id', $id)->first();
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
    
    public function destroy($type)
    {
        $tipe = Type::findOrFail($type);    
        $tipe->delete();

        return redirect('setting');
    }
}
