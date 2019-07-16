<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

 /**
 * Class Document
 *
 *
 *
 * @property integer    $id Document ID
 * @property string     $name Document name
 * @property string     $type Document type
 * @property integer    $size Document size
 * @property date       $upload_date
 *
 * @package App\Models
 */
class Document extends Model
{
    protected  $table = 'document';
    public $timestamps = false;

	/**
     * @var array
     */
	protected $fillable = ['id', 'name', 'type', 'size', 'upload_date', 'category_id', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}