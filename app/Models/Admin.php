<?php

namespace App\Models;

use Database\Factories\AdminFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * @method bool hasRole(string $role)
 */
class Admin extends Authenticatable
{
    //
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_name','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

 	public function roles(){
 		return $this->belongsToMany('App\Models\Roles');
 	}
     public function getAuthPassword()
     {
        return $this->admin_password;
     }
       
    
 	/**
     * Kiểm tra nếu admin có bất kỳ role nào trong mảng $roles
     */
    public function hasAnyRoles($roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists(); // Trả về true nếu có ít nhất một role
    }

    /**
     * Kiểm tra nếu admin có role cụ thể
     */
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists(); // Trả về true nếu có role
    }
	 
}
