<!DOCTYPE html>
<html>

<head>
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <style>
     /* body
    {
        background-image:url('https://media.glassdoor.com/sqll/561082/arvin-international-marketing-squarelogo-1637307639526.png');
        background-repeat:repeat-y;
        background-position: center;
        background-attachment:fixed;
        background-size:100%;
    } */
    /* Styles go here */

    .page-header, .page-header-space {
      height: 60px;
    }

    .page-footer, .page-footer-space {
      height: 100px;
    }

    .page-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    /* border-top: 1px solid black; for demo */
    /* background: yellow; for demo */
    }

    .page-header {
    position: fixed;
    top: 0mm;
    width: 100%;
    /* border-bottom: 1px solid black;  */
    /* for demo */
    /* background: yellow; for demo */
    }

    /* .page {
    page-break-after: always;
    } */

    @page {
        margin: 10mm;
        size: 8.5in 13in;
        size: portrait;
    }

    @media print {
    thead {display: table-header-group;} 
    tfoot {display: table-footer-group;}
    
    button {display: none;}
    
    body {
        margin: 0;
        font-family: 'Calibri';
        font-size: 16px;
    }
    }

  </style>
</head>

<body onload="window.print()">

  <div class="page-header">
        <div class="text-center">
            {{-- AUTHORIZE LETTER TO PULL OUT --}}
        </div>
  </div>
  <div class="page-footer">
    {{-- <div class="row justify-content-between">
        <div class="col-4">
            <h5>Prepared By:</h5>
            <p style="border-bottom:1px solid black;font-size:20px;margin-bottom:3px">{{ strtoupper(auth()->user()->name) }}</p>
            <p style="font-size:20px;">{{ date("m/d/Y") }}</p>
        </div>
        <div class="col-4">
            <h5>Checked By:</h5>
            <p style="border-bottom:1px solid black;font-size:20px;margin-bottom:1px">&nbsp;</p>
        </div>
    </div> --}}
  </div>

  <table style="width: 100%;">

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
        <!--*** CONTENT GOES HERE ***-->
        <div class="row justify-content-between ">
          <div class="col-5">
              <table class="table table-borderless table-sm">
                  <tr>
                      <th width="30%">Pullout No:</th>
                      <td>{{ $pullout->pullout_no }}</td>
                  </tr>
                  <tr>
                      <th>Date Created:</th>
                      <td>{{ $pullout->created_at->format('m/d/Y') }}</td>
                  </tr>
              </table>
          </div>
          {{-- <div class="col-4">{{ date("m/d/Y") }}</div> --}}
        </div>
        <table class="table table-bordered table-sm" style="font-size: 13px">
          <thead>
            <tr>
              <th width="3%">NO</th>
              <th>ASSET CODE</th>
              <th>ITEM NAME</th>
              <th>SERIAL CODE</th>
              <th>STATUS</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pullout->pullout_detail as $key => $item)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $item->asset->asset_code }}</td>
              <td>{{ $item->asset->item_name }}</td>
              <td>{{ $item->asset->asset_code }}</td>
              <td>{{ $item->asset->asset_status->name }}</td>
            </tr>
            @endforeach
            @for ($i = 0; $i < (10-count($pullout->pullout_detail)); $i++)
              <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
            @endfor          
          </tbody>
        </table>
        <h6>REMARKS/COMMENTS</h6>
        <p>{{ html_entity_decode($pullout->remarks) }}</p>
        <div class="row justify-content-between mt-5">
          <div class="col-3">
              <small>Prepared By:</small>
              <p style="border-bottom:1px solid black;font-size:13px;margin-bottom:2px">{{ strtoupper(auth()->user()->name) }}</p>
              <p style="font-size:13px;">{{ date("m/d/Y") }}</p>
          </div>
          <div class="col-3">
              <small>Checked By:</small>
              <p style="border-bottom:1px solid black;font-size:13px;margin-bottom:1px">&nbsp;</p>
          </div>
      </div>
        <!--*** CONTENT GOES HERE ***-->
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>

</body>

</html>