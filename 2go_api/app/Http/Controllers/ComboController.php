<?php

namespace App\Http\Controllers;

use App\Combo;
use App\FoodItem;
use App\Merchant;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use Intervention\Image\Facades\Image;
use Session;

class ComboController extends Controller
{
    public function index()
    {
        $path = public_path('images/Combos');
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $function = new Functions();
        $combos = Combo::whereIn('comboCreator', $function->ownerId())->with(['user', 'foodItem'])->get();

        return view('combo.index', compact('combos'));
    }

    public function create()
    {
        $function = new Functions();
        $foodItem = FoodItem::whereIn('foodItemCreator', $function->ownerId())->get();
        return view('combo.create', compact('foodItem'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'comboName' => 'required|string|unique:combos,comboName',
            'comboDescription' => 'required|string',
            'comboImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
            'comboFoodItem' => 'required|array',
            'comboPrice' => 'required|string',
            'comboStatus' => 'required|in:Active,InActive',
            'comboNameInArabic' => 'string',
            'comboDescriptionInArabic' => 'string',
        ]);

        // image_store
        $image = $request->file('comboImage');
        $comboName = $request->input('comboName');
        $path = public_path('images/Combos/' . $comboName . '.jpg');

        Image::make($image)->orientate()->encode('jpg')->save($path);

        if (file_exists($path)) {
            Combo::create([
                'comboName' => $comboName,
                'comboDescription' => request('comboDescription'),
                'comboNameInArabic' => request('comboNameInArabic'),
                'comboDescriptionInArabic' => request('comboDescriptionInArabic'),
                'comboPrice' => request('comboPrice'),
                'comboStatus' => request('comboStatus'),
                'comboCreator' => Auth::id(),
            ]);
            flash('Combo Successfully Added')->success();
        }

        // Making-relations
        $combo = Combo::orderBy('created_at', 'desc')->first();
        $foodItem = $request->input('comboFoodItem');
        $combo->foodItem()->sync($foodItem);

        return redirect(route('combo.index'));
    }

    public function show($id)
    {
        $ids = null;
        $merchant = Merchant::where('id', $id)->with('owner')->first();
        if (!is_null($merchant)) {
            foreach ($merchant->owner as $owner) {
                $ids[] = $owner->id;
            }
            $combos = Combo::whereIn('comboCreator', $ids)->with(['user', 'foodItem'])->get();
            foreach ($combos as $combo) {
                $combo->comboPrice = number_format($combo->comboPrice, 3);
            }
            return response()->json([
                'success' => 'True',
                'code' => '200',
                'message' => 'Access Granted',
                'params' => $combos,
            ]);
        } else {
            return response()->json([
                'code' => '200',
                'response' => 'No data found.',
            ]);
        }

    }

    public function edit($id)
    {
        $function = new Functions();
        $foodItem = FoodItem::whereIn('foodItemCreator', $function->ownerId())->get();
        $combo = Combo::with('foodItem')->find($id);
        $selected = $combo->foodItem->pluck('foodItemName', 'id');
        return view('combo.edit', compact('combo', 'foodItem', 'selected'));
    }

    public function update(Request $request, $combo)
    {
        $this->validate(request(), [
            'comboName' => 'required|string',
            'comboDescription' => 'required|string',
            'comboImage' => 'image|mimes:jpeg,png,jpg,gif|max:3000|nullable',
            'comboFoodItem' => 'required|array',
            'comboPrice' => 'required|string',
            'comboStatus' => 'required|in:Active,InActive',
        ]);
        if (preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $request->input('comboName'))) {
            Session::flash('comboName_err', "Invalid Combo Name");
            return redirect('combo/' . $combo . '/edit')->withInput($request->input());

        } else {
            $combo = Combo::with('foodItem')->find($combo);
            $image = $request->file('comboImage');
            $nameChange = $request->input('comboName') != $combo->comboName;
            $oldpath = public_path('images/Combos/' . $combo->comboName . '.jpg');
            $targetpath = public_path('images/Combos/' . $request->comboName . '.jpg');
            $foodItem = request('comboFoodItem');
            //file not changed
            if (is_null($image)) {
                $result = true;
                if ($nameChange) {
                    if (!file_exists($targetpath)) {
                        $result = File::move($oldpath, $targetpath);
                    }
                }
                try {
                    if ($result) {
                        $combo->foodItem()->sync($foodItem);
                        $v = $request->except('comboImage', 'comboFoodItem');
                        $combo->update($v);
                        flash('Combo Successfully Updated')->success();
                        return $this->index();
                    }
                } catch (\Exception $ex) {
                    if ($ex->getCode() == 23000) {
                        flash('Combo with Same Name already Exists')->error();
                        return $this->index();
                    }
                }
                //file changed
            } else {
                try {
                    $combo->foodItem()->sync($foodItem);
                    $v = $request->except('comboImage', 'comboFoodItem');
                    $combo->update($v);
                    flash('Combo Successfully Updated')->success();
                    File::delete($oldpath);
                    Image::make($image)->orientate()->encode('jpg')->save($targetpath);
                } catch (\Exception $ex) {
                    if ($ex->getCode() == 23000) {
                        flash('Combo with Same Name already Exists')->error();
                    }
                }
                return redirect(route('combo.index'));
            }
        }
    }

    public function destroy($id)
    {
        $request  = Request::capture();
        $combo = Combo::find($id);
        $path = public_path('images/Combos/' . $combo->comboName . '.jpg');

        $result = File::delete($path);
        if ($result) {
            $combo->delete();
            if($request->hasHeader('authorization')== 'true'){
                return response()->json([
                    'code' => '200',
                    'response' => 'Combo Deleted Successfully',
                ]);
            }else{
                flash('Combo Successfully Deleted')->error();        
            }
        }
        return redirect(route('combo.index'));
    }
}
