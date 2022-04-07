<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Customer;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $designers = User::role('Designer')->get();

        return view('home',compact('designers'));
    }

    public function panel()
    {
        $user = auth()->user();

//        get photos
        $design_photos =  $user->getMedia('Design');

        $designers = User::role('Designer')->get();
        return view('panel',compact('user','designers','design_photos'));
    }

    public function changePrivacy()
    {

// env('APP_URL') = URL::to('/')

        $uuid_design = Str::after(url()->current(), env('APP_URL') . '/');
        $uuid_design = Str::before($uuid_design, '/change-privacy');

        $design = DB::table('media')->where(['uuid'=> $uuid_design]);
        if ($design->first() === null) {
            return back()->withErrors('عکس پیدا نشد!');
        }
//        return $design->first('privacy');
//

        $privacy = $design->where('privacy', '=', 'private')->first('privacy');
        if (isset($privacy) && $privacy->privacy == 'private' ) {
            DB::table('media')->where(['uuid'=> $uuid_design])->update(['privacy'=> 'public']);
        }
        elseif(isset($privacy) && $privacy->privacy == 'public' )
        {
            DB::table('media')->where(['uuid'=> $uuid_design])->update(['privacy'=> 'private']);
        }
        else {
            Session::flash('private_only', '.این طراحی صرفا دسترسی خصوصی دارد');
            return back();
        }
        return back();
    }

    public function customers()
    {
        $user = auth()->user();

        $customers = Customer::all();
        return view('customers',compact('user','customers'));
    }

    public function createCustomer(CreateCustomerRequest $request)
    {
        $designer_id = auth()->id();
        $username = $request->username;
        $password = $request->password;

        Customer::firstOrCreate(['designer_id'=>$designer_id,'username' => $username,'password' => $password]);

        return back();
    }

    public function photos()
    {
        $user = auth()->user();
        $designer_id = Str::after(url()->current(), env('APP_URL') . '/');
        $designer_id = Str::before($designer_id, '/photos');

        $designer = User::find($designer_id);

        $designer_photos = $designer->getMedia('Design');

        return view('photos', compact('designer','designer_photos','user'));
    }

    public function customerLogin(CustomerLoginRequest $request)
    {
        $designer_id = $request->designerID;

        $customer_login = Customer::whereUsername($request->username)->wherePassword($request->password)
            ->whereDesigner_id($designer_id)->first();

        if (isset($customer_login)) {
            $request->session()->put('customer-designer-'.$designer_id,$customer_login->username);
            return back();
        }else {
            Session::flash('invalid-credentials');
            return back();
        }

    }

    public function search(SearchRequest $request)
    {
        $tag_search = Tag::where('name', 'LIKE', "%{$request->search}%")->get();
        $designer_search = User::role('Designer')->where('name', 'LIKE', "%{$request->search}%")->get();

//        return $tag_search[0]->mediaTag[0]->media_id;


        $designers = User::role('Designer')->get();
        $searched = $request->search;
        return view('search-results', compact('tag_search', 'designer_search',
            'designers','searched'));
    }
}
