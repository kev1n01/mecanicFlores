<?php

namespace App\Actions\Fortify;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'ruc' => ['required', 'string', 'max:11','min:11', 'unique:users'],
            'dni' => ['required', 'string', 'max:8','min:8', 'unique:users'],
            'phone' => ['required', 'string', 'max:9','min:9', 'unique:users'],
            'address' => ['nullable', 'string', 'max:50', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'ruc' => $input['ruc'],
            'dni' => $input['dni'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'user_status_id' => 1
        ])->assignRole('cliente');
    }
}
