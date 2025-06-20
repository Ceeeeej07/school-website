<?php

namespace App\Models;


use App\Models\Status;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [

        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
