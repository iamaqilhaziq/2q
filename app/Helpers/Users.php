<?php

namespace App\Helpers;

use App\Models\User;

class Users
{
    const TYPE_ADMIN = 'admin';

    protected $user_type_with_guard = [
        self::TYPE_ADMIN => 'admin'
    ];

    public static function instance()
    {
        return new self();
    }

    public function getUserTypes(): array
    {
        // sequence must follow exact the same as the sequence of guards in getGuards function

        return [
            self::TYPE_ADMIN,
        ];
    }

}
