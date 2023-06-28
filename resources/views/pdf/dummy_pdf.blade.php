<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @page {
            size: 21cm 29.7cm;
            margin: 0;
        }

        main {
            padding-top: .5in;
            padding-left: .5in;
            padding-right: .5in;
        }

        #example1 {
            margin-top: -30px;
            padding: 25px;
            background: url("./header.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .stamp {
            margin-top: -80px;
            margin-left: 10px;
        }

        #example2 {
            margin-top: -30px;
            margin-bottom: -100px;
            height: 280px;
            background: url("./footer.jpg");
            background-repeat: no-repeat;
            background-size: 100% 105%;
        }

        footer {
            padding-top: .5in;
        }

    </style>
</head>
<body>
    <main>
        @foreach($all_data as $data)
        <!-- <p class="bg">&nbsp;</p> -->
        <div id="example1">
            <p></p>
        </div>
        <p style="margin-bottom:11px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">REF No.: {{$data->reference}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date: {{$data->date}}</span></span></span></p>

        <p style="margin-top: 20px;"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b>Subject: OFFER LETTER</b></u></span></span></span></p>

        <!-- <p class="MsoNoSpacing">&nbsp;</p> -->

        <p style="margin-top: 25px;"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">To,</span></span></span></span><br />
            <span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">{{$data->name_prefix}}{{$data->f_name}} {{$data->l_name}}</span></span></span></span><br />
            <span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">{{$data->current_address}}</span></span></span></span><br />
            <span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">{{$data->phone_number}}</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">Dear {{$data->name_prefix}} {{$data->f_name}},</span></span></span></span><br />
            <span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">We indeed take pleasure on behalf of Dipto Diagnostic Pvt. Ltd, to confirm you an offer of employment for the post of </span></span><b><span lang="EN-IN" style="font-size:10.0pt"><span style="font-family:&quot;Cambria&quot;,serif">{{$data->post}}</span></span></b><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">, in our organization on mutually agreed terms and condition.</span></span></span></span><br />
            <span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">This is an offer letter which will be followed by the formal appointment letter, issued to you at the time of joining.</span></span></span></span><br />
            <span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">You will be joining the company not later than {{$data->month}} Month {{$data->year}}, and your CTC will be of <span style="font-family: DejaVu Sans; sans-serif;"> &#8377;</span>{{$data->salary}} P/A.</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">Initially you will be on probation for a period of 6 months which may be extended by another 6 month based upon your performance at the discretion of management of the company.</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">After satisfactory completion of probation period, you will be confirmed in your post.</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif"><span style="color:black">On account of Termination: During the probation period, this contract of employment is terminable by the Organisation by way of giving notice of 15 days or on payment of salary in lieu thereof without assigning any reasons.</span></span></span><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif"> &amp; after confirmation three months&rsquo; notice will be required.</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">Kindly sign the offer letter in token of acceptance of the same.</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">Wishing you a long and fruitful association with us.</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:13.5pt"><span style="color:black">For any further information / clarifications please feel free to contact:</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:13.5pt"><span style="color:black">hr@diptodiagnostic.com</span></span></span></span></p>

        <p class="MsoNoSpacing"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">Thanking You,<br>Team HR,</span></span></span></span></p>

        <p class="MsoNoSpacing "><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span lang="EN-IN" style="font-size:12.0pt"><span style="font-family:&quot;Cambria&quot;,serif">For Dipto Diagnostic Pvt. Ltd.</span></span></span></span> <img src="./stamp.png" alt="" height="100px" width="100px" class="stamp"></p>
        @endforeach
    </main>
    <footer>
        <!-- <div> -->
        <p id="example2"></p>
        <!-- </div> -->
    </footer>
</body>
</html>
