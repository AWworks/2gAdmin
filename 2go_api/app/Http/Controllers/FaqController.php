<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('updated_at', 'desc')->with('user')->get();
        $request = Request::capture();
        if ($request->hasHeader('Content-Type') == 'application/json') {
            return response()->json([
                'success' => 'True',
                'code' => '200',
                'message' => 'Access Granted',
                'params' => $faqs,
            ]);
        }
        return view('faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {

        $this->validate(request(), [
            'faqQuestion' => 'required|string',
            'faqAnswer' => 'required|string',
            'faqStatus' => 'required|in:Active,InActive',
        ]);
        Faq::create([
            'faqQuestion' => request('faqQuestion'),
            'faqAnswer' => request('faqAnswer'),
            'faqStatus' => request('faqStatus'),
            'faqCreator' => \Auth::id(),
        ]);
        flash('Faq Successfully Created')->success();

        return redirect(route('faq.index'));
    }

    public function show($post)
    {
        /*$temp = explode('-', $post);
        $id = end($temp);
        $post = Post::find($id);  //can be done like this also
        return view('posts.show', compact('post'));*/
    }

    public function edit($faq)
    {
        $faq = Faq::find($faq);
        return view('faq.edit', compact('faq'));
    }

    public function update(Request $request, $faq)
    {
        $this->validate(request(), [
            'faqQuestion' => 'required|string',
            'faqAnswer' => 'required|string',
            'faqStatus' => 'required|in:Active,InActive',
        ]);

        $faq = Faq::find($faq);
        $v = $request->all();
        $faq->update($v);
        flash('Faq Successfully Updated')->success();

        return redirect(route('faq.index'));

    }

    public function destroy($faq)
    {
        $faq = Faq::find($faq);
        $faq->delete();
        flash('Faq Successfully Deleted')->error();

        return redirect(route('faq.index'));
    }

}
