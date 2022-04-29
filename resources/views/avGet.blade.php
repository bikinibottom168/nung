<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('av.post') }}" method="post">
        {{csrf_field()}}
        <textarea name="url" id="" cols="100" rows="50"></textarea>
        <button type="submit">submit</button>
    </form>
</body>
</html>