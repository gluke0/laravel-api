<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;


class Project extends Model
{
    use HasFactory;

    public static function addSlug($title)
        {
            return Str::slug($title, '-');
        }
        
        protected $fillable = ['title', 'slug', 'description', 'image', 'category_id', 'link',];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }



}
