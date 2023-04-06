<head>
  <title>LAVEMS Proforma Invoice</title>
</head>
<body style="border-style: double;
    border-width: 2px;
    border-left-width: 6px;
    border-right-width: 6px;
    border-top-width: 6px;
    border-bottom-width: 6px;
    border-color: black;">
	<table width="100%" border="0">
    <tr>
        <td style="text-align:right" width="60%"><img src="https://littlefingers.ng/img/lavems.jpeg" width="130px"  height="130px"></td>
      <td style="text-align:right">Office Suite: Suite 309 DBM Plaza, Wuse 2, Abuja<br/>Tel: 08036576494, 0987675589<br/>Email: littlefingers@rocketmail.com, info@littlefingers.com<br/></td>
</tr>
<tr>
  <td colspan="2" style="text-align:center; font-size:30px;">PROFORMA INVOICE</td>
</tr>
</table>

{{-- @foreach(json_decode($data) as $item)
    {{ $item->invoice_number }}
@endforeach --}}

<div><br/><b style="text-transform: uppercase">Type of Business: {{$nature_of_business ?? null }}</b><br/><br/></div>
<table width="100%" border="1" style="border-collapse:collapse; text-align: center">
<tr>
<td width="45%" rowspan="3">Invoice to: NIRSAL MFB/{{$client_name ?? null}}<br/><br/>Address: {{$contact_address ?? null}}<br/><br/></td>
<td rowspan="4"></td>
<td width="45%"></td>
</tr>

<tr>


<td>Invoice Date:  {{$invoice_date ?? null}}</td>
</tr>

<tr>


<td>Invoice Number:  {{$invoice_number ?? null}}</td>
</tr>


<tr>
<td>Tel: {{$phone_number ?? null}}</td>

<td>Customer Ref/Client ID: {{$client_id ?? null}}</td>
</tr>
</table><br/>
<?php $i='1'; ?>
<table border='1' align='center' width='100%' style='border-collapse:collapse';>
    <tr>
        <th>&nbsp;&nbsp;Item</th>
        <th>&nbsp;&nbsp;Equipment S/N</th>
        <th>&nbsp;&nbsp;Equipment Description</th>
        <th>&nbsp;&nbsp;Qty</th>
        <th>&nbsp;&nbsp;Unit Price</th>
        <th>&nbsp;&nbsp;Total</th>
    </tr>
    {{-- @foreach(json_decode($data) as $item)
    <tr>
        <td><?php  echo $i++; ?></td>
        <td>{{ $item->equipment_serial_number ?? null}}</td>
        <td>{{ $item->equipment ?? null}}</td>
        <td>{{ $item->quantity ?? null}}</td>
        <td>N{{ number_format($item->cost ?? null, 2) }}</td>
        <td>N{{ number_format($item->cost ?? null*$item->quantity ?? null, 2) }}</td>
    </tr>

@endforeach --}}

@foreach ($data['invoice'] as $item)
    <tr>
        <td><?php  echo $i++; ?></td>

        <td>{{ $item['equipment_serial_number'] ?? 'N/A' }}</td>
        <td>{{ $item['equipment'] }}</td>
        <td>{{ $item['quantity'] }}</td>
        <td>{{ number_format($item['cost'], 2) }}</td>
        <td>{{ number_format($item['cost']*$item['quantity'], 2) }}</td>
        {{-- <td>{{ $item['name'] }}</td> --}}


    </tr>
@endforeach

<tr>
    <td colspan="4"></td>
    <td style="color: red;">Total</td>
    <td>{{ number_format($data['grand_total'], 2) }}</td>
    {{-- <td style="color: red;">N{{ number_format($item->cost ?? null *$item->quantity ?? null, 2) }}</td> --}}
</tr>
</table>


<?php
class numbertowordconvertsconver {
    function convert_number($number)
    {
        if (($number < 0) || ($number > 999999999))
        {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = "";
        if ($giga)
        {
            $result .= $this->convert_number($giga) .  " Million";
        }
        if ($kilo)
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($kilo) . " Thousand";
        }
        if ($hecto)
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result))
            {
                $result .= " and ";
            }
            if ($deca < 2)
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n)
                {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result))
        {
            $result = "zero";
        }





        return $result;
    }




}
?>

<!-- call the function here -->
<?php
$class_obj = new numbertowordconvertsconver();
//$convert_number = 12345545;
$get_amount=$class_obj->convert_number($data['grand_total']);
?>




<p style="padding-left:30px;"> Amount in words:<i style='border-bottom:dotted; font-size:16px'> <?php echo $get_amount; ?> naira ONLY<i></p>

    <table width='100%' border='0'>
      <tr>
        <td colspan='2' style='text-align:center; font-weight:bold; font-size:16px'>Bank Account Name: Little Fingers Integrated<br/>Bank: NIRSAL MFB<br/>Account number: 0250265614<br/></td>
    </tr>
    <tr>
        <td colspan="2" style='text-align:center' width="40%"><br/><img src="https://littlefingers.ng/img/okuma.jpeg" width="100px" height="100px"/><hr style='border-bottom:dotted' width="200px"/></td>

    </tr>
    <tr>
        <td style='text-align:center' colspan="2">Orkuma Hembe<br/>Managing Director<br/></td>

    </tr>
    </table>

    <footer>
        <br/>

          <p style="text-align:center; font-size:12px">We declare that the above information is true and correct to the best of our knowledge. For and on behalf of the above-named company.
      This proforma invoice is valid for 30 days</p>
          <p><i style="font-size:10px">Generated from LAVEMS servers at <?php date_default_timezone_set("Africa/Lagos"); echo date('Y-m-d h:i:sa'); ?></i></p>
      </footer>

	</body>
</html>
