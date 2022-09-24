<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('role','!=','admin')->get();
        return view('user/index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        return view('user/create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'alamat' => 'required',
            'phone' => 'required',
            'photo' => 'required|mimes:jpg,png,jpeg',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store(
            'assets/user' , 'public'
            ) ;
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'alamat' => $data['alamat'],
            'phone' => $data['phone'],
            'photo' => $data['photo'],
            'password' => Hash::make($data['password']),
            'role' => 'user'
        ]);
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user/show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user/edit', compact('user'));
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
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'phone' => 'required',
            'photo' => 'required|mimes:jpg,png,jpeg',
        ]);
        $data = $request->all();
        if($request->file('photo')){
            Storage::delete($user->photo);
            $data['photo'] = $request->file('photo')->store(
                'assets/user' , 'public'
                ) ;
        }else{
            $data['photo'] = $user->photo;
        }
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'alamat' => $data['alamat'],
            'phone' => $data['phone'],
            'photo' => $data['photo'],
            'role' => 'user'
        ]);
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Storage::delete($user->photo);
        $user->delete();

        return redirect('user');
    }
}
