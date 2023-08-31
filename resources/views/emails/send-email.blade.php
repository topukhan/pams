<!DOCTYPE html>
<html>

<head>
    <title> {{ $mailData['subject'] }}</title>
</head>

<body>
    <h1>This is Heading</h1>
    <p>{{ $mailData['message'] }}</p>
</body>

</html>
