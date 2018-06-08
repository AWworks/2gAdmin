<?php

namespace App\Http\Controllers;

use App\AddOnCategory;
use App\AddOnItem;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AddOnItemController extends Controller
{

    public function index()
    {
        $path = public_path('images/AddOn/');
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $function = new Functions();
        $addOnItem = AddOnItem::whereIn('addOnItemCreator', $function->ownerId())->with(['user', 'category'])->get();
        return view('addOnItem.index', compact('addOnItem'));
    }

    public function create()
    {
        $function = new Functions();
        $addOnCategory = AddOnCategory::whereIn('addOnCatCreator', $function->ownerId())->get();
        return view('addOnItem.create', compact('addOnCategory'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'addOnItemName' => 'required|string|max:255|unique:add_on_items,addOnItemName',
            'addOnItemDescription' => 'required',
            'addOnItemPrice' => 'required|numeric|max:255',
            'addOnItemImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
            'addOnItemStatus' => 'required|in:Active,InActive',
            'addOnItemNameInArabic' =>'string|max:255',
            'addOnItemDescriptionInArabic' => 'string|max:255',

        ]);

        // image_store
        $image = $request->file('addOnItemImage');
        $imageName = $request->input('addOnItemName');
        /*$category = AddOnCategory::find($request->input('addOnItemCategory'));*/
        $path = public_path('images/AddOn/' . $imageName . '.jpg');

        Image::make($image)->orientate()->encode('jpg')->save($path);

        if (file_exists($path)) {
            AddOnItem::create([
                'addOnItemName' => $imageName,
                'addOnItemDescription' => request('addOnItemDescription'),
                'addOnItemPrice' => request('addOnItemPrice'),
                'addOnItemStatus' => request('addOnItemStatus'),
                'addOnItemCreator' => \Auth::id(),
                'addOnItemNameInArabic' => request('addOnItemNameInArabic'),
                'addOnItemDescriptionInArabic' => request('addOnItemDescriptionInArabic'),
            ]);

            $category = $request->input('addOnItemCategory');
            $addOnCategory = AddOnItem::orderBy('created_at', 'desc')->first();
            $addOnCategory->category()->sync($category);

            flash('AddOnItem Successfully Added')->success();
        }
        return redirect(route('addOnItem.index'));
    }

    public function show($id)
    {
        /*$temp = explode('-', $id);
        $id = end($temp);
        $photos = Photo::with('category')->where('imageCategory', '=', $id)->get();
        return view('photos.show', compact('photos'));*/
    }

    public function edit($addOnItem)
    {
        $function = new Functions();
        $addOnCategory = AddOnCategory::whereIn('addOnCatCreator', $function->ownerId())->get();
        $addOnItem = AddOnItem::find($addOnItem);

        return view('addOnItem.edit', compact('addOnItem', 'addOnCategory'));
    }

    public function update(Request $request, $addOnItem)
    {
        $this->validate(request(), [
            'addOnItemName' => 'required|string|max:255',
            'addOnItemDescription' => 'required',
            'addOnItemPrice' => 'required|string|numeric|max:255',
            'addOnItemImage' => 'image|mimes:jpeg,png,jpg,gif|max:3000',
            'addOnItemStatus' => 'required|in:Active,InActive',
        ]);
        try{
            $addOnItem = AddOnItem::find($addOnItem);
            $category = $request->input('addOnItemCategory');
            $addOnItem->category()->sync($category);

            $image = $request->file('addOnItemImage');
            $cond1 = $request->input('addOnItemName') != $addOnItem->addOnItemName;
            $oldpath = public_path('images/AddOn/' . $addOnItem->addOnItemName . '.jpg');
            $targetpath = public_path('images/AddOn/' . $request->addOnItemName . '.jpg');
            $result = null;

            //file not changed
            if (is_null($image)) {
                $result = true;
                if ($cond1) {
                    $result = File::move($oldpath, $targetpath);
                }
                if ($result) {
                    $v = $request->except(['addOnItemImage', 'addOnItemCategory']);
                    $addOnItem->update($v);
                    flash('AddOnItem Successfully Updated')->success();
                }
                //file changed
            } else {
                File::delete($oldpath);
                Image::make($image)->orientate()->encode('jpg')->save($oldpath);
                $result = true;
                if ($cond1) {
                    $result = File::move($oldpath, $targetpath);
                }
                if ($result) {
                    $v = $request->except(['addOnItemImage', 'addOnItemCategory']);
                    $addOnItem->update($v);
                    flash('AddOnItem Successfully Updated')->success();
                }
            }
        }catch(\Exception $ex){
            if($ex->getCode() == 23000){
                flash('AddOnItem with Same Name already Exists')->error();
            }
        }
        return redirect(route('addOnItem.index'));
    }

    public
    function destroy($id)
    {
        $addOnItem = AddOnItem::find($id);
        $path = public_path('images/AddOn/' . $addOnItem->addOnItemName . '.jpg');
        $result = File::delete($path);
        if ($result) {
            $addOnItem->delete();
            flash('AddOnItem Successfully Deleted')->error();
        }
        return redirect(route('addOnItem.index'));
    }

}
