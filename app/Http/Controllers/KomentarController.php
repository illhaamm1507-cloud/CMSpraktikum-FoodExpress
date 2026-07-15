<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'komentar' => 'required',
            'rating' => 'required'
        ]);

        Komentar::create([
            'user_id' => Auth::id(),
            'komentar' => $request->komentar,
            'rating' => $request->rating
        ]);

        return redirect('/')
            ->with('success', 'Komentar berhasil ditambahkan');
    }
}