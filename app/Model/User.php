<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Category;

/**
 * Class User
 * Felhasználó osztály
 *
 *
 * @property int    $id The table associated with the model.
 * @property string $name The name of the user
 * @property int    $file_dow User can download
 * @property int    $file_up User can upload
 * @property int    $file_del User can delete
 * @property json   $category Permission for user category
 *
 * @package App\Model
 */

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;

	/**
     * @var array
     */
	protected $fillable = ['id', 'name', 'file_dow', 'file_up', 'file_del', 'category'];


    protected $casts = [
        'category' => 'array'
    ];

	/**
    * Returns documents
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }


}