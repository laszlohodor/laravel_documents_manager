
    <table class="table"> 
        <tr>
            <th color= "white" scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Size</th>  
            <th scope="col">Upload date</th>
            <th scope="col">User Id</th>
            @if (App\CategoryClass::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_dow'])
                <th scope="col">Download</th>
            @endif
            @if (App\CategoryClass::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_del'])
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
                    @if (App\CategoryClass::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_dow'])
                        <form method="post" action="{{ action('DocumentController@FileDownload') }}">
                            {{ csrf_field() }}
                            <td><button type="submit" class="btn btn-primary" id="documentId" name='documentId' value="{{ $document->id }}">Download</button></td>
                        </form>
                    @endif
                    @if (App\CategoryClass::permissionToCategory($selectedCategory, $loginedUser) && $loginedUser['file_del'])
                        <form method="post" action="{{ action('DocumentController@FileDelete') }}">
                            {{ csrf_field() }}
                            <td><button type="submit" class="btn btn-danger" id="documentId" name='documentId' value="{{ $document->id }}">Delete</button></td>
                        </form>
                    @endif
                </tr> 
            @endforeach 
        @endif
    </table> 
