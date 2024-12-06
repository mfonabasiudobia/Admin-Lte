<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
        
    <style>
        /* Add your CSS styles here */
        body {
            font-family: 'Inter';
            background-color: #f4f4f4;
            padding: 20px;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f4f4f4;
            border-radius: 5px;
        }

        /* Header */
        .header {
            background-color: #FE6603;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        /* Logo */
        .logo {
            font-size: 32px;
            font-weight: bold;
        }

        /* Main Content */
        .content {
            padding: 20px;
            text-align: left;
            background-color: #fff;
        }

        /* Confirmation Message */
        .confirmation {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">{{ gs()->business_name }}</div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h1>Password Reset Successful</h1>
            <div class="confirmation" style="margin-bottom: 7px;">
                Your password has been successfully reset. You can now log in to your account using your new password.
            </div>

            <div  style="margin-bottom: 7px;">
                If you didn't request this password reset or need further assistance, please contact our support team.
            </div>

            <div style="margin-bottom: 7px;">
                Connect with us on social media and stay updated:
            </div>
            <footer style="text-align: center">
                <ul style="list-style: none;">
                    <li style="display: inline-block;margin: 0 3px;">
                        <a href="{{ gs()->twitter_url }}">
                            <img src="{{ asset('images/twitter.png') }}" />
                        </a>
                    </li>
            
                    <li style="display: inline-block;margin: 0 3px;">
                        <a href="{{ gs()->facebook_url }}">
                            <img src="{{ asset('images/facebook.png') }}" />
                        </a>
                    </li>
            
                    <li style="display: inline-block;margin: 0 3px;">
                        <a href="{{ gs()->linkedin_url }}">
                            <img src="{{ asset('images/linkedin.png') }}" />
                        </a>
                    </li>
            
                    <li style="display: inline-block;margin: 0 3px;">
                        <a href="{{ gs()->instagram_url }}">
                            <img src="{{ asset('images/instagram.png') }}" />
                        </a>
                    </li>
                </ul>
                <p>
                    Download our app to access our services conveniently.
                </p>
                <ul style="list-style: none;position: relative; z-index: 10;">
                    <li style="display: inline-block;margin: 10px;">
                        <a href="{{ gs()->app_url_ios }}">
                            <img src="{{ asset('images/apple-store-light.png') }}" />
                        </a>
                    </li>
            
                    <li style="display: inline-block;margin: 10px;">
                        <a href="{{ gs()->app_url_android }}">
                            <img src="{{ asset('images/google-play-store-light.png') }}" />
                        </a>
                    </li>
                </ul>
        </div>
    </div>
</body>

</html>