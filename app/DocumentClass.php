<?php

namespace App;

use Illuminate\Support\Facades\View;
use App\Model\Document;

class DocumentClass
{
    public static function FileDelete($id) 
    { 
        $document =  Document::Find($id);
        $doc = $document->toArray();
        unlink(storage_path('app/file/'.$doc['name']));
        $document->delete();
    }

}