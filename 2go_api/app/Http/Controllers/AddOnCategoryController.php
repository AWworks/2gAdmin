<?php

namespace App\Http\Controllers;

use App\AddOnCategory;
use File;
use Illuminate\Http\Request;

class AddOnCategoryController extends Controller
{
    public function index()
    {
        $function = new Functions();
        $addOnCat = AddOnCategory::whereIn('addOnCatCreator',$function->ownerId())->with('user')->get();
        return view('addOnCategory.index', compact('addOnCat'));
    }

    public function create()
    {
        return view('addOnCategory.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'addOnCatName' => 'required|string|max:255|unique:add_on_categories,addOnCatName',
            'addOnCatDescription' => 'required|string|max:255',
            'addOnCatStatus' => 'required|in:Active,InActive',
        ]);

        /*$path = public_path('images/AddOn/' . $request->input('addOnCatName'));
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }*/

        AddOnCategory::create([
            'addOnCatName' => request('addOnCatName'),
            'addOnCatDescription' => request('addOnCatDescription'),
            'addOnCatStatus' => request('addOnCatStatus'),
            'addOnCatCreator' => \Auth::id(),
        ]);
        flash('AddOnCategory Successfully Created')->success();

        return redirect(route('addOnCat.index'));
    }

    public function show($post)
    {
        /*$temp = explode('-', $post);
        $id = end($temp);
        $post = Post::find($id);  //can be done like this also
        return view('posts.show', compact('post'));*/
    }

    public function edit($addOnCat)
    {
        $addOnCat = AddOnCategory::find($addOnCat);
        return view('addOnCategory.edit', compact('addOnCat'));
    }

    public function update(Request $request, $addOnCat)
    {   
        
            $this->validate(request(), [
                'addOnCatName' => 'required|string|max:255',
                'addOnCatDescription' => 'required|string|max:255',
                'addOnCatStatus' => 'required|in:Active,InActive',
            ]);
            /* $addOnCat = AddOnCategory::find($addOnCat);
             $oldpath = public_path('images/AddOn/' . $addOnCat->addOnCatName);
             $targetpath = public_path('images/AddOn/' . $request->addOnCatName);
             $result = File::move($oldpath, $targetpath);*/
        try{
            $addOnCat = AddOnCategory::find($addOnCat);
            $v = $request->all();
            $addOnCat->update($v);
            flash('AddOnCategory Successfully Updated')->success();
        }catch(\Exception $ex){
            if($ex->getCode() == 23000){
                flash('AddOnCategory with Same Name already Exists')->error();
            }
        }
            
            return redirect(route('addOnCat.index'));

    }

    public function destroy($addOnCat)
    {
        $addOnCat = AddOnCategory::find($addOnCat);
        /*        $path = public_path('images/AddOn/' . $addOnCat->addOnCatName);
                $result = File::deleteDirectory($path);*/

        $addOnCat->delete();
        flash('AddOnCategory Successfully Deleted')->error();

        return redirect(route('addOnCat.index'));
    }

}
