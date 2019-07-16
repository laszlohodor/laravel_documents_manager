<html>
    <head>
        <title>Document system</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href={{ asset('/css/main.css') }}>
    </head>
    <body>
        <div class="div">
            <div class="firstdiv">
                @include('_category')
            </div>
            <div class="seconddiv">
                @include('_document')
            </div>
        </div>
        <script>
            $(document).on("click", "#user_dialog", function ()
            {
                var UserName = $(this).data('id');
                $(".modal-body #categoryId").val( UserName );
            });
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>
    </body>
</html>