<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\User;
use App\Model\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\CategoryClass;
use App\DocumentClass;

class CategoryController extends Controller
{

    public $selectedCategory;
    public $loginedUser;
    public $tree;

    public function __construct()
    {
        $this->loginedUser = User::find(1)->toArray();
        View::share(['loginedUser' => $this->loginedUser]);
    }

    public function CategoryDocument($id)
    {   
        self::MainCategory();
        $selectedCategory= Category::find($id);
        $categoryDocuments = $selectedCategory->categoryDocument;

        View::share([
            'categoryDocuments' => $categoryDocuments,
            'selectedCategory'=> $selectedCategory->toArray(),
            'categoryId' => $id,
        ]);

        return view('index');
    }

    public function NewMainCategory(Request $request)
    {
        $newCategory = new Category();
        $newCategory->name = $request->input('NewCategory');
        $newCategory->parent_id = 0;
        $newCategory->save();

        return redirect()->to('/'); 
    }

    public function NewSubCatOrChangeCatName(Request $request)
    {
        $id = $request->input('categoryId');

        if($request->input('deleteCategory'))
        {
            $deleteCategory = Category::find($id);
            $deleteCategorys = CategoryClass::doTree($deleteCategory);

            foreach ($deleteCategorys as $deleteId) 
            {
                $deleteCat= Category::find($deleteId['id']);
                $docDels = $deleteCat->categoryDocument->toArray();
                foreach ($docDels as $docDel) { 
                    DocumentClass::FileDelete($docDel['id']);
                }
                $deleteCat->delete();
            }  
            return redirect()->to('/');
        }

        if($request->input('NewSubCat')) 
        {
			$newCategory = new Category();
			$newCategory->name = $request->input('NewSubCat');
			$newCategory->parent_id = $id;
			$newCategory->save();
		}
		
        if($request->input('ChangeCatName')) 
        {
			$changeCategory = Category::find($id);
			$changeCategory->name = $request->input('ChangeCatName');
			$changeCategory->update();
		}
        return redirect()->to($id); 
	}

    public function MainCategory() {

        $mainCategories = Category::where('parent_id', 0)
                    ->orderBy('name')
                    ->get(); 

        foreach($mainCategories as $mainCategory)
        {
            $trees = CategoryClass::doTree($mainCategory, 1, $this->loginedUser);
        }

        View::share([
            'treeCategories' => $trees,
            'selectedCategory'=> 0,
            'categoryDocuments' => '',
            ]);

        return view('index');
    }
}