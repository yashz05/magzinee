<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Posts extends Controller
{
    //
    public function index(){
        $posts = \App\Models\posts::paginate(15);
        return view('Posts.index',['posts'=>$posts]);
    }

}
