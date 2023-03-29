<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Item;

/**
 * @property integer $id
 * @property string $img_path
 * @property integer $item_id
 * @property string $created_at
 * @property string $updated_at
 */
class Image extends Model
{

    protected $table = 'images';
    protected $primary = 'id';

    /**
     * @var array
     */
    protected $fillable = ['img_path', 'item_id', 'created_at', 'updated_at'];

    public function item()
    {
        $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
