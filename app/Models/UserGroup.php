<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * @property integer $id
 * @property integer $level
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class UserGroup extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['level', 'user_id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
