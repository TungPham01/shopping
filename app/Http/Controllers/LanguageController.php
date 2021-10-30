<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App;

class LanguageController extends Controller
{
    public function index($language){
        if (array_key_exists($language, Helper::LANGUAGE)) {
            App::setLocale($language);
            session()->put('language', $language);
        }
        return redirect()->back();
    }
}
