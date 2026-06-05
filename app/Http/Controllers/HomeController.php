<?php

namespace App\Http\Controllers;

use App\Models\Pond;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        $investments = Transaction::where('type', 'investment')->sum('amount');
        $ponds = Pond::all()->count();
        $fish_purchase = Transaction::where('purpose_id', '1')->sum('amount');
        $feed = Transaction::where('purpose_id', '2')->sum('amount');
        $fish_sale = Transaction::where('purpose_id', '11')->sum('amount');
        $total_expenses = Transaction::where('type', 'expense')->sum('amount');
        $total_income = Transaction::where('type', 'income')->sum('amount');

        return view("backend.index", compact('investments', 'ponds', 'feed', 'fish_purchase', 'fish_sale', 'total_expenses', 'total_income'));
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
