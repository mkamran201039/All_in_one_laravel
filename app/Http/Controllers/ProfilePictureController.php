<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilePictureController extends Controller
{
    public function showUploadForm()
    {
        return view('image_upload');
    }

    public function upload(Request $request)
    {  
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        

        $imageName = time().'.'.$request->profile_picture->extension();  
        $request->profile_picture->storeAs('public', $imageName);

        

        return view('image_upload', ['profilePicture' => $imageName]);
    }
}

