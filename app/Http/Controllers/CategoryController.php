<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\User;
use App\Model\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{

    public $selectedCategory;
    public $loginedUser;
    public $tree;

    public function __construct()
    {
        self::Login();
    }

    public function Login()
    {
        $this->loginedUser = User::find(1)->toArray();
        View::share(['loginedUser' => $this->loginedUser]);
    }

    public function CategoryDocument($id)
    {   
        self::MainCategory();
        $documents = Document::where('category_id', $id)
                    ->get(); 

        $selectedCategory = Category::find($id)->toArray();

        View::share([
            'categoryDocuments' => $documents,
            'selectedCategory'=> $selectedCategory,
            'categoryId' => $id,
        ]);

        return view('index');
    }

    public function NewMainCategory(Request $request)
    {
        $newMainCategory= $request->input('NewCategory');
        $newCategory = new Category();
        $newCategory->name = $newMainCategory;
        $newCategory->parent_id = 0;
        $newCategory->save();

        return redirect()->to('/'); 
    }

    public function NewSubCatOrChangeCatName(Request $request){

        $id = $request->input('categoryId');

		if($request->input('NewSubCat')) {
			$newSubCategoryname = $request->input('NewSubCat');
			$newCategory = new Category();
			$newCategory->name = $newSubCategoryname;
			$newCategory->parent_id = $id;
			$newCategory->save();
		}
		
		if($request->input('ChangeCatName')) {
			$changeCategoryname = $request->input('ChangeCatName');
			$changeCategory = Category::find($id);
			$changeCategory->name = $changeCategoryname;
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
            $trees = self::doTree($mainCategory, 1, $this->loginedUser);
        }

        View::share([
            'treeCategories' => $trees,
            'selectedCategory'=> 0,
            'categoryDocuments' => '',
            ]);

        return view('index');
    }

    public static function permissionToCategory($category, $loginedUser){

        return in_array($category['id'], $loginedUser['category']);
    }

    public static function printCategory($categorys, $level, $loginedUser){
        $category = $categorys->toArray();
        $classnames = "level-".$level.' '; 

        return '<p class=' . $classnames . '><a  href="' . $category['id'] .
        '">' . $category['name'] . '</a><button data-id="' . $category['id']  .
        '" type="button" id = "user_dialog" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">+</button></p>';
    }

    public static function doTree($parent, $level, $loginedUser){
        
        static $pArray = [];
		$pTag = self::printCategory($parent, $level, $loginedUser);  
        array_push($pArray, $pTag);

        foreach($parent->children as  $child){
            self::doTree($child , $level+1, $loginedUser);     
        }
        return  $pArray;
    }
}