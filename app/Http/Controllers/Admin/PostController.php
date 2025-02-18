<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if(!$value){
                return back()->withInput();
            }
        }

        return redirect('/');
        
    }

}
