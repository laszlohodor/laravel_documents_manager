<html>
<head>
<title>Document system</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href={{ asset('/css/main.css') }}>
<link rel="stylesheet" type="text/css" href="">
</head>
<body>
@include('_errors')
<div class="div">
@include('_category')
@include('_document')
</div>
</body>
</html>