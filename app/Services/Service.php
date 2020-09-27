<?php

namespace App\Services;

use App\Models\User;

class Service
{
    public function countUsers($auth)
    {
        return User::where('auth', $auth);
    }
}
