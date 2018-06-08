<?php

namespace App\Http\Controllers;

use App\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{

    public function edit($id)
    {
        $policy = Policy::find($id);
        if ($id == 1) {
            return view('policy.edit', compact('policy'));
        } else {
            return view('policy.bufferTime', compact('policy'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'policy' => 'required|string',
        ]);

        $policy = Policy::find($id);
        $v = $request->all();
        $policy->update($v);
        if ($id == 1) {
            flash('Policy Successfully Updated')->success();
        } else {
            flash('Buffer Time Successfully Updated')->success();

        }

        return redirect(route('admin.index'));

    }

}
