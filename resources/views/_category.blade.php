<div class="firstdiv"><header><p class="text-white" ><strong>Categories</strong></p></header>
    <form method="post" action="{{ action('CategoryController@NewMainCategory') }}">
    <input type="text" name="NewCategory" placeholder ="New main category">
    {{ csrf_field() }}
    <input type="submit" name='newCategory' value="Add">
</form>
			
</div>