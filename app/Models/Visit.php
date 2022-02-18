<?php

namespace App\Models;

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
    use SoftDeletes,HasFactory;

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
}
