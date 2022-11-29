<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    <title>Post Create</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <form action="#" class="login-form">
                <legend>Create Post</legend>
                <input type="text" name="title" placeholder="Title">
                <input type="text" name="description" placeholder="Description">
                <input type="text" name="status" placeholder="Status">
                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>
</body>
</html>