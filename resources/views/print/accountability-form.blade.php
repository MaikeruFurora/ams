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
        height: 90px;
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
    <table class="font-weight-bold">
        <tr>
            <td width="10%"><img src="{{ asset('assets/images/download.png') }}" alt="" width="80%" class="mr-3"></b></td>
            <td>
                INFORMATION TECHNOLOGY <br>
                HEAD OFFICE
            </td>
        </tr>
    </table>
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
          <table width="100%" class="text-white" style=" background-color: #7E7E7E;">
                <tr>
                    <td ><b>SECTION I. ACCOUNTABILITY AGREEMENT FORM</b></td>
                </tr>
          </table>
          <table class="table table-sm table-bordered font-weight-bold">
                <tr>
                    <td width="20%">Control Number</td>
                    <td>: {{ $accountability->control_no }}</td>
                </tr>
                <tr>
                    <td>Employee Name</td>
                    <td>: {{ $accountability->user->name }}</td>
                </tr>
                <tr>
                    <td>Department | Position</td>
                    <td>: {{ $accountability->user->department->name }} | {{ $accountability->user->job_title }}</td>
                </tr>
          </table>
          <table width="100%">
            <tr>
                <td class="text-white" style=" background: #7E7E7E;"><b>SECTION I. ACCOUNTABILITY AGREEMENT FORM</b></td>
            </tr>
            <tr>
                <td>Please acknowledge receipt of the Computer/Laptop and/or other IT Equipment Accessories issued by Information Technology Department (ITD) herein described in your agreement to the Assignees undertaking by signing your name in the space indicated below in every page of this document.</td>
            </tr>
          </table>
          <table class="table table-sm table-bordered font-weight-bold" style="">
            <tr>
                <td>ITEM NO.</td>
                <td>DESCTRIPTION</td>
                <td>SERIAL NUMBER</td>
                <td>ASSET-CODE</td>
            </tr>
            @foreach ($asset as $key => $item)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $item->asset->description }}</td>
              <td>{{ $item->asset->serial_no }}</td>
              <td>{{ $item->asset->asset_code }}</td>
          </tr>
            @endforeach
          </table>
          <b>NOTE: You may request an IT STAFF to assist you in confirming these specifications.</b>
          <table width="100%" class="text-white">
            <tr>
                <td style=" background: #7E7E7E;"><b>SECTION III. UNIT COST</b></td>
            </tr>
          </table>
          <div class="row">
            <div class="col-md-6 offset-md-3">
                <table class="m-5">
                    <tr>
                        <td>VENDOR</td>
                        <td>: {{ $asset[0]->asset->supplier->name }}</td>
                    </tr>
                    <tr>
                        <td>PURCHASE DATE</td>
                        <td>: {{ $asset[0]->asset->date_purchase }}</td>
                    </tr>
                    <tr>
                        <td>DESKTOP COST</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td>LIFESPAN</td>
                        <td>: </td>
                    </tr>
                </table>
            </div>
          </div>
          <table width="100%" class="text-white">
            <tr>
                <td style=" background: #7E7E7E;"><b>SECTION IV. ASSIGNEE’S UNDERTAKING ACKNOWLEDGEMENT</b></td>
            </tr>
          </table>
          <p>
            Please be informed that by acknowledging receipt of this computer, you agreed to the following: I recognize that this <b>COMPUTER/LAPTOP</b> (and any software included) has been made available to me by <b>ARVIN INTERNATIONAL MARKETING</b> solely to assist me in the performance and continuance of my duties with the Company.
          </p>
          <p>The Computer and associated software remains the property of <b>ARVIN INTERNATIONAL MARKETING</b> resource at all times.</p>
          <p>I accept personal responsibility at all times, for the safeguarding of the said computer/laptop and software, and in doing so, I agree to take all reasonable measures to protect this Computer (and software) from theft and unauthorized use; keep it in proper working condition; and protect it against computer viruses. (See Section VI no. 1)</p>
          <p>I understand that the Company's policies and procedures include, but are not limited to the following:</p>
            <ol class="text-justify">
                <li>In the event of DAMAGE OR LOSS, whether in the office, at home or in transit, the Company may file a claim against me, provided, the cause of such loss or damage is my fault, mistake, malice or negligence. (See Section VI no. 2)</li>
                <li>I will return the said Computer/Laptop and software installed therein to AIM IT DEPARTMENT from which it was issued when requested to do so through its authorized person. I also agree to bring this laptop/computer to the office, when requested to do so, and to submit it to a diagnostic and technical review.</li>
                <li>I will not copy any software onto my computer/laptop from any source prior approval from the Information Technology Department. (See Section VI no. 3)</li>
                <li>I will not access generally-accepted restricted sites in the internet or WORLD WIDE WEB (WWW) through my computer/laptop except when it is needed in the performance of my duties or in circumstances where IT Department's prior approval has been given. In such cases I will always follow the ARIN INTERNATIONAL MARKETING Resource Access rules </li>
                <li>I will not attempt to circumvent the automatic virus scanner loaded onto the computer/laptop.</li>
                <li>I will not attempt to circumvent the automatic virus scanner loaded onto the computer/laptop.</li>
                <li>I understand that this Agreement forms part of the terms and conditions of my employment as detailed in IT Department’s.</li>
                <li>I have read, understood and agree to comply with everything on this form.</li>
            </ol>
         
          <table width="100%" class="text-white">
            <tr>
                <td style=" background: #7E7E7E;"><b>SECTION V. FOR LAPTOP/DESKTOP/TABLET/MOBILE DEVICES</b></td>
            </tr>
          </table>
          <ol>
            <li>
               Device should be kept safe and secured
                <ol type="a">
                    <li>Device is not to be left at the assignee’s premises overnight unless it can be securely locked away.</li>
                    <li>Device should not be left in a car.</li>
                    <li>Device should be kept in a secure area or out of sight when the assignee is absent from his/her work area for long periods.</li>
                    <li>Device should be kept in a secure place at home.</li>
                    <li>At hotels or public establishments, the Computer should be kept out of sight in locked rooms or deposited to hotel security.</li>
                </ol>
            </li>
            <li>Damage or Loss items:
                <ol type="a">
                    <ol>
                        <li>In case of Loss/Damage of the item/s, whether in the office/field, at home or in transit, the COMPANY MAY FILE A CLAIM AGAINST ME.</li>
                        <li>I am responsible to notify IT Department immediately.</li>
                        <li>I will secure and submit all the required documents (e.g. POLICE REPORT, POWER OF ATTORNEY, and WRITTEN EXPLANATION SIGNED BY THE ASSIGNEE) to IT Department for insurance of claims (if applicable).</li>
                        <li>Denial for insurance claim due to failure to comply with the above requirements, I WILL BE LIABLE TO PAY THE COST OF THE REPAIR OR REPLACEMENT OF THE UNIT.</li>
                    </ol>
                </ol>
            </li>
          </ol>
          <table width="100%" class="text-white">
            <tr>
                <td style=" background: #7E7E7E;"><b>SECTION VI. NOTES TO IT DEVICE EQUIPMENT DECLARATION</b></td>
            </tr>
          </table>
            <ol>
                <li>The Copying and installation of computer games are completely prohibited. Copying other non - ARIN INTERNATIONAL MARKETING resource software for personal use is also prohibited due to the risk of virus infection and breach of copyright. Some staff has been issued with software, in addition to the normal load set, for which limited licenses are held. This set of software should not be copied without prior permission from the IT Department to avoid violating the licensing agreement.</li>
                <li>Internet access, other that email, may be conducted only for business purposes. Generally - accepted restricted sites includes porn, vulgar and download sites for video and audio streams. Anti - virus software should always be enabled.</li>
                <li>Copies for this declaration should be retained by the person signing and by the IT Department as part of the terms and conditions of employment.</li>
            </ol>
            <table width="100%" class="text-white">
                <tr>
                    <td style=" background: #7E7E7E;"><b>  SECTION VII. REPORT SIGNATORIES</b></td>
                </tr>
            </table>
            <table class="table table-sm table-bordered  text-center">
                <tr class=" font-weight-bold">
                    <td width="20%">Checked and Issued By:</td>
                    <td>Reviewed By:</td>
                    <td>Approved By:</td>
                    <td>Conforme</td>
                </tr>
                <tr>
                    <td><br>
                        <b>CHRIS BYRON</b><br>
                        Senior IT Associate
                        <br><br>
                        <b>JOSHUA SALCEDO</b><br>
                        Junior IT Associate
                    </td>
                    <td>
                        <br><br>
                        <b>NORMAN GUIRIBA</b><br>
                        IT - Supervisor
                    </td>
                    <td>
                        <br><br>
                        <b>ANNIKA Y. LAO</b><br>
                        Chief Finance Officer
                    </td>
                    <td>
                        <br><br><br><br><br>
                        <b>PRINTED NAME OF THE ASSIGNEE</b>
                    </td>
                </tr>
          </table>
           <table width="100%" class="font-weight-bold">
                <tr>
                    <td class="text-white" style=" background: #7E7E7E;"><b>SECTION VIII. TO BE ACCOMPLISHED UPON RETURN OF ITEM / UNIT</b></td>
                </tr>
                <tr>
                    <td class="text-center">When the assignee / employee resigned or the assignee will have a new unit</td>
                </tr>
            </table>
            <table class="text-center table table-bordered font-weight-bold table-sm">
                <tr>
                    <td>Returned by:</td>
                    <td>Received by:</td>
                </tr>
                <tr>
                    <td><br><br>SIGNATURE OVER PRINTED NAME</td>
                    <td><br><br>SIGNATURE OVER PRINTED NAME</td>
                </tr>
                <tr class="text-left">
                    <td>Date: {{ date("m/d/Y") }}</td>
                    <td>Date: {{ date("m/d/Y") }}</td>
                </tr>
            </table>
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