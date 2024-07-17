<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credential = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if (Auth::attempt($credential)) {
            session()->flash('success', 'welcome');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            session()->flash('danger', 'sorry');
            return redirect()->back()->withInput();
        }
        return;
    }
}
