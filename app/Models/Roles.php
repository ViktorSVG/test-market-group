<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $description
 */
class Roles extends Model
{
    public $timestamps = false;

    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
    ];
}
