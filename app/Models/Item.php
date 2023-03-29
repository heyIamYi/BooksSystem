<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Image;
use App\Http\Models\User;

/**
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property string $introduction
 * @property integer $quantity
 * @property integer $price
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class Item extends Model
{
    protected $table = 'items';
    protected $primary = 'id';

    /**
     * @var array
     */
    protected $fillable = ['name', 'image', 'description', 'introduction', 'quantity', 'price', 'user_id', 'created_at', 'updated_at'];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images()
    {
       $this->hasMany(Image::class, 'item_id', 'id');
    }
}
