<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome Email</title>
    <link
        href='https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,500;1,600;1,700;1,800&display=swap'
        rel='stylesheet'>

    <style>
        /* Add your CSS styles here */
        body {
            font-family: 'Lato' !important;
            background-color: #F3F2F2;
            padding: 20px;
            font-size: 16px;
            line-height: 21px;
        }

        .title {
            font-family: 'Lato';
            font-size: 28px;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            border-radius: 5px;
            /* padding: 20px; */
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

        <section>

            <img src="{{ asset(gs()->logo) }}" style="height: 80px; width: auto; " />


            <h1 class="title">Welcome to eConnect Cards App!</h1>
        </section>

        <p>Welcome to eConnect Cards - a versatile digital information card designed for professionals, individuals,
            athletes, and businesses to easily share their details, build their brands, and get connected! </p>


        <p>
            Regards, <br />eConnect Card App Team
        </p>

        <p> <strong>{{ gs()->business_name }}</strong> <br />
            {{ gs()->address }}
        </p>
    </div>
</body>

</html>
