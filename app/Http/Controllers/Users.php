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
        file_put_contents("req.txt", $request);
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class),],
        //     'mobile' => ['required', 'string', 'min:11', 'max:13', Rule::unique(User::class),],
        //     'password' => $this->passwordRules(),
        // ])->validate();

        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'mobile' => $input['mobile'],
        //     'password' => Hash::make($input['password']),
        // ]);
        // return to_route('users');
        return redirect('users');
    }
}
