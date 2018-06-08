<?php

namespace App\Http\Controllers;

use App\PaymentMode;
use Illuminate\Http\Request;

class PaymentModeController extends Controller
{
      public function index()
    {
        $paymentMode = PaymentMode::orderBy('updated_at', 'desc')->with('user')->get();
        return view('paymentMode.index', compact('paymentMode'));
    }

    public function create()
    {
        return view('paymentMode.create');
    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'paymentName' => 'required|string|max:255',
            'paymentStatus' => 'required|in:Active,InActive',
        ]);
        PaymentMode::create([
            'paymentName' => request('paymentName'),
            'paymentStatus' => request('paymentStatus'),
            'paymentCreator' => \Auth::id(),
        ]);
        flash('PaymentMode Successfully Created')->success();

        return redirect(route('paymentMode.index'));
    }

    public function show($post)
    {
        /*$temp = explode('-', $post);
        $id = end($temp);
        $post = Post::find($id);  //can be done like this also
        return view('posts.show', compact('post'));*/
    }

    public function edit($paymentMode)
    {
        $paymentMode = PaymentMode::find($paymentMode);
        return view('paymentMode.edit', compact('paymentMode'));
    }

    public function update(Request $request, $paymentMode)
    {
        $this->validate(request(), [
            'paymentName' => 'required|string|max:255',
            'paymentStatus' => 'required|in:Active,InActive',
        ]);

        $paymentMode = PaymentMode::find($paymentMode);
        $v = $request->all();
        $paymentMode->update($v);
        flash('PaymentMode Successfully Updated')->success();

        return redirect(route('paymentMode.index'));

    }

    public function destroy($paymentMode)
    {
        $paymentMode = PaymentMode::find($paymentMode);
        $paymentMode->delete();
        flash('PaymentMode Successfully Deleted')->error();

        return redirect(route('paymentMode.index'));
    }

}
