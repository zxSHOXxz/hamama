<?php

namespace App\Actions\Fortify;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Client
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(Client::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();
        $clients = new Client();
        $clients->email = $input['email'];
        $clients->password = Hash::make($input['password']);
        $isSaved = $clients->save();
        $users = new User();
        $users->image = '1671747271image.jpg';
        $users->name = $input[('name')];
        $users->mobile = $input[('mobile')];
        $clients->assignRole('عميل عادي');
        $users->gender = $input[('gender')];
        $users->address = $input[('address')];
        $users->actor()->associate($clients);
        $isSaved = $users->save();
        return $clients;
    }
}