<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    use EntrustUserTrait;

    protected $table = 'users';
}
