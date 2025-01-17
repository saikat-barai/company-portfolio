<?php

namespace App\Http\Controllers;

use App\Models\OrderNotification;
use App\Models\Product;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class TalkController extends Controller
{
    function index()
    {
        SEOTools::setTitle('Synex Digital - Talk');
        $product = Product::where('status', 1)->get();
        return view('frontend.pages.talk', [
            'products' => $product,
        ]);
    }

    function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'number'    => 'required',
            'message'   => 'required',
        ]);

        $message = new OrderNotification();
        $message->name      = $request->name;
        $message->email     = $request->email;
        $message->number    = $request->number;
        $message->company   = $request->comapny;
        $message->message   = $request->message;
        $message->save();

        return view('frontend.pages.thankyou')->with('succ', 'We will contact you soon');
    }
}
