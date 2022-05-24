<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PasswordValidationRules;

class Users extends Controller
{
    public function index(){
        $data["users"] = User::all();
        return view('admin.settings.user')->with($data);
    }
    
    public function addForm(){
        return view('admin.settings.user-add');
    }
    
    /**
     * Validate and create a new user from admin panel
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function save(Request $request)
    {
        // file_put_contents("req.txt", $request->all());
        // dd($request->name, $request->email);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class),],
            'mobile' => ['required', 'string', 'min:11', 'max:13', Rule::unique(User::class),],
            'gender' => ['string'],
            'nid' => ['string', 'nullable'],
            'dob' => ['date', 'nullable'],
            'father_name' => ['string', 'nullable'],
            'mother_name' => ['string', 'nullable'],
            'designation' => ['string', 'nullable'],
            'label' => ['string', 'nullable'],
            'bio' => ['string', 'nullable'],
        ]);
        
        if($request->file('img')){
            $file= $request->file('img');
            $filename= date('YmdHi_').$file->getClientOriginalName();
            $file-> move(public_path('pro_pic'), $filename);
            $request->img = $filename;
        }
        else{
            $request->img = '';
        }
        
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'nid' => $request->nid,
            'dob' => $request->dob,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'designation' => $request->designation,
            'label' => $request->label,
            'bio' => $request->bio,
            'img' => $request->img,
            'email_verified_at' => date("Y-m-d H:i:s", time()),
            'password' => Hash::make($request->password),
        ]);
    
        return redirect('/users');
    }
}
