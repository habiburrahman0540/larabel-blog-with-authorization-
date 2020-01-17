<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:subscribers',
        ]);

        $post = new Subscriber();
        $post->email = $request->email;
        $post->save();
        return redirect(route('mainhome'))->with('successMsg','Subscriber added successfully.');

    }

}
