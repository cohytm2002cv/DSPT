<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .news-content {
            white-space: pre-line;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>{{ $new->title }}</h1>
    <p>Author: {{ $new->author }}</p>
    <div class="news-content">{{ $new->content }}</div>
    <div><img src="{{ asset( $new->image_path) }}" alt="ảnh"></div>
</div>
</body>
</html>
