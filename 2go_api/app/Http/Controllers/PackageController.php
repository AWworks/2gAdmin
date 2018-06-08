<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('updated_at', 'desc')->with('user')->get();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'packageName' => 'required|string|max:255',
            'packageDescription' => 'required|string|max:255',
            'packagePrice' => 'required|string|max:255',
            'packagePromoPrice' => 'required|string|max:255',
            'packageExpiration' => 'required|string|max:255',
            'packageUsage' => 'required|string|max:255',
            'packageNoItem' => 'required|string|max:255',
            'packageLimit' => 'required|string|max:255',
            'packageStatus' => 'required|in:Active,InActive',
        ]);
        Package::create([
            'packageName' => request('packageName'),
            'packageDescription' => request('packageDescription'),
            'packagePrice' => request('packagePrice'),
            'packagePromoPrice' => request('packagePromoPrice'),
            'packageExpiration' => request('packageExpiration'),
            'packageUsage' => request('packageUsage'),
            'packageNoItem' => request('packageNoItem'),
            'packageLimit' => request('packageLimit'),
            'packageStatus' => request('packageStatus'),
            'packageCreator' => \Auth::id(),
        ]);
        flash('Package Successfully Created')->success();

        return redirect(route('package.index'));
    }

    public function show($post)
    {
        /*$temp = explode('-', $post);
        $id = end($temp);
        $post = Post::find($id);  //can be done like this also
        return view('posts.show', compact('post'));*/
    }

    public function edit($package)
    {
        $package = Package::find($package);
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, $package)
    {
        $this->validate(request(), [
            'packageName' => 'required|string|max:255',
            'packageDescription' => 'required|string|max:255',
            'packagePrice' => 'required|string|max:255',
            'packagePromoPrice' => 'required|string|max:255',
            'packageExpiration' => 'required|string|max:255',
            'packageUsage' => 'required|string|max:255',
            'packageNoItem' => 'required|string|max:255',
            'packageLimit' => 'required|string|max:255',
            'packageStatus' => 'required|in:Active,InActive',
        ]);

        $package = Package::find($package);
        $v = $request->all();
        $package->update($v);
        flash('Package Successfully Updated')->success();

        return redirect(route('package.index'));
    }

    public function destroy($package)
    {
        $package = Package::find($package);
        $package->delete();
        flash('Package Successfully Deleted')->error();

        return redirect(route('package.index'));
    }

}
