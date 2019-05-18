<?php
/**
 * Created by PhpStorm.
 * User: hodorlaszlo
 * Date: 2019. 04. 24.
 * Time: 14:49
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * Dokumentum osztály
 *
 *
 * @property integer    $id Category's Id
 * @property string     $name Category's name
 * @property integer    $parent_id Category's parent

 *
 * @package App\Models
 */
class Category extends Model
{

    protected $table = 'category';
    public $timestamps = false;

	/**
     * @var array
     */
	protected $fillable = ['id', 'name', 'parent_id'];


    public function categories()
    {
        return $this->hasMany('Document::class', 'category_id');
    }


}