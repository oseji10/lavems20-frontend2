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
      <td style="text-align:right" width="60%"><img src="img/lavems.jpeg" width="130px"  height="130px"></td>
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
    @foreach(json_decode($data) as $item)
    <tr>
        <td><?php  echo $i++; ?></td>
        <td>{{ $item->equipment_serial_number }}</td>
        <td>{{ $item->equipment }}</td>
        <td>{{ $item->quantity }}</td>
        <td>N{{ number_format($item->cost ?? null, 2) }}</td>
        <td>N{{ number_format($item->cost*$item->quantity ?? null, 2) }}</td>
    </tr>

@endforeach
<tr>
    <td colspan="3"></td>
    <td>Total</td>
</tr>
	</body>
</html>
