<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $function = new Functions();
        $sizes = Size::whereIn('sizeCreator',$function->ownerId())->with('user')->get();
        return view('sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('sizes.create');
    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'sizeName' => 'required|string|max:255',
            'sizeNameInArabic' => 'string|max:255',
            'sizeStatus' => 'required|in:Active,InActive',
        ]);
        Size::create([
            'sizeName' => request('sizeName'),
            'sizeNameInArabic' => request('sizeNameInArabic'),
            'sizeStatus' => request('sizeStatus'),
            'sizeCreator' => \Auth::id(),
        ]);
        flash('Size Successfully Created')->success();

        return redirect(route('size.index'));
    }

    public function show($foodItem_id)
    {
        $sizeName = \DB::table('sizes')
        ->select('sizeName')
        ->join('size_fooditem', 'size_fooditem.size_id', '=', 'sizes.id')
        ->where('size_fooditem.foodItem_id', $foodItem_id)
        ->get();
        return response()->json([
                    'code' => '200',
                    'response' => $sizeName,
                ]);
    }

    public function edit($size)
    {
        $size = Size::find($size);
        return view('sizes.edit', compact('size'));
    }

    public function update(Request $request, $size)
    {
        $this->validate(request(), [
            'sizeName' => 'required|string|max:255',
            'sizeStatus' => 'required|in:Active,InActive',
        ]);

        $size = Size::find($size);
        $v = $request->all();
        $size->update($v);
        flash('Size Successfully Updated')->success();

        return redirect(route('size.index'));

    }

    public function destroy($size)
    {
        $size = Size::find($size);
        $size->delete();
        flash('Size Successfully Deleted')->error();

        return redirect(route('size.index'));
    }

}
