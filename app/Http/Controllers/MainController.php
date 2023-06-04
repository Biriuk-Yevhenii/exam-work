<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Admin\Comment;
use App\Models\Admin\Email;
use App\Models\Catalog;
use App\Models\Mailing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::limit(2)->get();
        $new_arrivals = Catalog::orderByDesc('created_at')->take(4)->get();
        $mens_clothes = Catalog::where('category_id', 1)->orderByRaw('RAND()')->limit(4)->get();
        return view('home', compact('categories', 'new_arrivals', 'mens_clothes'));
    }

    public function contacts()
    {
        return view('contacts');
    }
    public function sendMail(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:1',
            'email' => 'required|email',
            'message'=>'required|min:5',
        ]);

        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $db_email = Email::create($request->all());
        $db_email->save();

        //Mail::to('biriuk.yevhenii@gmz31.com')->send(new ContactEmail($name, $email, $message));

        return redirect('/contacts');
    }
    public function search(Request $request)
    {
        $searcHText = $request->q;
        $comments = Comment::all();
        $max_price = Catalog::max('price'); /* Max price */
        $catalogs = Catalog::where('title', 'LIKE', "%$searcHText%")->orWhere('content', 'LIKE', "%$searcHText%")->paginate(16); 
        $catalogs->appends(['q'=>$searcHText]);
        return view('search', compact('searcHText', 'catalogs', 'comments', 'max_price'));
    }
    public function searchAjax(Request $request)
    {
        $searcHText = $request->q;
        $comments = Comment::all();
        $catalogs = Catalog::where('title', 'LIKE', "%$searcHText%")->orWhere('content', 'LIKE', "%$searcHText%")->paginate(3); 
        return response()->json($catalogs);
    }

    public function mailingAddToDb(Request $request)
    {
        Mailing::create($request->all());
    }
}
