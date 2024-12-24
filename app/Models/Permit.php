<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;
    
    protected $tables = 'permits';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'tanggal_mulai',
        'keterangan',
        'img',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
