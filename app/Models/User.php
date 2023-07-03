<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property int $roles_id
 * @property int $positions_id
 * @property string $name
 * @property string $email
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'roles_id',
        'positions_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function allYearVacations(int $year):array
    {
        return DB::select('select
            u.id,
            max(u.name) as name,
            max(p.name) as position,
            group_concat(concat(v.id, \'>\', v.date_from, \'>\', v.date_to, \'>\', v.approved) order by v.date_from asc separator \'|\') as vacations
        from users u
        inner join positions p on u.positions_id = p.id
        left join (select * from vacations where EXTRACT(YEAR FROM date_from) = ? or EXTRACT(YEAR FROM date_to) = ?) v on v.users_id = u.id
        group by u.id', [$year, $year]);
    }

}
