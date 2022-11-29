<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    @vite(['resources/js/app.js'])
    <title>Post List</title>
</head>
<body>
    <table>
        <caption>Post List</caption>
        <thead>
            <th>Post Title</th>
            <th>Post Description</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Updated at</th>
        </thead>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post['title'] }}</td>
            <td>{{ $post['description'] }}</td>
            <td>{{ $post['status'] }}</td>
            <td>{{ $post['created_at'] }}</td>
            <td>{{ $post['updated_at'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
