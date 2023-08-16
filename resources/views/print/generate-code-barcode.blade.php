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
<body >
<div class="row">
  @foreach ($assets as $item)
  <div class="card ml-4 mt-2 text-center" style="width: 18rem;">
    <img width="100%" class="mt-1" height="40px"  src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->asset_code, 'C39')}}" alt="barcode" />
    <div class="card-body p-0">
        <p class="card-title font-weight-bold mb-0" style="font-size: 12px">Arvin International Marketing Inc.</p>
        <p class="card-text">{{ $item->asset_code }}</p>
    </div>
  </div>
 
  @endforeach
</div>
</body>
</html>