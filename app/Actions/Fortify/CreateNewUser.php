<?php

namespace App\Actions\Fortify;

use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'firstname' => ['required', 'string', 'max:60'],
            'lastname' => ['required', 'string', 'max:60'],
            'username' => ['required','string', 'alpha_num', 'unique:users', 'min:6'],
            'mobile' => ['required', 'string', 'max:30', 'unique:users'],
            'country_code' => ['required'],
            'zip' => ['required', 'string', 'max:6'],
            'address' => ['required', 'string', 'max:255'],
            'town' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $gnl = GeneralSetting::first();
        $referBy = session()->get('reference');
        if ($referBy) {
            $referUser = User::where('username', $referBy)->first();
        } else {
            $referUser = null;
        }
        $user = new User();

        return User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'name' => $input['firstname'].' '.$input['lastname'],
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'username' => $input['username'],
            'mobile' => '+'.$input['country_code'].$input['mobile'],
            'country' => $input['country'],
            'zip' => $input['zip'],
            'address' => $input['address'],
            'town' => $input['town'],
            'city' => $input['city'],
            'ref_by' => $referUser ? $referUser->id : null,
            'status' => '1',
            'role_id' => '2',
            'ev' => $gnl->ev ? 0 : 1,
            'sv' => $gnl->sv ? 0 : 1,
        ]);

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = route('admin.users.detail',$user->id);
        $adminNotification->save();

    }
}
