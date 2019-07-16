@if (App\CategoryClass::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_up'])
    <form method="post" enctype="multipart/form-data" action="{{ action('DocumentController@FileUpload') }}">
        <input type="file" id="fileupload" name="file">
        <input type="hidden" id="user" name="user" value = "{{$loginedUser['id']}}">
        <input type="hidden" id="category" name="category" value = "{{$selectedCategory['id']}}">
        {{ csrf_field() }}
        <div class="mt-3">
            <button type="submit" name = "fileupload" class="btn btn-primary btn-xs">Upload</button>
        </div>
    </form>
@endif
    <header>
        <p class="text-danger" ><strong>Categories</strong></p>
    </header>

    <form method="post" action="{{ action('CategoryController@NewMainCategory') }}">
        <input type="text" name="NewCategory" placeholder ="New main category">
        {{ csrf_field() }}
        <input type="submit" name='newCategory' value="Add">
    </form>

<div class="container">
@foreach($treeCategories as $treeCategory)
    <p class=' {{ $treeCategory[0] }} '><a  href=" {{ $treeCategory['id'] }} ">
    {{ $treeCategory['name'] }} </a>
    <button data-id="{{ $treeCategory['id'] }}" type="button" id = "user_dialog" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">+</button>
    </p>
@endforeach
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{ action('CategoryController@NewSubCatOrChangeCatName') }}">
                            <div class="col-xs-3">
                                <label>New subcategory:</label>
                                <input type="text" class="form-control" id="NewSubCat" name="NewSubCat" value=""><br><br>
                                <label>Change category name:</label>
                                <input type="text" class="form-control" id="ChangeCatName" name="ChangeCatName"><br>
                                <input type="hidden" id="categoryId" name="categoryId" value ="">
                                {{ csrf_field() }}
                            </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name='NewSubCatOrChangeCatName'>Save</button>
                                <input type="submit" class="btn btn-danger" id="deleteCategory" name='deleteCategory' value="Delete">
                        </div>
                        </form>
                </div>
            </div>
        </div>
     </div>
</div>

