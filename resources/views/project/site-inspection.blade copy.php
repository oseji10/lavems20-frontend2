<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<title>LAVEMS Site Inspection Form</title>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>file_1681147039727</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        h1 {
            color: black;
            font-family: Tahoma, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        .h3 {
            color: black;
            font-family: Tahoma, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 9.5pt;
        }

        h2 {
            color: black;
            font-family: Tahoma, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: underline;
            font-size: 10.5pt;
        }

        p {
            color: black;
            font-family: Tahoma, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10.5pt;
            margin: 0pt;
        }

        .s1 {
            color: black;
            font-family: Verdana, sans-serif;
            font-style: italic;
            font-weight: bold;
            text-decoration: underline;
            font-size: 10.5pt;
        }

        li {
            display: block;
        }

        #l1 {
            padding-left: 0pt;
            counter-reset: c1 1;
        }

        #l1>li>*:first-child:before {
            counter-increment: c1;
            content: counter(c1, decimal)". ";
            color: black;
            font-family: Tahoma, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10.5pt;
        }

        #l1>li:first-child>*:first-child:before {
            counter-increment: c1 0;
        }
    </style>
</head>

<body style="border-style: solid;
border-width: 1px;
border-left-width: 2px;
border-right-width: 2px;
border-top-width:2px;
border-bottom-width: 2px;
border-color: black;
padding: 5px 5px 5px 5px;
    margin: 5px;
