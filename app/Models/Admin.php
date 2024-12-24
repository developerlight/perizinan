<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $tables = 'admins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'nama',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
