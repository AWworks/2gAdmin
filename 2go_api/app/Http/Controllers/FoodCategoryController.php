<?php

namespace App\Http\Controllers;

use App\Dish;
use App\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    public function index()
    {
        $function = new Functions();
        $foodCat = FoodCategory::whereIn('foodCatCreator',$function->ownerId())->with(['user', 'dishes'])->get();
        return view('foodCategory.index', compact('foodCat'));
    }

    public function create()
    {
        $dishes = Dish::all();
        return view('foodCategory.create', compact('dishes'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'foodCatName' => 'required|string|max:255|unique:food_categories,foodCatName',
            'foodCatDescription' => 'required|string|max:255',
            'foodCatNameInArabic' => 'string|max:255',
            'foodCatDescriptionInArabic' => 'string|max:255',
            'foodCatStatus' => 'required|in:Active,InActive',
        ]);

        FoodCategory::create([
            'foodCatName' => request('foodCatName'),
            'foodCatDescription' => request('foodCatDescription'),
            'foodCatNameInArabic' => request('foodCatNameInArabic'),
            'foodCatDescriptionInArabic' => request('foodCatDescriptionInArabic'),
            'foodCatStatus' => request('foodCatStatus'),
            'foodCatCreator' => \Auth::id(),
        ]);
        $dishes = $request->input('foodCatDish');
        $foodCategory = FoodCategory::orderBy('created_at', 'desc')->first();
        $foodCategory->dishes()->sync($dishes);

        flash('Food Category Successfully Created')->success();

        return redirect(route('foodCategory.index'));
    }

    public function show($post)
    {
        /*$temp = explode('-', $post);
        $id = end($temp);
        $post = Post::find($id);  //can be done like this also
        return view('posts.show', compact('post'));*/
    }

    public function edit($foodCat)
    {
        $dishes = Dish::all();
        $foodCat = FoodCategory::find($foodCat);
        return view('foodCategory.edit', compact('foodCat', 'dishes'));
    }

    public function update(Request $request, $foodCat)
    {
        $this->validate(request(), [
            'foodCatName' => 'required|string|max:255',
            'foodCatDescription' => 'required|string|max:255',
            'foodCatStatus' => 'required|in:Active,InActive',
        ]);
        try{
            $foodCat = FoodCategory::find($foodCat);
            $dishes = $request->input('foodCatDish');
            $foodCat->dishes()->sync($dishes);

            $all = $request->except(['foodCatCreator','foodCatDish']);
            $foodCat->update($all);
            $foodCat->fill(['foodCatCreator' => \Auth::id()])->save();

            flash('Food Category Successfully Updated')->success();
        }catch(\Exception $ex){
            if($ex->getCode() == 23000){
                flash('Food Category with Same Name already Exists')->error();
            }
        }
        return redirect(route('foodCategory.index'));
    }

    public function destroy($foodCat)
    {
        $foodCat = FoodCategory::find($foodCat);
        $foodCat->delete();
        flash('food Category Successfully Deleted')->error();

        return redirect(route('foodCategory.index'));
    }

}
