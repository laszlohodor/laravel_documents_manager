<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * Felhasználó osztály
 *
 *
 * @property int    $id The table associated with the model.
 * @property string $name The name of the user
 * @property int    $categories Users categories
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
	protected $fillable = ['id', 'name', 'categories'];

  //  public function setName($value)
  //  {
  //      return $this->name($value);
  //  }



	/**
    * Returns documents
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }

    /**
     * Returns category relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }




}