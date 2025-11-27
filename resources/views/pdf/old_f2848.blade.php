<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F2848</title>
    <style>
        /* Estilos generales */
        @page {
            margin: 30px;
        }
        body {
            font-family: "Arial", sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
        }

        /* Tablas y estructura */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Encabezado */
        .header-container {
            display: flex;
            align-items: center;
        }

        .header-title {
            font-size: 18px;
            font-weight: bold;
            padding-left: 10px;
        }

        /* Secciones */
        .section-title {
            background-color: #000;
            color: #fff;
            font-weight: bold;
            border-bottom: 1px solid black;
            font-size: 12px;
            padding: 2px 0px 2px 10px;
        }

        /* Cajas de entrada */
        .input-box-title {
            width: 100%;
        }
        .input-box {
            width: 100%;
        }
        .tax-table th td {
            padding: 5px;
        }

        /* Checkbox */
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .checkbox {
            width: 10px;
            height: 10px;
            border: 1px solid black;
            display: inline-block;
        }
        .checkbox-marked {
            width: 10px;
            height: 10px;
            border: 1px solid black;
            display: inline-block;
            text-align: center;
            font-size: 14px;
            /* font-weight: bold; */
            line-height: 10px; /* Centrar la X verticalmente */
            /* position: relative; Para poder posicionar la "X" dentro del cuadro */
        }
    </style>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .bordered td, .bordered th { border: 1px solid #000; padding: 4px; }
        .noborder td { border: none; padding: 2px; }
        .center { text-align: center; }
        h5 { margin: 8px 0 4px; font-size: 14px; }
        h6 { margin: 6px 0 2px; font-size: 13px; }
        ul { margin: 2px 0 8px 16px; padding: 0; }
      </style>
</head>
<body>
    
    <table class="bordered">
    <tr>
      <td class="center">
        <strong>Form 2848 (Rev. January 2021)</strong><br>
        Power of Attorney and Declaration of Representative<br>
        Department of the Treasury – Internal Revenue Service<br>
        OMB No. 1545‑0150
      </td>
    </tr>
  </table>

  <!-- Part I -->
  <h5>Part I. Power of Attorney</h5>
  @php
    $taxpayer = '';
  @endphp
  <!-- Línea 1 -->
  <table class="bordered noborder">
    <tr>
      <td width="25%"><strong>Name &amp; Address:</strong></td>
      <td width="25%">{{ @$taxpayer->name_address }}</td>
      <td width="25%"><strong>ID Number(s):</strong></td>
      <td width="25%">{{ @$taxpayer->id_numbers }}</td>
    </tr>
    <tr>
      <td><strong>Daytime Tel.:</strong></td>
      <td>{{ @$taxpayer->phone }}</td>
      <td><strong>Plan # (if appl.):</strong></td>
      <td>{{ @$taxpayer->plan_number }}</td>
    </tr>
  </table>

  <!-- Línea 2: Representatives -->
  <table class="bordered">
    <thead>
      <tr>
        <th width="5%">#</th>
        <th width="35%">Rep. Name &amp; Address</th>
        <th width="15%">CAF No. / PTIN</th>
        <th width="20%">Phone / Fax</th>
        <th width="10%">Copies?</th>
        <th width="15%">New?</th>
      </tr>
    </thead>
    <tbody>
      @for($i =0; $i<5; $i++)
      <tr>
        <td class="center">{{ $i+1 }}</td>
        <td>{{ @$rep->name_address }}</td>
        <td>{{ @$rep->caf_no }} / {{ @$rep->ptin }}</td>
        <td>{{ @$rep->phone }} / {{ @$rep->fax }}</td>
        <td class="center">{{ @$rep->send_copies ? '✔' : '' }}</td>
        <td class="center">{{ @$rep->is_new ? '✔' : '' }}</td>
      </tr>
      @endfor
    </tbody>
  </table>

  <!-- Línea 3: Acts Authorized -->
  <h6>3. Acts authorized</h6>
  <table class="bordered">
    <thead>
      <tr>
        <th width="50%">Description of Matter</th>
        <th width="25%">Tax Form #</th>
        <th width="25%">Year(s)/Period(s)</th>
      </tr>
    </thead>
    <tbody>
      @for($i =0; $i<5; $i++)
      <tr>
        <td>{{ @$act->description }}</td>
        <td class="center">{{ @$act->form_number }}</td>
        <td class="center">{{ @$act->period }}</td>
      </tr>
      @endfor
    </tbody>
  </table>

  <!-- Línea 4 y 5a -->
  <table class="noborder">
    <tr>
      <td><strong>4.</strong> Specific use not recorded on CAF:</td>
      <td class="center">{{ @$specific_use ? '✔' : '' }}</td>
    </tr>
    <tr>
      <td><strong>5a.</strong> Additional acts authorized:</td>
      <td>
        <ul>
          @if(@$additional->access_via_isp)<li>Access IRS records via ISP</li>@endif
          @if(@$additional->authorize_disclosure)<li>Authorize disclosure to third parties</li>@endif
          @if(@$additional->substitute_rep)<li>Substitute or add representative(s)</li>@endif
          @if(@$additional->sign_return)<li>Sign a return</li>@endif
          @if(@$additional->other)<li>{{ @$additional->other }}</li>@endif
        </ul>
      </td>
    </tr>
  </table>

  <!-- Línea 5b -->
  <h6>5b. Specific acts <em>not</em> authorized:</h6>
  <p style="margin:0 0 8px;">{{ @$not_authorized }}</p>

  <!-- Línea 6 -->
  <table class="noborder">
    <tr>
      <td><strong>6.</strong> Do not revoke prior POAs:</td>
      <td class="center">{{ @$retain_prior ? '✔' : '' }}</td>
    </tr>
  </table>

  <!-- Línea 7: Signature -->
  <h6>7. Taxpayer signature</h6>
  <table class="bordered noborder">
    <tr>
      <td width="20%"><strong>Signature:</strong></td>
      <td width="30%">{{ @$signature->name }}</td>
      <td width="15%"><strong>Date:</strong></td>
      <td width="35%">{{ @$signature->date }}</td>
    </tr>
    <tr>
      <td><strong>Title:</strong></td>
      <td>{{ @$signature->title }}</td>
      <td><strong>Print name:</strong></td>
      <td>{{ @$signature->print_name }}</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Print name of taxpayer from line 1 (if other than individual):</strong><br>
        {{ @$signature->print_taxpayer }}
      </td>
    </tr>
  </table>

  <!-- Part II -->
  <h5>Part II. Declaration of Representative</h5>
  <p>Under penalties of perjury, by my signature below I declare that:</p>
  <ul>
    <li>I am not currently suspended or disbarred...</li>
    <li>I am subject to Circular 230 regulations...</li>
    <li>I am authorized to represent the taxpayer...</li>
    <li>I am one of the following:</li>
  </ul>

  <!-- Firmas de representantes -->
  <table class="bordered">
    <thead>
      <tr>
        <th width="5%">#</th>
        <th width="15%">Designation</th>
        <th width="25%">Licensing jurisdiction</th>
        <th width="20%">Bar/License #</th>
        <th width="20%">Signature</th>
        <th width="15%">Date</th>
      </tr>
    </thead>
    <tbody>
      @for($i=0; $i<3; $i++)
      <tr>
        <td class="center">{{ $i+1 }}</td>
        <td class="center">{{ @$d->designation }}</td>
        <td>{{@$d->jurisdiction }}</td>
        <td class="center">{{ @$d->bar_number }}</td>
        <td>{{ @$d->signature }}</td>
        <td class="center">{{ @$d->date }}</td>
      </tr>
      @endfor
    </tbody>
  </table>




</body>
</html>