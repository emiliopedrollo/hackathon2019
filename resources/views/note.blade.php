<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <title>Nova nota</title>
    <style>
        #nota {
            margin-top: 25px;
            display: inline-block;
            background-color: #fef5c7;
            justify-content: center;
        }
    </style>
</head>
<body>
<div style="padding: 5px; text-align: center">
    <div id="nota">
        <img src="/img/cupom.jpg">
        <p style="font-size: x-small; text-align: center; font-weight: bold">{{ $note }}</p>
        <img src="{{ $qr_code }}">
    </div>
</div>
</body>
</html>