<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function newsCollection()
    {
        return $this->hasMany(News::class, 'status_id');
    }
}
