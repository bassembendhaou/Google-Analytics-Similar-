<?php

namespace App\Models;

use App\Traits\ApplyQueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Visit
 * @package App\Models
 * @property int id
 * @property unsignedBigInteger user_id
 * @property text url
 * @property string ip
 * @property string country
 * @property string browser
 * @property text user_agent
 * @property tinyInteger device_type
 * @property int created_at
 * @property int updated_at
 */
class Visit extends Model
{
    use SoftDeletes, HasFactory, ApplyQueryScopes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visits';

    /**
     *  an array define all possible device type
     */
    const DEVICE_TYPE = [
        'DESKTOP' => 1,
        'TABLET' => 2,
        'SMARTPHONE' => 3
    ];


    /**
     * RELATIONS
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * SCOPES
     */


    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeFilterByDeviceType($query,$type)
    {
        if(isset($type)){
            $query = $query->where('device_type',$type);
        }
        return $query;
    }

    /**
     * @param $query
     * @param $browser
     * @return mixed
     */
    public function scopeFilterByBrowser($query,$browser)
    {
        if(isset($browser)){
            $query = $query->where('browser',$browser);
        }
        return $query;
    }


    /**
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeFilterByUser($query,$userId)
    {
        if(isset($userId)){
            $query = $query->where('user_id',$userId);
        }
        return $query;
    }
}
