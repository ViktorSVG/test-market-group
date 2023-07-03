<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class Positions extends Model
{
    public $timestamps = false;

    protected $table = 'positions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];
}
