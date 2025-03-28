<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Carbon\Carbon;

use function PHPSTORM_META\type;

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
        if (!empty($request->gender)) {
            $params['gender'] = $request->gender;
            $search_parameters['gender'] = $request->gender;
        }
        if (!empty($request->category_id)) {
            $params['category_id'] = $request->category_id;
            $search_parameters['category_id'] = $request->category_id;
        }

        if (empty($params)) {
            if (empty($request->keyword)) {
                if (empty($request->date)) {
                    $contacts = Contact::Paginate(7);
                } else {
                    $contacts = Contact::wheredate('created_at', $request->date)->paginate(7);
                    $search_parameters['created_at'] = $request->date;
                }
            } else {
                if (empty($request->date)) {
                    $contacts = Contact::where(function ($query) use ($request) {
                        $query->where('email', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                    })->paginate(7);
                } else {
                    $contacts = Contact::wheredate('created_at', $request->date)->where(function ($query) use ($request) {
                        $query->where('email', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                    })->paginate(7);
                    $search_parameters['created_at'] = $request->date;
                }
            }
        } else {
            if (empty($request->keyword)) {
                if (empty($request->date)) {
                    $contacts = Contact::where($params)->paginate(7);
                } else {
                    $contacts = Contact::wheredate('created_at', $request->date)->where($params)->paginate(7);
                    $search_parameters['created_at'] = $request->date;
                }
            } else {
                if (empty($request->date)) {
                    $contacts = Contact::where($params)->where(function ($query) use ($request) {
                        $query->where('email', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                    })->paginate(7);
                    $search_parameters['keyword'] = $request->keyword;
                } else {
                    $contacts = Contact::wheredate('created_at', $request->date)->where($params)->where(function ($query) use ($request) {
                        $query->where('email', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                    })->paginate(7);
                    $search_parameters['keyword'] = $request->keyword;
                    $search_parameters['created_at'] = $request->date;
                }
            }
        }
        if (empty($search_parameters)) {
            return view('admin', compact('categories', 'contacts'));
        } else {
            return view('admin', compact('categories', 'contacts', 'search_parameters'));
        }
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect("/admin");
    }

    public function export(Request $request)
    {
        if (!empty($request->gender)) {
            $params['gender'] = $request->gender;
        }
        if (!empty($request->category_id)) {
            $params['category_id'] = $request->category_id;
        }

        if (empty($params)) {
            if (empty($request->keyword)) {
                if (empty($request->date)) {
                    $contacts = Contact::all();
                } else {
                    $contacts = Contact::wheredate('created_at', $request->date)->get();
                }
            } else {
                if (empty($request->date)) {
                    $contacts = Contact::where(function ($query) use ($request) {
                        $query->where('email', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                    })->get();
                } else {
                    $contacts = Contact::wheredate('created_at', $request->date)->where(function ($query) use ($request) {
                        $query->where('email', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                    })->get();
                }
            }
        } else {
            if (empty($request->keyword)) {
                if (empty($request->date)) {
                    $contacts = Contact::where($params)->get();
                } else {
                    $contacts = Contact::wheredate('created_at', $request->date)->where($params)->get();
                }
            } else {
                if (empty($request->date)) {
                    $contacts = Contact::where($params)->where(function ($query) use ($request) {
                        $query->where('email', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                    })->get();
                } else {
                    $contacts = Contact::wheredate('created_at', $request->date)->where($params)->where(function ($query) use ($request) {
                        $query->where('email', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%");
                    })->get();
                }
            }
        }

        $csvHeader = [
            'id',
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
            'created_at',
            'updated_at',
        ];
        $temps = [];
        array_push($temps, $csvHeader);

        foreach ($contacts as $contact) {
            $temp = [
                $contact->id,
                $contact->category_id,
                $contact->first_name,
                $contact->last_name,
                $contact->gender,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->detail,
                $contact->created_at,
                $contact->updated_at,
            ];
            array_push($temps, $temp);
        }
        $stream = fopen('php://temp', 'r+b');
        foreach ($temps as $temp) {
            fputcsv($stream, $temp);
        }
        rewind($stream);
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
        $now = Carbon::now();
        $filename = $now->format('Ymd') . ".csv";
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $filename,
        );
        return response()->make($csv, 200, $headers);
    }
}
