<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    // Tắt tính năng tự động quản lý các trường thời gian (created_at và updated_at)
    public $timestamps = false;

    // Đặt các trường có thể được gán giá trị thông qua Mass Assignment
    protected $fillable = [
        'provider_user_id', 'provider', 'user'
    ];

    // Đặt khóa chính của bảng là 'user_id' thay vì mặc định là 'id'
    protected $primaryKey = 'user_id';

    // Đặt tên bảng, mặc định là 'socials', nhưng bạn muốn sử dụng 'tbl_social'
    protected $table = 'tbl_social';

    /**
     * Mối quan hệ belongsTo với bảng 'Login'.
     * Mỗi bản ghi trong 'tbl_social' sẽ thuộc về một bản ghi trong bảng 'Login'.
     */
    public function login()
    {
        return $this->belongsTo('App\Models\Login', 'user');
    }
}
