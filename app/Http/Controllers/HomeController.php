<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view("backend.index");
    }

    public function changeLanguage($lang)
    {

        if (in_array($lang, ['bn', 'en'])) {
            auth()->user()->update([
                'language' => $lang
            ]);
        }

        return back();
    }
}