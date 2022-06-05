<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
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
    
    public function addForm($type, $id=null){
        $data = array();
        $data["type"] = base64_decode($type);
        $data["user"] = array();
        if($id !== null && $id > 0)
            $data["user"] = User::where('id', $id)->get();

        return view('admin.settings.user-add')->with($data);
    }
    
    /**
     * Validate and create a new user from admin panel
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($request->id),],
            'mobile' => ['required', 'string', 'min:11', 'max:13', Rule::unique(User::class)->ignore($request->id),],
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
        $save_data = array(
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
        );
        try {
            if($request->id){
                User::where('id', $request->id)->update($save_data);
                $request->session()->flash('status','User update successfully.');
            }
            else{
                $save_data['email_verified_at'] = date("Y-m-d H:i:s", time());
                $save_data['password'] = Hash::make($request->password);
                User::insert($save_data);
                $request->session()->flash('status','User added successfully.');
            }
        
            return redirect('/settings/users');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/settings/users/addForm/'.base64_encode($request->post_type));
        }
    }

    public function remove($id, Request $request){
        if(User::where('id', $id)->delete())
            $request->session()->flash("status", "User delete successfully!!!");
        else
            $request->session()->flash("status", "User delete error!!!");
        
        return redirect('/settings/users');
    }

    /**
     * User Role Management
     */
    public function role(){
        $data["role"] = Role::all();
        return view('admin.settings.role')->with($data);
    }

    public function roleForm($id=null){
        $data = array();
        $data["role"] = array();
        if($id !== null && $id > 0){
            $data["role"] = Role::where('id', $id)->get();
            $data["type"] = "edit";
        }
        else{
            $data["type"] = "add";
        }

        return view('admin.settings.role-add')->with($data);
    }

    public function roleSave(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);
        
        $save_data = array(
            'name' => $request->name,
            'access' => join('', $request->crud),
        );
        try {
            if($request->id){
                Role::where('id', $request->id)->update($save_data);
                $request->session()->flash('status','Role update successfully.');
            }
            else{
                Role::insert($save_data);
                $request->session()->flash('status','Role added successfully.');
            }
        
            return redirect('/settings/role');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/settings/users/roleForm');
        }
    }

    public function roleRemove($id, Request $request){
        if(Role::where('id', $id)->delete())
            $request->session()->flash("status", "Role delete successfully!!!");
        else
            $request->session()->flash("status", "Role delete error!!!");
        
        return redirect('/settings/role');
    }
}
