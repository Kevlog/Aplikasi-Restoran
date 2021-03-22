<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class RatingController extends Controller
{
    public function setRatingdanReview(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'required',
            'ulasan' => 'required',                     
        ]);

        $sid = session()->getId();
        
        DB::table('rating_review')-> insert([           
            'rating' => $request -> rating,
            'review' => $request -> ulasan,
            'id_menu' => $request -> id_menu,                         
        ]);
        DB::table('keranjang')->where('id_session', $sid)->where('id_menu', $request->id_menu)->update(['cek' => '1']);
        // $request->session()->regenerate();     
        return redirect('/ulasan');
    }
}
