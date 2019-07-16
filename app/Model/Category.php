<?php
/**
 * Created by PhpStorm.
 * User: hodorlaszlo
 * Date: 2019. 04. 24.
 * Time: 14:49
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use App\Model\Document;

/**
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

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function categoryDocument()
    {
        return $this->hasMany(Document::class, 'category_id', 'id');
    }
}