<?php

namespace App\Http\Controllers;

use App\Cuisine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CuisineController extends Controller
{
    public function index()
    {
        $request  = Request::capture();

        if($request->hasHeader('api') == 'true'){
            $cuisines = Cuisine::where('cuisineStatus', 'Active')->orderBy('updated_at', 'desc')->get([
                'id', 'cuisineName as cuisine', 'cuisineNameInArabic as cuisineInArabic'
            ]);
            $request  = Request::capture();
            if ($request->hasHeader('Content-Type') == 'application/json') {
                return response()->json([
                    'code'     => '200',
                    'response' => $cuisines,
                ]);
            }
            return view('cuisines.index', compact('cuisines'));
        }else{
            $cuisines = Cuisine::orderBy('updated_at', 'desc')->with('user')->get();
            $request  = Request::capture();
            if ($request->hasHeader('Content-Type') == 'application/json') {
                return response()->json([
                    'code'     => '200',
                    'response' => $cuisines::all(),
                ]);
            }
            return view('cuisines.index', compact('cuisines'));
        }
    }

    public function create()
    {
        return view('cuisines.create');
    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'cuisineName'   => 'required|string|max:255',
            'cuisineNameInArabic'   => 'string|max:255',
            'cuisineStatus' => 'required|in:Active,InActive',
        ]);
        Cuisine::create([
            'cuisineName'    => request('cuisineName'),
            'cuisineNameInArabic'    => request('cuisineNameInArabic'),
            'cuisineStatus'  => request('cuisineStatus'),
            'cuisineCreator' => \Auth::id(),
        ]);
        flash('Cuisine Successfully Created')->success();

        return redirect(route('cuisine.index'));
    }

    public function show($post)
    {
        /*$temp = explode('-', $post);
    $id = end($temp);
    $post = Post::find($id);  //can be done like this also
    return view('posts.show', compact('post'));*/
    }

    public function edit($cuisine)
    {
        $cuisine = Cuisine::find($cuisine);
        return view('cuisines.edit', compact('cuisine'));
    }

    public function update(Request $request, $cuisine)
    {
        $this->validate(request(), [
            'cuisineName'   => 'required|string|max:255',
            'cuisineStatus' => 'required|in:Active,InActive',
        ]);

        $cuisine = Cuisine::find($cuisine);
        $v       = $request->all();
        $cuisine->update($v);
        flash('Cuisine Successfully Updated')->success();

        return redirect(route('cuisine.index'));

    }

    public function destroy($cuisine)
    {
        $cuisine = Cuisine::find($cuisine);
        $cuisine->delete();
        flash('Cuisine Successfully Deleted')->error();

        return redirect(route('cuisine.index'));
    }

}
