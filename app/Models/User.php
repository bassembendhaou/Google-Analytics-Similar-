<?php

namespace App\Models;

use App\Traits\ApplyQueryScopes;
use App\Traits\SoftDelete;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property int created_at
 * @property int updated_at
 * @property int deleted_at
 */
class User extends Authenticatable
{
    use SoftDeletes,SoftDelete, HasApiTokens, HasFactory, Notifiable, ApplyQueryScopes;

    /**
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * RELATIONS
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }


    /**
     * SCOPES
     */


    /**
     * @param $query
     * @param $deleted
     * @return mixed
     */
    public function scopeFilterByDeleteStatus($query, $deleted)
    {
        if (isset($deleted) && !$deleted)
            $query = $query->whereNull('deleted_at');
        if (isset($deleted) && $deleted)
            $query = $query->whereNotNull('deleted_at');
        return $query;
    }

    /***
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeFilterByKeyword($query, $keyword)
    {
        if (isset($keyword)) {
            $query->where(function ($subQuery) use ($keyword)
            {
                $subQuery->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query;
    }
}
