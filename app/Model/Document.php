<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

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
	protected $fillable = ['id', 'name', 'type', 'size', 'upload_date'];

    /**
     * Document size
     *
     * @var string
     */
    protected $size;

    /**
     * Document upload date
     *
     * @var string
     */
    protected $uploadDate;

    /**
     * Document category
     *
     * @var string
     */
    protected $category;

    /**
     * Document user upload
     *
     * @var string
     */
    protected $user;


    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }


}