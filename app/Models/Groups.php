<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    protected $guarded = ['name', 'total_users_join', 'total_users_leave'];

    public function friends()
    {
        return $this->hasMany(Friends::class);
    }

    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }
}
