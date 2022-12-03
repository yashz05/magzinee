<?php

namespace App\Http\Controllers\others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class image_manager extends Controller
{
    //
    public function image_upload(Request  $request){
        $data = [];
        if($request->file('file') != null){
            $file = $request->file('file');
            $filename = explode('.',$file->getClientOriginalName())[0] . rand(1,199999) . time() . '.' .$file->getClientOriginalExtension();
            $file->move(public_path('/images/content/'.date('Y')),$filename);
            $data = ['success'=> true, 'file'=> url('/').'/images/content/'.date('Y').'/'.$filename,'message' => 'uploadSuccess'];
        }else{
            $data = ['success'=> false];

        }
        return $data;
    }
}
