<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Answer;
use App\Models\Admin\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::paginate(5);
        return view('admin.email.index', compact('emails'));
    }
    public function seeAllEmails(Email $email)
    {
        $messages = Answer::where('email_id', $email->id)->get();
        return view('admin.email.chat', compact('email', 'messages'));

        /* $validated = $request->validate([
            'name' => 'required|max:255|min:1',
            'email' => 'required|email',
            'message'=>'required|min:5',
        ]);

        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        Mail::to('biriuk.yevhenii@gmz31.com')->send(new ContactEmail($name, $email, $message));

        return redirect('/contacts'); */
    }
    public function answerEmail(Request $request)
    {
        $answer = Answer::create($request->all());

        $email = Email::find($request->id);
        $email->read = 1;
        $email->save();

        //отправка ответа на почту

        $name = $request->name;
        $em = $request->email;
        $message = $request->message;
        $email_to = $request->email_to;
        Mail::to($email_to)->send(new ContactEmail($name, $em, $message, 0));
        return redirect()->back();
    }
}
