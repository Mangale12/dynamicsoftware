<?php

namespace App\Http\Controllers;

use App\Models\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailToContact;
use App\Mail\MailToAdmin;
use App\Models\Team;
use App\Models\Category;
use App\Models\Gallery;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->category){
            // $category = Category::where('id', $request->category)->first();
            $gallery = Gallery::where('category_id',$request->category)->take(10)->get();
        }else{
            $gallery = Gallery::take(10)->get();
        }

        $categories = Category::get();
        $teams = Team::get();
        return view('frontend.index',compact('teams','gallery','categories'));
    }

    public function gallery(Request $request){
        $gallery = Gallery::get();
        $categories = Category::get();
        if($request->category){
            $category = Category::where('slug',$request->category)->first();
            $gallery = Gallery::where('category_id',$category->id)->get();
        }
        return view('frontend.gallery',compact('gallery','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FrontEnd $frontEnd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FrontEnd $frontEnd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FrontEnd $frontEnd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FrontEnd $frontEnd)
    {
        //
    }

    public function contactForm(){

        return view('frontend.contact_form');
    }
    public function contactFormStore(Request $request){
        // dd("test");
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'address'=>'required',
        ]);
        $contact = Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'address'=>$request->address,
            "subject"=>$request->subject,
            "message"=>$request->message,
            "team_assigned"=>0,
        ]);
        $data = [
            'name'=>$request->name,
            'subject'=>"New Contact",
        ];

        try{
            Mail::to("mangaletamang65@gmail.com")->send(new MailToContact(json_encode($data)));
            Mail::to("mangaletamang65@gmail.com")->send(new MailToAdmin(json_encode($data)));
            // Mail::to($form->email)->send(new MailToAdmin(($details)));
        }
        catch(\Exception $e){
            dd($e);
        }
        return redirect()->route("frontend.home");
    }

    public function contactUsFormStore(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'subject'=>'required',
        ]);

    }
    public function teamDetails(Request $request, $slug){
        $categories = Category::get();
        $team = Team::where('slug',$slug)->first();
        return view('frontend.team', compact('team','categories'));
    }
}
