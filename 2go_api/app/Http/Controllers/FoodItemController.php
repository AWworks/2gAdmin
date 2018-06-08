<?php

namespace App\Http\Controllers;

use App\AddOnCategory;
use App\AddOnItem;
use App\Dish;
use App\FoodCategory;
use App\FoodItem;
use App\Size;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use Intervention\Image\Facades\Image;
use Session;

class FoodItemController extends Controller
{
    public function index()
    {
        $path = public_path('images/foodItem');
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $function = new Functions();
        $foodItem = FoodItem::whereIn('foodItemCreator', $function->ownerId())->with('user')->get();
        return view('foodItem.index', compact('foodItem'));
    }

    public function create()
    {
        $function = new Functions();
        $addOnItem = AddOnItem::whereIn('addOnItemCreator', $function->ownerId())->with('category')->get();
        $addOnCategory = AddOnCategory::whereIn('addOnCatCreator', $function->ownerId())->get();
        $foodCategory = FoodCategory::whereIn('foodCatCreator', $function->ownerId())->get();
        $sizes = Size::whereIn('sizeCreator', $function->ownerId())->get();
        $dishes = Dish::whereIn('dishCreator', $function->ownerId())->get();
        return view('foodItem.create', compact('addOnItem', 'addOnCategory', 'foodCategory', 'sizes', 'dishes'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'foodItemName' => 'required|string',
            'foodItemDescription' => 'required|string',
            'size' => 'required|array',
            'price' => 'required|array',
            'foodItemImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
            'foodItemStatus' => 'required|in:Active,InActive',
            'foodItemPosterImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:7000',
        ]);
        if (count($request->input('size')) !== count(array_unique($request->input('size')))) {
            $errors = 'Duplicate size values selected';
            return back()->withErrors($errors);
        }
        $image = $request->file('foodItemImage');
        $posterImage = $request->file('foodItemPosterImage');
        $foodItemName = $request->input('foodItemName');
        $foodItemNameArabic = $request->input('foodItemNameInArabic');
        $path = public_path('images/foodItem/' . $foodItemName . '.jpg');
        $posterImagepath = public_path('images/foodItem/' . 'poster_' . $foodItemName . '.jpg');

        Image::make($image)->orientate()->encode('jpg')->save($path);
        Image::make($posterImage)->orientate()->encode('jpg')->save($posterImagepath);

        if (file_exists($path) && file_exists($posterImagepath)) {
            FoodItem::create([
                'foodItemName' => $foodItemName,
                'foodItemNameInArabic' => $foodItemNameArabic,
                'foodItemDescription' => request('foodItemDescription'),
                'foodItemDescriptionInArabic' => request('foodItemDescriptionInArabic'),
                'foodItemStatus' => request('foodItemStatus'),
                'foodItemCreator' => Auth::id(),
            ]);
            flash('FoodItem Successfully Added')->success();
        }

        // Making-relations
        $foodItem = FoodItem::orderBy('created_at', 'desc')->first();

        $foodItem->add_on_item()->sync($request->input('addOnItem'));
        $foodItem->food_category()->sync($request->input('foodCategory'));
        $foodItem->dish()->sync($request->input('dish'));
        foreach ($request->input('size') as $i => $size) {
            foreach ($request->input('price') as $j => $price) {
                if ($i == $j) {
                    $foodItem->size()->attach($size, ['price' => $price]);
                    break;
                }
            }
        }
        return redirect(route('foodItem.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($dish)
    {
        $function = new Functions();
        $addOnItem = AddOnItem::whereIn('addOnItemCreator', $function->ownerId())->with('category')->get();
        $addOnCategory = AddOnCategory::whereIn('addOnCatCreator', $function->ownerId())->get();
        $foodCategory = FoodCategory::whereIn('foodCatCreator', $function->ownerId())->get();
        $sizes = Size::whereIn('sizeCreator', $function->ownerId())->get();
        $dishes = Dish::whereIn('dishCreator', $function->ownerId())->get();

        $foodItems = new FoodItem();
        $foodItem = $foodItems->getFooditemDetails($dish);
        return view('foodItem.edit', compact('foodItem', 'addOnItem', 'addOnCategory', 'foodCategory', 'sizes', 'dishes'));

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
            return redirect(route('foodItem.index'));
        }
    }
    //Update Fooditem
    public function updateFoodItem(Request $request, $dish)
    {

        $this->validate(request(), [
            'foodItemName' => 'required|string',
            'foodItemDescription' => 'required|string',
            'size' => 'required|array',
            'price' => 'required|array',
            'foodItemStatus' => 'required|in:Active,InActive',

        ]);
        if (preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->input('foodItemName'))) {
            Session::flash('foodItem_err', "Invalid Food Item Name");
            return redirect('foodItem/edit/' . $dish);

        } else {
            $oldFoodItem = FoodItem::where('id', '=', $dish)->get()->first()->toArray();
            $oldFoodItemName = $oldFoodItem['foodItemName'];
            $newFoodItemName = $request->input('foodItemName');
            $oldpath = public_path('images/foodItem/' . $oldFoodItemName . '.jpg');
            $targetpath = public_path('images/foodItem/' . $newFoodItemName . '.jpg');

            $updateFoodItem = FoodItem::where('id', '=', $dish)
                ->update(['foodItemName' => $request->input('foodItemName'),
                    'foodItemDescription' => $request->input('foodItemDescription'),
                    'foodItemNameInArabic' => $request->input('foodItemNameInArabic'),
                    'foodItemDescriptionInArabic' => $request->input('foodItemDescriptionInArabic'),
                    'foodItemStatus' => $request->input('foodItemStatus'),
                ]);

            DB::table('addonitem_fooditem')->where('foodItem_id', '=', $dish)->delete();
            if (!empty($request->input('addOnItem'))) {
                foreach ($request->input('addOnItem') as $value) {
                    DB::table('addonitem_fooditem')->insert(
                        ['addOnItem_id' => $value, 'foodItem_id' => $dish]
                    );
                }
            }

            DB::table('foodcategory_fooditem')->where('foodItem_id', '=', $dish)->delete();
            if (!empty($request->input('foodCategory'))) {
                foreach ($request->input('foodCategory') as $value) {
                    DB::table('foodcategory_fooditem')->insert(
                        ['foodCategory_id' => $value, 'foodItem_id' => $dish]
                    );}
            }
            if (!empty($request->input('size'))) {
                DB::table('size_fooditem')->where('foodItem_id', '=', $dish)->delete();
                foreach (array_unique($request->input('size')) as $i => $size) {
                    foreach (array_unique($request->input('price')) as $j => $price) {
                        if ($i == $j) {

                            DB::table('size_fooditem')->insert(
                                ['size_id' => $size, 'price' => $price, 'foodItem_id' => $dish]
                            );
                        }
                    }
                }
            }
            if (empty($request->file('foodItemImage'))) {
                if (!file_exists($targetpath)) {
                    $result = File::move($oldpath, $targetpath);
                }
            }
            if (!empty($request->file('foodItemImage'))) {
                $image = $request->file('foodItemImage');
                $path = public_path('images/foodItem/' . $request->input('foodItemName') . '.jpg');
                Image::make($image)->orientate()->encode('jpg')->save($path);
            }
            if (!empty($request->file('foodItemPosterImage'))) {
                $image = $request->file('foodItemPosterImage');
                $path = public_path('images/foodItem/' . $request->input('foodItemPosterImage') . '.jpg');
                Image::make($image)->orientate()->encode('jpg')->save($path);
            }
            Session::flash('edit_success', "Food Item edited Successfully");
            return redirect(route('foodItem.index'));
        }
    }

    public function destroy($id)
    {

        $item = FoodItem::find($id);
        $path = public_path('images/foodItem/' . $item->foodItemName . '.jpg');
        if ($path) {
            $result = File::delete($path);
        }

        $item->delete();

        flash('Food Item Successfully Deleted')->error();

        return redirect(route('foodItem.index'));
    }
}
