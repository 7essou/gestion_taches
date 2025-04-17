<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('auth')}}" method="post">
        {{csrf_field()}}
      <input type="text" name="email" placeholder="email" > <br>
      <input type="password" name="password" placeholder="email" > <br>
      <button type="submit" >Log in</button>
    </form>
</body>
</html>