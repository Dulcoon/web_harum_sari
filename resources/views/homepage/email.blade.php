<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        h1 {
            color: #555;
        }
        p {
            margin: 0 0 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>{{ $data['subject'] }}</h1>
        <p><span style="font-weight: bold;">Name:</span> {{ $data['name'] }}</p>
        <p><span style="font-weight: bold;">Email:</span> {{ $data['email'] }}</p>
        <p><span style="font-weight: bold;">Phone number:</span> {{ $data['phone'] }}</p>
        <p><span style="font-weight: bold;">Message:</span> <br>{{ $data['text'] }}</p>
        <div class="footer">
            <p>© {{ date('Y') }} homeliving.co.id. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
