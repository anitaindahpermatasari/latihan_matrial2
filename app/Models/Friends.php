<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Friends extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'no_tlp', 'alamat', 'jenis_kelamin', 'instagram', 'groups_id'
    ];

    public function groups()
    {
        return $this->belongsTo(Groups::class, 'groups_id', 'id');
    }

    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }

    public function links()
    {
        Paginator::useBootstrap();
    }
}
