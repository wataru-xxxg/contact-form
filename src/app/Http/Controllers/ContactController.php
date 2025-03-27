<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', ['categories' => $categories]);
    }
    public function confirm(ContactRequest $request)
    {
        $form = $request->all();
        $category = Category::find($request->category_id);
        $form['category'] = $category;
        return view('confirm', ['form' => $form]);
    }
    public function thanks(Request $request)
    {
        if ($request->input('back') == 'back') {
            return redirect('/')
                ->withInput();
        }
        $form = $request->all();
        Contact::create($form);
        return view('thanks');
    }
}
