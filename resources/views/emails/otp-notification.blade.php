<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Email</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            font-size: 14px;
            line-height: 21px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        a:link,
        a,
        a:active {
            color: #1155CC !important;
        }

        .content {
            padding: 20px;
        }

        .otp-code {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        .instructions {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .social-media {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
        }

        .otp-button {
            background-color: #FE6603;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <p>
        <div><strong style="font-size: 18px">Hi {{ $user->email }}</strong></div>
        <p>To access your account, please use the one-time passcode (OTP) below:</p>
        </p>

        <div style="text-align: center;background-color: #F6F6F6;border-radius: 20px;padding: 25px 20px;">
            <strong style="letter-spacing: 10px;font-size: 36px">{{ $otp }}</strong>
        </div>

        <p>If you didn't try to sign in, ignore this email.</p>

        <p>
            Regards, <br />
            {{ gs()->business_name }} Team
        </p>

        <p> <strong>{{ gs()->business_name }}</strong> <br />
            {{ gs()->address }}
        </p>
    </div>
</body>

</html>
