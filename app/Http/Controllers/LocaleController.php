<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;


class LocaleController extends Controller
{
    public function locale(Request $request)
    {
        //App::setLocale($locale);
        session()->put('locale', $request->input('locale'));
        return redirect()->back();
    }
}
