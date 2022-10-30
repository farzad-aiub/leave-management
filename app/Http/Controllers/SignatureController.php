<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignatureController extends Controller
{
    public function signatureUploadPost(Request $request)
    {
        $id = session('id');
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('signature'), $imageName);

        $user=User::findOrFail($id);
        $user->signature=$imageName;
        $user->save();


        /* Store $imageName name in DATABASE from HERE */

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }
}
