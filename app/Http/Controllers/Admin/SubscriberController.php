<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber.index',compact('subscribers'));
    }
    public function destroy($subscriber){
      Subscriber::find($subscriber)->delete();
        return redirect(route('admin.subscriber.index'))->with('successMsg','Subscriber deleted successfully.');
    }
}
