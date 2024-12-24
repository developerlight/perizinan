<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $tables = 'teachers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'nip',
        'nama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
