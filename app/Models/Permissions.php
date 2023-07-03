<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Permissions extends Model
{

    public $timestamps = false;

    protected $table = 'permissions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'roles_id',
        'action_name',
        'access',
    ];

    public static function access(string $actionName) : bool
    {
        return (bool)static::query()
            ->where('roles_id', Auth::user()->roles_id)
            ->where('action_name', $actionName)
            ->where('access', true)
            ->count();
    }
}
