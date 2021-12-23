<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimoVPN</title>
    <style>
        .all{
            position: relative;
            top: 100px;
            text-align: center;
        }
        .code{
            width: 200px;
            height: 50px;
            background: #3167d8;
            margin: 0 auto;
            border-radius: 50px;
            font-size: 40px;
            font-weight: bolder;
            color: #fff;
            padding-bottom: 2px;
        }
    </style>
</head>
<body>
    <div class="all">
        <h1>welcome to TimoVPN </h1>
        <p>Thanks for choosing TimoVPN. <br> Your verification code:</p>
        <div class="code">{{ $code }}</div>
    </div>
</body>
</html>
