<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->symLinking();
        $header = 'DashBoard';


        $user = User::where('id', Auth::id())->with('role')->first();
        $merchants = Merchant::with('owner')->get();
        foreach ($merchants as $merchant) {
            foreach ($merchant->owner as $owner) {
                if ($owner->id == $user->id || $user->role[0]->id == 1) {
                    return view('layouts.dashboard', compact('header'));
                }
            }
        }
        return view('errors.notAttached');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function symLinking()
    {
        if (App::environment('production')) {
            if (!file_exists(public_path('images'))) {
                symlink('/home/anuragarora/public_html/images', public_path('images'));
                /*Mail::to('anuraag376@gmail.com')->cc('gopaaldhussa@gmail.com')->queue(new VersionUpdate);*/
            }
        }
    }
}