>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="text-indent: 0pt;text-align: left"><span>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img width="173" height="88" src='https://lavems2.littlefingers.ng/NIRSAL-MFB.jpeg' /></td>
                </tr>
            </table>
        </span></p>
    <h1 style="padding-top: 5pt;padding-left: 200pt;text-indent: 0pt;text-align: center;">Date<span class="h3">:</span>
    </h1>
    <h2 style="padding-top: 10pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">SITE/EQUIPMENT INSPECTION REPORT
    </h2>
    <p style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">Branch:</p>

    <table style="width:100%; border:1px;">
        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Customer's Name: </td><td>{{$client_name ?? null}}</td>
            <td>Customer's Phone Number:</td><td>{{$phone_number ?? null}}</td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Customer's A/C No: </td><td></td>
            <td>Customer's BVN:</td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Home Address: </td><td>{{$contact_address ?? null}}</td>
            <td></td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Vendor's Name: </td><td>Little Fingers Integrated Ltd</td>
            <td>Customer's A/C No:</td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Vendor's Phone Number: </td><td>080336576494</td>
            <td>Vendor's A/C No:</td><td>0250265614</td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Vendor Address: </td><td>Suite 309, DBM Plaza, Wuse 2, Abuja</td>
            <td></td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Invoice Number: </td><td>{{$invoice_number ?? null}}</td>
            <td></td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Name of Company: </td><td></td>
            <td></td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Business Address:</td><td></td>
            <td></td><td></td>
        </tr>



        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Location of Equipment:</td><td></td>
            <td></td><td></td>
        </tr>

    </table>

    <table style="width:100%; border:1px;">
        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td width="10%"></td><td></td>
            <td width="40%">List of Equipment on Site:</td><td></td>
            <td width="40%">Serial Number of Equipment:</td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td width="4%">1.</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td width="4%">2.</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
        </tr>


        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td width="4%">3.</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
        </tr>


        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td width="4%">4.</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
        </tr>


        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td width="4%">5.</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
        </tr>


        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td width="4%">6.</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
            <td width="48%">-----------------------------------------------------------------</td><td></td>
        </tr>

    </table>



    <table style="width:100%; border:1px;">
        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Address Visited: </td><td></td>
            <td></td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Met With (Name): </td><td></td>
            <td></td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Description of Location/Building with Landmark): </td><td></td>
            <td></td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Site &amp; Equipment Condition/Observation: </td><td></td>
            <td></td><td></td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>Date &amp;Time of Visitation: </td><td></td>
            <td></td><td></td>
        </tr>

    </table>

    <table style="width:100%; border:1px;">
        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>By these present, the Team Lead and Vendor hereby confirm the release of funds to the Vendor to purchase and supply the equipment listed above for the within named
                customer on behalf of the bank.</td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>It is hereby agreed that 90% of the purchase price shall be paid immediately, whereas,
                the balance of 10% shall be reserved until the equipment have been purchased,
                delivered and receipts duly issued in accordance with the terms of the Vendor
                Agreement</td>
        </tr>

        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td><b><u>CAUTION</u></b><br/>
                We the undersigned hereby take personal responsibility for the supply of the equipment
                in accordance with the terms contained above.
            </td>
        </tr>

    </table>

    <table style="width:100%; border:1px;">
        <tr>
            <td width="50%">_________________________________</td><td><b><u>Orkuma Hembe </u></b> <img width="56" height="50" src="https://littlefingers.ng/img/okuma.jpeg" /></td>
            {{-- <td>TEAM LEAD's NAME &amp; SIGNATURE</td><td>VENDOR's NAME &amp; SIGNATURE  </td> --}}
        </tr>
        <tr>
            {{-- <td width="50%">_________________________</td><td><b>Orkuma Hembe </b> <img width="56" height="50" src="" /></td> --}}
            <td>TEAM LEAD's NAME &amp; SIGNATURE</td><td>VENDOR's NAME &amp; SIGNATURE  </td>
        </tr>
{{--
        <tr style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 178%;text-align: left;">
            <td>VENDOR's NAME &amp; SIGNATURE  <img width="56" height="50" src="" /></td>
        </tr> --}}
    </table>
    {{-- <p style="padding-top: 7pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">Address Visited:</p>
    <p style="padding-top: 9pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
        -----------------------------------------------------------------------------</p>
    <p style="padding-top: 7pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
        -----------------------------------------------------------------------------</p>
    <p style="padding-top: 7pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
        -----------------------------------------------------------------------------</p>
    <p style="padding-top: 7pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
        -----------------------------------------------------------------------------</p>
    <p style="padding-top: 7pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
        -----------------------------------------------------------------------------</p>
    <p style="padding-top: 7pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
        -----------------------------------------------------------------------------</p> --}}
    {{-- <p style="text-indent: 0pt;text-align: left;"><br /></p> --}}
    {{-- <p style="padding-top: 5pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">Met With (Name):</p> --}}
    {{-- <p style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">Description of Location/Building with Landmark):</p> --}}
    {{-- <p style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">Site &amp; Equipment Condition/Observation:</p> --}}
    {{-- <p style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">Date &amp;Time of Visitation:</p> --}}
    {{-- <p style="padding-top: 9pt;padding-left: 26pt;text-indent: 0pt;line-height: 115%;text-align: justify;">I        ………………………………………………………… (Team Lead) hereby commit that the equipment bought for the above-named customer was duly        sighted and delivered on behalf of the bank to the above business location.</p> --}}
    {{-- <p style="padding-top: 7pt;padding-left: 26pt;text-indent: 0pt;line-height: 113%;text-align: justify;">I Little Fingers Ltd (Vendor) hereby attest that I have purchased and supplied the above list of equipment and herewith attach the receipt of the equipment.</p> --}}
    {{-- <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="text-indent: 0pt;text-align: left;"><span>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img width="56" height="50" src="" /></td>
                </tr>
            </table>
        </span></p>
    <p style="text-indent: 0pt;text-align: left;" />
    <p class="s1" style="padding-top: 5pt;padding-left: 299pt;text-indent: 0pt;text-align: left;">Orkuma Hembe</p>
    <p style="padding-top: 1pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">TEAM LEAD's NAME &amp; SIGNATURE
        VENDOR's NAME &amp; SIGNATURE</p> --}}
</body>

</html>
