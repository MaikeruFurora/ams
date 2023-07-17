<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GENERATED</title>
    <!-- App css -->
    <style>
       @media print {
            body {
                margin: 0;
                font-family: 'Calibri';
                font-size: 16px;
            }
        }
        .card-text{
            font-size: 10px;
            margin-bottom: 0px;
            font-weight: bold;
        }
    </style>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body onload="window.print()">
<div class="row">
  @foreach ($assets as $item)
  <div class="card ml-3 mb-2" style="max-width: 400px;border:2px solid black;box-shadow: 0px 0px;">
    <div class="row no-gutters">
      <div class="col-md-4 p-1">
        @php
             echo QrCode::size(110)->generate("Asset Code: {$item->asset_code}\nBrand/Model: {$item->brand}\nSerial No: {$item->serial_no}\nDescription/Spec:{$item->description}");
        @endphp
      </div>
      <div class="col-md-8">
        <div class="card-body pt-0">
          <p class="card-title font-weight-bold mt-2" style="font-size: 11px">Arvin International Marketing Inc.</p>
          <p class="card-text">Asset Code: {{ $item->asset_code }}</p>
          <p class="card-text">Purchase Date: {{ $item->date_purchase }}</p>
          <p class="card-text">Issued Date: {{ $item->date_purchase }}</p>
            <div style="position: fixed; margin-left:170px;margin-top:3px">
                <img src="{{ asset('assets/images/lg.png') }}" width="30" alt="" srcset="">
            </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
</body>
</html>