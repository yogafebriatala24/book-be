<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'book';
    protected $fillable = ['title', 'description', 'image_url', 'release_year', 'price', 'total_page', 'thickness', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class, "category_id", "id");

    }
}