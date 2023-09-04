<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Token</title>
</head>
<body>
    <form action="/form" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label for="name">
            <span>Name</span>
            <input type="text" name="name" placeholder="Name..." autocomplete="off">
        </label>
        <button type="submit">Submit</button>
    </form>
</body>
</html>