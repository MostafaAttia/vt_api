<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
use App\Role;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {

        $roles = $user->roles;

        return [
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $roles,
            'added' => date('Y-m-d', strtotime($user->created_at))
        ];
    }
}