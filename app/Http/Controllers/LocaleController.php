<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocale($locale){

        if(array_key_exists($locale, config('app.locales'))){
            App::setLocale($locale);
            Session::put('locale', $locale);
        }

        return redirect()->back();
        // return redirect()->route('dashboard');
    }
}
