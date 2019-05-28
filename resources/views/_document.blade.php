
    <table class="table"> 
        <tr>
            <th color= "white" scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Size</th>  
            <th scope="col">Upload date</th>
            <th scope="col">User Id</th>
            @if (App\Http\Controllers\CategoryController::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_dow'])
                <th scope="col">Download</th>
            @endif
            @if (App\Http\Controllers\CategoryController::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_del'])
                <th scope="col">Delete</th>
            @endif
        </tr>      
        @if($categoryDocuments)           
            @foreach ($categoryDocuments as $document) 
                <tr>  
                    <td scope="col">{{ $document->name }}</td>  
                    <td>{{ $document->type }}</td>  
                    <td>{{ $document->size }}</td>
                    <td>{{ $document->upload_date }}</td>
                    <td>{{ $document->user_id}}</td>
                    @if (App\Http\Controllers\CategoryController::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_dow'])
                        <td><a href="download/{{$document->id}}"><button type="button" class="btn btn-outline-primary">Download</button></a></td>
                    @endif
                    @if (App\Http\Controllers\CategoryController::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_del'])
                         <td><a href="delete/{{$document->id}}"><button type="button" class="btn btn-outline-danger">Delete</button></td>
                    @endif
                </tr> 
            @endforeach 
        @endif
    </table> 
