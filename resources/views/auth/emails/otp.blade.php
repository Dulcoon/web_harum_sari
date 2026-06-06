<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f3efeb;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }
        .wrapper {
            max-width: 560px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 20px 60px -15px rgba(0,0,0,0.08);
        }
        .logo {
            text-align: center;
            margin-bottom: 32px;
        }
        .logo h1 {
            font-family: 'Manrope', 'Inter', sans-serif;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -0.03em;
            color: #1b1c1b;
            margin: 0;
        }
        .logo span {
            color: #d46211;
        }
        .greeting {
            font-size: 16px;
            color: #51423a;
            margin-bottom: 8px;
            text-align: center;
        }
        .message {
            font-size: 14px;
            color: #8b7266;
            text-align: center;
            margin-bottom: 32px;
            line-height: 1.6;
        }
        .otp-container {
            text-align: center;
            margin-bottom: 32px;
        }
        .otp-code {
            display: inline-block;
            font-family: 'Manrope', 'Inter', monospace;
            font-size: 48px;
            font-weight: 900;
            letter-spacing: 12px;
            color: #d46211;
            background: rgba(212, 98, 17, 0.08);
            padding: 20px 32px;
            border-radius: 16px;
            border: 2px dashed rgba(212, 98, 17, 0.2);
            user-select: all;
        }
        .expiry {
            font-size: 13px;
            color: #9a6c4c;
            text-align: center;
            margin-bottom: 32px;
            padding: 12px;
            background: #f9f4ed;
            border-radius: 12px;
        }
        .expiry strong {
            color: #d46211;
        }
        .divider {
            height: 1px;
            background: #eadfd4;
            margin: 32px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #b89983;
            line-height: 1.8;
        }
        .footer a {
            color: #d46211;
            text-decoration: none;
        }
        @media only screen and (max-width: 480px) {
            .card { padding: 32px 24px; }
            .otp-code { font-size: 36px; letter-spacing: 8px; padding: 16px 20px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="logo">
                <h1>HOME<span>LIVING</span></h1>
            </div>

            <p class="greeting">Hi <strong>{{ $name }}</strong>,</p>
            <p class="message">
                Welcome to HOMELIVING! Please use the verification code below to confirm your email address.
            </p>

            <div class="otp-container">
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <div class="expiry">
                &#9200; This code will expire in <strong>10 minutes</strong>
            </div>

            <div class="divider"></div>

            <div class="footer">
                <p>If you didn't create this account, please ignore this email.</p>
                <p>&copy; {{ date('Y') }} HOMELIVING. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
