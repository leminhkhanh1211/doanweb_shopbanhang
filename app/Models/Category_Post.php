<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_Post extends Model
{
    //
    public $timestamps = false; // set time to false
    protected $fillable = [
        'cate_post_name', 'cate_post_status', 'cate_post_slug', 'cate_post_desc'
    ];
    protected $primaryKey = 'cate_post_id';
    protected $table = 'tbl_category_post';
    public function post()
    {
        // Định nghĩa quan hệ hasMany
        return $this->hasMany('App\Models\Post', 'cate_post_id', 'cate_post_id');
    }
}
