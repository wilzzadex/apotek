<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }
    public function updateprofile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;

        $image = $request->file('foto');
        $slug = str_slug($request->name);
        if(isset($image)){
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug . $currentdate . uniqid() . '.' . $image->getClientOriginalExtension();
            if(!file_exists('images/image_profile'))
            {
                mkdir('images/image_profile', 0777 , true);
            }
            $image->move('images/image_profile',$imagename);
            $user->foto = $imagename;
        }
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect(url('profile'))->with('FlashSukses','Berhasil mengubah profile');
        
    }
}
