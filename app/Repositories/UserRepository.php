<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findEmail($email)
    {
        return User::where('email', $email)->first();
    }
    
}
