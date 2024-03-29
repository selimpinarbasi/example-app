<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    //ne için yaptığımı hatırlamıyorum. BAK!!!
    public function getNews(){
        return $this->hasMany(News::class, 'category_id');
    }

}
