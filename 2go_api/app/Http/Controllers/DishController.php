<?php

namespace App\Http\Controllers;

use App\Dish;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DishController extends Controller
{
    public function index()
    {
        $path = public_path('images/Dishes');
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $dishes = Dish::orderBy('updated_at', 'desc')->with('user')->get();
        return view('dishes.index', compact('dishes'));
    }

    public function create()
    {
        return view('dishes.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'dishName' => 'required|string',
            'dishImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
            'dishStatus' => 'required|in:Active,InActive',
        ]);

        // image_store
        $image = $request->file('dishImage');
        $dishName = $request->input('dishName');
        $dishStatus = $request->input('dishStatus');
        $path = public_path('images/Dishes/' . $dishName . '.jpg');

        Image::make($image)->orientate()->encode('jpg')->save($path);

        if (file_exists($path)) {
            Dish::create([
                'dishName' => $dishName,
                'dishStatus' => $dishStatus,
                'dishCreator' => \Auth::id(),
            ]);
            flash('Dish Successfully Added')->success();
        }
        return redirect(route('dish.index'));
    }

    public function show($id)
    {
        /*$temp = explode('-', $id);
    $id = end($temp);
    $photos = Photo::with('category')->where('imageCategory', '=', $id)->get();
    return view('photos.show', compact('photos'));*/
    }

    public function edit($dish)
    {
        /*echo 213;die;
        echo 'Id : '. $dish;exit;*/
        $dish = Dish::find($dish);
        return view('dishes.edit', compact('dish'));
    }

    public function update(Request $request, $dish)
    {
        $this->validate(request(), [
            'dishName' => 'required',
            'dishImage' => 'image|mimes:jpeg,png,jpg,gif|max:3000|nullable',
            'dishStatus' => 'required',
        ]);

        $dish = Dish::find($dish);
        $image = $request->file('dishImage');
        $nameChange = $request->input('dishName') != $dish->dishName;
        $oldpath = public_path('images/Dishes/' . $dish->dishName . '.jpg');
        $targetpath = public_path('images/Dishes/' . $request->dishName . '.jpg');

        //file not changed
        if (is_null($image)) {
            $result = true;
            if ($nameChange) {
                $result = File::move($oldpath, $targetpath);
            }
            if ($result) {
                $v = $request->except('dishImage');
                $dish->update($v);
                flash('Dish Successfully Updated')->success();
                return $this->index();
            }
            //file changed
        } else {
            File::delete($oldpath);
            Image::make($image)->orientate()->encode('jpg')->save($targetpath);

            if (file_exists($targetpath)) {
                $v = $request->except('dishImage');
                $dish->update($v);
                flash('Dish Successfully Updated')->success();
            }
            return redirect(route('dish.index'));
        }
    }

    public function destroy($id)
    {
        $dish = Dish::find($id);
        $path = public_path('images/Dishes/' . $dish->dishName . '.jpg');

        $result = File::delete($path);
        if ($result) {
            $dish->delete();

            flash('Dish Successfully Deleted')->error();
        }
        return redirect(route('dish.index'));
    }
}
