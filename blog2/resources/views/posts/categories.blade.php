<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
{{ $category->name }}<br>
@foreach($category->posts as $post)
    {{ $post->title }}<br>
@endforeach
</body>
</html>