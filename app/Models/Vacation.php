<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $users_id
 * @property string $date_from
 * @property string $date_to
 * @property bool $approved
 * @property string $approved_date
 */
class Vacation extends Model
{
    public $timestamps = false;

    protected $table = 'vacations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'users_id',
        'date_from',
        'date_to',
        'approved',
        'approved_date'
    ];

    public static function availableVacation(array $data):bool
    {
        $query = static::query()
            ->where('users_id', $data['users_id'])
            ->where(function($query) use ($data){
                $query->where(function ($query) use ($data) {
                        $query->where('date_from', '<', $data['date_from'])
                            ->where('date_to', '>', $data['date_from']);
                    })
                    ->orWhere(function ($query) use ($data) {
                        $query->where('date_from', '<', $data['date_to'])
                            ->where('date_to', '>', $data['date_to']);
                    })
                    ->orWhere(function ($query) use ($data) {
                        $query->where('date_from', '>=', $data['date_from'])
                            ->where('date_to', '<=', $data['date_to']);
                    });
            });
        if ((int)$data['id']) {
            $query->where('id', '<>', $data['id']);
        }
        return $query->count() === 0;
    }

    public static function createRow(array $data): int
    {
        $row = new static($data);
        $row->approved = false;
        $row->save();
        return $row->id;
    }

    public static function updateRow(int $id, array $data)
    {
        static::query()
            ->where('id', $id)
            ->update([
                'date_from' =>$data['date_from'],
                'date_to' =>$data['date_to']
            ]);
    }

    public static function approve(int $id, bool $approve)
    {
        static::query()
            ->where('id', $id)
            ->update([
                'approved' => $approve,
                'approved_date' => date('Y-m-d')
            ]);
    }

    public static function drop(int $id)
    {
        static::query()
            ->where('id', $id)
            ->delete();
    }
}
