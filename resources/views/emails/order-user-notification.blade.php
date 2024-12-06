<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Message</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Michroma:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <style type="text/css">
        body {
            background-color: #EAF0F3;
            width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Lato';
            padding: 50px 0;
        }

        .title {
            font-family: 'Michroma';
            font-size: 28px;
        }

        .content-title {
            font-family: 'Michroma';
            font-size: 20px;
        }

        .subtitle {
            font-size: 18px;
            color: #5E5E5E;
            line-height: 0;
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 768px) {
            .container {
                width: 750px;
            }
        }

        @media (min-width: 992px) {
            .container {
                width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                width: 1170px;
            }
        }

        .text-black {
            color: #000;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>
    <main class="container">
        <section>
            <img src="{{ asset(gs()->logo) }}" style="height: 80px; width: auto; " />

            <h1 class="title">Congratulations!</h1>
        </section>

        <section style="border-radius: 5px;background-color: #fff; margin: 20px 0; color: #5E5E5E; padding: 0px 2px">

            <section style="text-align: left;">
                <p>
                    You've recently made a purchase from eConnect Cards. The receipt is attached.
                </p>

                <section>
                    <div>
                        <strong>Transaction ID:</strong> <span>#{{ $trx->trx }}</span>
                    </div>
                    <div>
                        <strong>Transaction Date:</strong> <span>{{ $trx->created_at->setTimezone($trx->timezone ??
                            'America/New_York')->format("d M, Y h:i A"); }}</span>
                    </div>
                </section>

                <p>To update and activate your card, simply follow these steps:​</p>

                <p>1. From the "My eConnect Cards" page, which also serves as your Homepage, go to the "Unused" tab.</p>

                <p>2. Select the card you wish to update and proceed with the necessary information.</p>

                <p>3. Once the update is complete, click the menu icon at the top-right corner of the card.</p>

                <p>4. Finally, click "Activate" to make your card live and ready for sharing.</p>

                <br />

                Enjoy connecting!
                <br />


                Regards,
                <br />
                {{ gs()->business_name }} Team
                <br />

                {{ url("https://econnectcardsapp.com") }}
            </section>
        </section>

        <footer>
            <div>Copyright © {{ date('Y') }}</div>
            <div>{{ gs()->business_name }}</div>
        </footer>
    </main>
</body>

</html>