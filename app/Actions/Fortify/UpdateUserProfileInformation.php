<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id), ],
            'mobile' => ['required', 'string', 'min:11', 'max:13', Rule::unique('users')->ignore($user->id), ],
            'gender' => ['string'],
            'nid' => ['string', 'nullable'],
            'dob' => ['date', 'nullable'],
            'father_name' => ['string', 'nullable'],
            'mother_name' => ['string', 'nullable'],
            'designation' => ['string', 'nullable'],
            'label' => ['string', 'nullable'],
            'bio' => ['string', 'nullable'],
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            if(! empty($_FILES["img"])){
                $basefile = date('YmdHi_'). basename($_FILES["img"]["name"]);
                $target_file = public_path('pro_pic\\') . $basefile;
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    $input['img'] = $basefile;
                } else {
                    $input['img'] = $input['old_img'];
                }
            }
            else{
                $input['img'] = $input['old_img'];
            }
            
            // if($request->file('img')){
            //     $file= $request->file('img');
            //     $filename= date('YmdHi').$file->getClientOriginalName();
            //     $file-> move(public_path('pro_pic'), $filename);
            //     $input['img'] = $filename;
            // }
            // else{
            //     $input['img'] = $input['old_img'];
            // }

            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'mobile' => $input['mobile'],
                'gender' => $input['gender'],
                'nid' => $input['nid'],
                'dob' => $input['dob'],
                'father_name' => $input['father_name'],
                'mother_name' => $input['mother_name'],
                'designation' => $input['designation'],
                'label' => $input['label'],
                'bio' => $input['bio'],
                'img' => $input['img'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
