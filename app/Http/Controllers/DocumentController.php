<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Document;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\DocumentClass;


class DocumentController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function FileDownload(Request $request)
    { 
        $document =  Document::Find($request->input('documentId'))->toArray();
        $pathToFile = storage_path('app/file/'.$document['name']);
		return response()->download($pathToFile);
    }
  
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function FileDelete(Request $request) 
    { 
        DocumentClass::FileDelete($request->input('documentId'));
        return back();
    }
    
     /**
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
	public function FileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10000',
        ]);
        $fileName = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('file', $fileName) ? $upload=true : $upload = false;

        $newFile = New Document();
        $newFile->name = $_FILES['file']['name'];
        $newFile->type =$_FILES['file']['type'];
        $newFile->size =$_FILES['file']['size'];
        $newFile->upload_date = Carbon::now()->format('Y-m-d');
        $newFile->category_id =$request->input('category');
        $newFile->user_id =$request->input('user');

        if($newFile->save() && $upload)
        {
            return redirect()->back()->with('alert', 'Sikeres mentés!');
        } else {
            return redirect()->back()->with('alert', 'Sikertelen mentés!');
        }
    }
		
	
}