<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{
    public function admin()
    {
        $categories = Category::all();
        $contacts = Contact::Paginate(7);
        return view('admin', compact('categories', 'contacts'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        if (!empty($request->gender)) $params['gender'] = $request->gender;
        if (!empty($request->category_id)) $params['category_id'] = $request->category_id;
        if (!empty($request->date)) $params['created_at'] = $request->date;

        if (!empty($params)) {
            if (!empty($request->keyword)) {
                $contacts = Contact::where($params)->where(function ($query) use ($request) {
                    $query->where('email', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                })->paginate(7);
            } else {
                $contacts = Contact::where($params)->paginate(7);
            }
        } else {
            if (!empty($request->keyword)) {
                $contacts = Contact::where(function ($query) use ($request) {
                    $query->where('email', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                })->paginate(7);
            } else {
                $contacts = Contact::Paginate(7);
            }
        }

        return view('admin', compact('categories', 'contacts'));
    }
}
