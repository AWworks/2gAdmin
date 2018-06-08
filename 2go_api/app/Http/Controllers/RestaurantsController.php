<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function index()
    {
        /*$foodCat = FoodCategory::orderBy('updated_at', 'desc')->with(['user', 'dishes'])->get();*/
        return view('restaurants.index'/*, compact('foodCat')*/);
    }

    public function create()
    {
        /*$dishes = Dish::all();*/
        return view('restaurants.create'/*, compact('dishes')*/);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'foodCatName' => 'required|string|max:255',
            'foodCatDescription' => 'required|string|max:255',
            'foodCatDish' => 'required',
            'foodCatStatus' => 'required|in:Active,InActive',
        ]);

        FoodCategory::create([
            'foodCatName' => request('foodCatName'),
            'foodCatDescription' => request('foodCatDescription'),
            'foodCatStatus' => request('foodCatStatus'),
            'foodCatCreator' => \Auth::id(),
        ]);
        $dishes = $request->input('foodCatDish');
        $foodCategory = FoodCategory::orderBy('created_at', 'desc')->first();
        $foodCategory->dishes()->sync($dishes);

        flash('Food Category Successfully Created')->success();

        return $this->index();
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
            'foodCatDish' => 'required',
            'foodCatStatus' => 'required|in:Active,InActive',
        ]);

        $foodCat = FoodCategory::find($foodCat);
        $dishes = $request->input('foodCatDish');
        $foodCat->dishes()->sync($dishes);

        $all = $request->except(['foodCatCreator', 'foodCatDish']);
        $foodCat->update($all);
        $foodCat->fill(['foodCatCreator' => \Auth::id()])->save();

        flash('Food Category Successfully Updated')->success();

        return $this->index();
    }

    public function destroy($foodCat)
    {
        $foodCat = FoodCategory::find($foodCat);
        $foodCat->delete();
        flash('food Category Successfully Deleted')->error();

        return $this->index();
    }

}
