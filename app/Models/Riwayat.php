<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $fillable = [
        'friends_id', 'groups_id', 'activity', 'date'
    ];

    protected $table = 'riwayat';
    public $timestamps = false;

    public function friends()
    {
        return $this->belongsTo(Friends::class, 'friends_id', 'id');
    }

    public function groups()
    {
        return $this->belongsTo(Groups::class, 'groups_id', 'id');
    }
}
