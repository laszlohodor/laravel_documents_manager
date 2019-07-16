<?php

namespace App;

use Illuminate\Support\Facades\View;

class CategoryClass
{
    public static function permissionToCategory($category, $loginedUser){

        return in_array($category['id'], $loginedUser['category']);
    }

    public static function doTree($parent, $level = null){

        static $pArray = [];
        $category = $parent->toArray();
        $classnames = "level-".$level.' ';
        array_push($category, $classnames);
        array_push($pArray, $category);

        foreach($parent->children as  $child){
            self::doTree($child , $level+1);     
        }
        return  $pArray;
    }
}