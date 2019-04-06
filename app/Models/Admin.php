<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasRoles,
        Notifiable,
        HasApiTokens;

    protected $fillable = [
        'username', 'nickname', 'password', 'avatar'
    ];

    protected $guarded = [
        'is_super'
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * @use      [passport 登录所需用户]
     * @Author   ze
     * @date     2019/4/1 2:03 PM
     * @param $username
     * @return mixed
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * @use      [搜索条件昵称]
     * @Author   ze
     * @date     2019/4/1 2:03 PM
     * @param $query
     * @param $nickname
     * @return mixed
     */
    public function scopeNickname($query, $nickname)
    {
        return isset($nickname) ? $query->where('nickname', 'like', '%' . $nickname . '%') : $query;
    }
}
