<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;500;600;700;900&display=swap'
        rel='stylesheet'>
    <style>
        html,
        body {
            font-family: 'Lato', sans-serif;
        }
    </style>
</head>

<body>
    <section style='padding: 0px 50px;'>
        <center>
            <h1>RECEIPT</h1><br />
            <img src="{{ asset(gs()->logo) }}" style='width: 200px; height: auto' />
        </center>
        <br />
        <center>
            <div style='border: 1px solid #EDEDED;width: 70%;'></div>
        </center>
        <br />
        <table width='100%'>
            <tbody>
                <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Transaction number</td>
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>#{{ $trx }}</td>
                </tr>
                <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Purchased Date</td>
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>{{ $date }}</td>
                </tr>
                {{-- <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Payment Method</td>

                    @if($cardType == 'business')
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>Stripe({{ $last4 }})</td>
                    @else
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>FREE</td>
                    @endIf
                </tr> --}}
                <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Card Type</td>
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>{{ strtoupper($cardType) }}</td>
                </tr>
                <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Transaction Status</td>
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>{{ strtoupper($status) }}</td>
                </tr>
                @if($expiryDate)
                <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Expiry Date</td>
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>{{ $expiryDate }}</td>
                </tr>
                @endIf
                <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Quantity</td>
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>{{ $quantity }}</td>
                </tr>
                {{-- <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Price</td>
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>${{ $price }}</td>
                </tr> --}}
                <tr>
                    <td width='50%' style='padding: 10px 0px;color: rgba(0,0,0,0.6)'>Total Amount</td>
                    <td width='50%' style='text-align: right;padding: 10px 0px;'>${{ $amount }}</td>
                </tr>
            </tbody>
        </table>

        <p style="text-align: center;padding: 10px">Thank you for your purchase!</p>
    </section>
</body>

</html>