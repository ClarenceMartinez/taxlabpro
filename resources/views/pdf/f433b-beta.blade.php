<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>433b</title>
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

        @font-face {
            font-family: 'OCR-B';
            src: url('/fonts/OCR-B.otf') format('opentype');
        }

        /* Tablas y estructura */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .font-irs-title {
            font-family: "Arial Black", "Arial", sans-serif;
            font-weight: bold;
            font-size: 32px;
            text-transform: uppercase;
            text-shadow: 2px 2px 2px black;
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

        p.parrafo, .parrafo{
            font-size: 10px;
            color : #002880;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        .tl{text-align: left;}
        
    </style>
</head>
<body>
<!-- Encabezado -->
    <table style="border-bottom: 2px solid #000;">
        <tr>
            <td width="18%" style="font-size: 9px; margin: 0; padding: 1px; border-right: 1px solid #000;">
                Form <span class="font-irs-title">433-B</span>
                <br>
                (Febrero 2019)
                <br>
                Department of the Treasury <br>
                Internal Revenue Service
            </td>
            <td width="82%" style="text-align: center;border-right: 1px solid #000;">
                <div style="font-size: 20px;font-weight: bold;">
                    Collection Information Statement for Businesses
                </div>
            </td>
        </tr>
    </table>
    <table style="font-size: 11px;">
        <tr>
            <td colspan="2">
                <strong>Nota:</strong> <em> Complete all entry spaces with the current data available or "N/A" (not applicable). Failure to complete all entry spaces may result in rejection of
                your request or significant delay in account resolution.</em><strong>Include attachments if additional space is needed to respond completely to any question.</strong>
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 12px;">
        <tr>
            <td colspan="2">
                <div class="section-title">Section 1: Business Information</div>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-right: 1px solid black;">
                <strong>1a</strong> Business Name
                {{$client->business_name}}
                <br>
                <strong>1b</strong> Business Street Address
                {{$client->business_address}}
                <br>
                Mailing Address:  {{$client->business_email_address}}<br>
                City {{$client->city}} State {{$client->state_name}} Zip {{$client->zipcode}} <br>
                <strong>1c</strong> Country: {{$client->country_name}}<br>
                <strong>1d</strong> Business Telephone: {{$client->business_phone}}<br>
                <strong>1e</strong> Type of Business: {{$client->type_of_business}}<br>
                <strong>1f</strong> Business Website (web address): {{$client->business_website}}<br>
            </td>
            <td width="50%" >
                <strong>2a</strong> Employer Identification No. (EIN): {{$client->business_ein}}
                <br>
                <strong>2b</strong> Type of entity (Check appropriate box below):
                <br>
                @foreach($businessTypes as $businessType)
                       <div class="checkbox {{ ($businessType->id == $client->type_of_entity) ? 'checkbox-marked' : ''}}">{{ ($businessType->id == $client->type_of_entity) ? 'X' : ''}}</div> {{$businessType->name}} 
                    <!-- <div class="checkbox"></div> Partnership 
                    <div class="checkbox"></div> Corporation 
                    <div class="checkbox"></div> Other <br>
                    <div class="checkbox"></div> Limited Liability Company (LLC) classified as a corporation <br>
                    <div class="checkbox"></div> Other LLC - Include number of members <br> -->
                @endforeach
                <br>

                <strong>2c</strong> Date Incorporated/Established: {{$client->date_stablished}}
                <hr style="border: .2px solid #000">
                <strong>3a</strong> Number of Employees:  {{$client->total_number_of_employees}}
                <br>
                <strong>3b</strong> Monthly Gross Payroll: {{$client->average_gross_monthly_payroll}}
                <br>
                <strong>3c</strong> Frequency of Tax Deposits: {{$client->frequency_tax_deposits}}
                <br>
                <strong>3d</strong> Is the business enrolled in Electronic
                Federal Tax Payment System (EFTPS) <div class="checkbox {{ ($client->federal_contractor == '1') ? 'checkbox-marked' : ''}}">{{ ($client->federal_contractor == '1') ? 'X' : ''}}</div> Yes <div class="checkbox {{ ($client->federal_contractor == '0') ? 'checkbox-marked' : ''}}">{{ ($client->federal_contractor == '0') ? 'X' : ''}}</div> No
            </td>
        </tr>
        <tr>
            <td colspan="2">
               <strong>4</strong> Does the business engage in e-Commerce (Internet sales) If yes, complete 5a and 5b. 
               <div class="checkbox {{ ($client->engage_ecommerce == 'yes') ? 'checkbox-marked' : ''}}">{{ ($client->engage_ecommerce == 'yes') ? 'X' : ''}}</div> Yes 
               <div class="checkbox {{ ($client->engage_ecommerce == 'no') ? 'checkbox-marked' : ''}}">{{ ($client->engage_ecommerce == 'no') ? 'X' : ''}}</div> No
            </td>
        </tr>
        <tr>
            <td colspan="2">
               <strong>PAYMENT PROCESSOR</strong> <em>(e.g., PayPal, Authorize.net, Google Checkout, etc.)</em>  Include virtual currency wallet, exchange or digital currency exchange
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 12px;">
        <tr style="text-align: center">
            <td>Name and Address <em>(Street, City, State, ZIP code)</em> </td>
            <td>Payment Processor Account Number</td>
        </tr>
        @php
            $contadorEcommerce  = 0;
        @endphp
        @foreach($ecommerceProcessors as $ecommerceProcessor)
            @php
                $contadorEcommerce+= 1;
            @endphp
        <tr>
            <td><strong>5{{ chr(97 + $loop->index) }}</strong> {{$ecommerceProcessor->processor_name.' '.$ecommerceProcessor->street_address.' '.$ecommerceProcessor->city_state_zip}}</td>
            <td>{{$ecommerceProcessor->account_number}}</td>
        </tr>
        @endforeach

        @if($contadorEcommerce == 0)
            @for($i = 0; $i< 2; $i++)
                <tr>
                    <td><strong>5{{ chr(97 + $loop->index) }}</strong> </td>
                    <td></td>
                </tr>
            @endfor
        @endif
        <tr>
            <td colspan="2">
                <strong>CREDIT CARDS ACCEPTED BY THE BUSINESS</strong>
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 12px;">
        <tr style="text-align: center">
            <td>Type of Credit Card <br><em>(e.g., Visa, Mastercard, etc.)</em> </td>
            <td>Merchant Account Number </td>
            <td>Issuing Bank Name and Address <em>(Street, City, State, ZIP code)</em> </td>
        </tr>

        @php
            $contadorcreditCard  = 0;
        @endphp
        @foreach($creditCards as $creditCard)
            @php
                $contadorcreditCard+= 1;
            @endphp

        <tr style="text-align: left">
            <td><strong>6{{ chr(97 + $loop->index) }}</strong> {{$creditCard->card_type}}</td>
            <td>{{$creditCard->merchant_account_number}}</td>
            <td>{{$creditCard->phone}}</td>
        </tr>
        @endforeach

        @if($contadorcreditCard == 0)
            @for($i= 0; $i<2; $i++)
            <tr style="text-align: left">
                <td><strong>6{{ chr(97 + $loop->index) }}</strong> </td>
                <td></td>
                <td>phone</td>
            </tr>
            
            @endfor
        @endif



    </table>
    <table border="1" style="font-size: 12px;">
        <tr>
            <td colspan="2">
                <div class="section-title">Section 2: Business Personnel and Contacts</div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>PARTNERS, OFFICERS, LLC MEMBERS, MAJOR SHAREHOLDERS (Foreign and Domestic), ETC.</strong>
            </td>
        </tr>

        @php
            $i= 0;
            $contadorOffice = 0;
        @endphp

        @foreach($partnerOffices as $partnerOffice)
            @php
                $contadorOffice += 1;
                $state          = $statesOfAmerica->firstWhere('id', $partnerOffice->state);

            @endphp
        <tr>
            <td>
                <strong>7{{ chr(97 + $loop->index) }}</strong><br>
                Full Name:  {{$partnerOffice->first_name.' '.$partnerOffice->last_name}}        <br>
                Title:  {{$partnerOffice->title}}            <br>
                Home Address: {{$partnerOffice->street_address}}      <br>
                City:  {{$partnerOffice->city}}             State:   {{$state->name}}         Zip Code:  {{$partnerOffice->zip_code}}         <br>
                Responsible for Depositing Payroll Taxes: 
                <div class="checkbox {{ ($partnerOffice->responsible_for_depositing_payroll_taxes == '1') ? 'checkbox-marked' : ''}}">{{ ($partnerOffice->responsible_for_depositing_payroll_taxes == '1') ? 'X' : ''}}</div> Yes 
                <div class="checkbox {{ ($partnerOffice->responsible_for_depositing_payroll_taxes == '1') ? 'checkbox-marked' : ''}}">{{ ($partnerOffice->responsible_for_depositing_payroll_taxes == '0') ? 'X' : ''}}</div> No <br>
            </td>
            <td>
                Taxpayer Identification Number: {{$partnerOffice->social_security_number}}<br>
                Home Telephone: {{$partnerOffice->phone1}}<br>
                Work/Cell Phone: {{$partnerOffice->phone2}}<br>
                Ownership Percentage & Shares or Interest: {{$partnerOffice->ownership_percentage}}<br>
                Annual Salary/Draw: {{$partnerOffice->annual_salary_draw}}
            </td>
        </tr>
        @endforeach

        @if($contadorOffice < 4)
            @for($i = $contadorOffice; $i< 4; $i++)
                <tr>
                    <td>
                        <strong>7{{ chr(97 + $i) }}</strong><br>
                        Full Name:          <br>
                        Title:              <br>
                        Home Address:       <br>
                        City:               State:              Zip Code:           <br>
                        Responsible for Depositing Payroll Taxes: <div class="checkbox"></div> Yes <div class="checkbox"></div> No <br>
                    </td>
                    <td>
                        Taxpayer Identification Number: <br>
                        Home Telephone: <br>
                        Work/Cell Phone: <br>
                        Ownership Percentage & Shares or Interest: <br>
                        Annual Salary/Draw:
                    </td>
                </tr>
            @endfor

        @endif
        
    </table>
    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 16649P</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-B</strong> (Rev. 2-2019)</td>
        </tr>
    </table>
    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 2 -->
    <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <br><br><br><br> <br><br><br><br>
    <!-- Pagina 2 -->
    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-B (Rev. 2-2019)</td>
            <td width="5%">Page <strong style=" font-size: 12px">2</strong></td>
        </tr>
    </table> 
    <table border="1" style="font-size: 12px;">
        <tr>
            <td colspan="4">
                <div class="section-title">Section 3: Other Financial Information <em>(Attach copies of all applicable documents)</em> </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong>8 Does the business use a Payroll Service Provider or Reporting Agent</strong> <em> (If yes, answer the following)</em>
                <div class="checkbox {{ ($client->payroll_service_provider == 'yes') ? 'checkbox-marked' : ''}}">{{ ($client->payroll_service_provider == 'yes') ? 'X' : ''}}</div> <strong>Yes</strong> 
                <div class="checkbox {{ ($client->payroll_service_provider == 'no') ? 'checkbox-marked' : ''}}">{{ ($client->payroll_service_provider == 'no') ? 'X' : ''}}</div> <strong>No</strong>
            </td>
        </tr>
        <tr>
            <td colspan="3" width="80%">
                Name and Address <em>(Street, City, State, ZIP code)</em>
                {{$payrollServiceProviders[0]->provider_name.' '.$payrollServiceProviders[0]->address.' '.$payrollServiceProviders[0]->city_state_zip}} 
            </td>
            <td width="20%">
                Effective dates  <em>{{ \Carbon\Carbon::parse($payrollServiceProviders[0]->effective_date)->format('mdY') }}</em> 
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong>9 Is the business a party to a lawsuit</strong> <em> (If yes, answer the following)</em>
                <div class="checkbox {{ ($client->business_party_lawsuit == 'yes') ? 'checkbox-marked' : ''}}">{{ ($client->business_party_lawsuit == 'yes') ? 'X' : ''}}</div> <strong>Yes</strong> 
                <div class="checkbox {{ ($client->business_party_lawsuit == 'no') ? 'checkbox-marked' : ''}}">{{ ($client->business_party_lawsuit == 'no') ? 'X' : ''}}</div> <strong>No</strong>
            </td>
        </tr>
        @foreach($lawsuits as $lawsuit)
            <tr>
                <td width="25%">
                    <div class="checkbox {{ ($client->lawsuit == 'plaintiff') ? 'checkbox-marked' : ''}}"> {{ ($client->lawsuit == 'plaintiff') ? 'X' : ''}}</div> Plaintiff 
                    <div class="checkbox {{ ($client->lawsuit == 'defendant') ? 'checkbox-marked' : ''}}"> {{ ($client->lawsuit == 'defendant') ? 'X' : ''}}</div> Defendant
                </td>
                <td width="25%">
                    Location of Filing {{$lawsuit->location_of_filing}}  <br><br>
                </td>
                <td width="25%">
                    Represented by {{$lawsuit->represented_by}}<br><br>
                </td>
                <td width="25%">
                    Docket/Case No.  {{$lawsuit->docket_case_number}}<br><br>
                </td>
            </tr>
            <tr>
                <td width="25%">
                    Amount of Suit <br>
                    $ {{$lawsuit->amount_of_suit}}
                </td>
                <td width="25%">
                    Possible Completion Date {{ \Carbon\Carbon::parse($lawsuit->possible_completion_date)->format('mdY') }}<br><br>
                </td>
                <td width="50%" colspan="2">
                    Subject of Suit {{$lawsuit->subject_of_suit}}<br><br>
                </td>
            </tr>
        @endforeach


        <tr>
            <td width="100%" colspan="4">
                <strong>10 Has the business ever filed bankruptcy</strong> <em> (If yes, answer the following)</em>
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 12px;">
        @foreach($bankruptcies as $bankruptcy)
        <tr>
            <td width="20%">
                Date Filed <em>(mmddyyyy)</em> {{ \Carbon\Carbon::parse($bankruptcy->date_field)->format('mdY')}}<br><br>
            </td>
            <td width="20%">
                Date Dismissed <em>(mmddyyyy)</em> {{ \Carbon\Carbon::parse($bankruptcy->date)->format('mdY')}}<br><br>
            </td>
            <td width="20%">
                Date Discharged  <em>(mmddyyyy)</em> {{ \Carbon\Carbon::parse($bankruptcy->date)->format('mdY')}}<br><br>
            </td>
            <td width="20%">
                Petition No {{$bankruptcy->petition_no}}<br><br>
            </td>
            <td width="20%">
                District of Filing   {{$bankruptcy->location}}<br><br>
            </td>
        </tr>
        @endforeach


        <tr>
            <td width="100%" colspan="5">
                <strong>11 Do any related parties <em>(e.g., officers, partners, employees)</em> have outstanding amounts owed to the business</strong> <em> (If yes, answer the following)</em>
                <div class="checkbox {{ ($client->related_parties_owe_business == 'yes') ? 'checkbox-marked' : ''}}"> {{ ($client->related_parties_owe_business == 'yes') ? 'X' : ''}}</div> <strong>Yes</strong> 
                <div class="checkbox {{ ($client->related_parties_owe_business == 'no') ? 'checkbox-marked' : ''}}"> {{ ($client->related_parties_owe_business == 'no') ? 'X' : ''}}</div> <strong>No</strong>
            </td>
        </tr>
        @foreach($relatedPartyOweBusiness as $relatedPartyOw)

        <tr>
            <td width="50%">
                Name and Address <em>(Street, City, State, ZIP code)</em> <br>
                {{$relatedPartyOw->name.' '.$relatedPartyOw->address.' '.$relatedPartyOw->city_state_zip}}<br>
            </td>
            <td width="10%">
                Date of Loan <em>(mmddyyyy)</em><br>{{ \Carbon\Carbon::parse($relatedPartyOw->date_of_loan)->format('mdY')}}<br><br>
            </td>
            <td width="20%">
                Current Balance As of   <br><br>
                $ {{$relatedPartyOw->current_balance}}
            </td>
            <td width="10%">
                Payment Date <br><br>
                {{ \Carbon\Carbon::parse($relatedPartyOw->payment_date)->format('mdY')}}
            </td>
            <td width="10%">
                Payment Amount<br><br>
                {{$relatedPartyOw->payment_amount}}
            </td>
        </tr>
        @endforeach


        <tr>
            <td width="100%" colspan="5">
                <strong>12 Have any assets been transferred, in the last 10 years, from this business for less than full value </strong> <em> (If yes, answer the following)</em>
                <div class="checkbox {{ ($client->assets_transferred_less_value == 'yes') ? 'checkbox-marked' : ''}}"> {{ ($client->assets_transferred_less_value == 'yes') ? 'X' : ''}}</div> <strong>Yes</strong> 
                <div class="checkbox {{ ($client->assets_transferred_less_value == 'no') ? 'checkbox-marked' : ''}}"> {{ ($client->assets_transferred_less_value == 'no') ? 'X' : ''}}</div> <strong>No</strong>
            </td>
        </tr>
        @foreach($businessAssetTransfers as $businessAssetTransfer)
            <tr>
                <td width="50%" colspan="2">
                    List Asset <br><br>
                    {{$businessAssetTransfer->asset}}
                </td>
                <td width="20%">
                    Value at Time of Transfer <br><br>
                    $ {{$businessAssetTransfer->asset}}
                </td>
                <td width="15%">
                    Date Transferred <em> (mmddyyyy)</em> <br><br>
                    {{ \Carbon\Carbon::parse($businessAssetTransfer->date_transferred)->format('mdY')}}
                    
                </td>
                <td width="15%">
                    To Whom or Where Transferred<br><br>{{$businessAssetTransfer->where_transferred}}
                </td>
            </tr>
        @endforeach

        <tr>
            <td width="100%" colspan="5">
                <strong>13 Does this business have other business affiliations <em>(e.g., subsidiary or parent companies)</em> </strong> <em> (If yes, answer the following)</em>
                <div class="checkbox {{ ($client->assets_transferred_less_value == 'yes') ? 'checkbox-marked' : ''}}">{{ ($client->assets_transferred_less_value == 'yes') ? 'X' : ''}}</div> <strong>Yes</strong> 
                <div class="checkbox {{ ($client->assets_transferred_less_value == 'yes') ? 'checkbox-marked' : ''}}">{{ ($client->assets_transferred_less_value == 'yes') ? 'X' : ''}}</div> <strong>No</strong>
            </td>
        </tr>
        <tr>
            <td width="80%" colspan="4">
                Related Business Name and Address  <em>(Street, City, State, ZIP code)</em>
            </td>
            <td>
                Related Business EIN:
            </td>
        </tr>
        <tr>
            <td width="100%" colspan="5">
                <strong>14 Any increase/decrease in income anticipated  </strong> <em> (If yes, answer the following)</em>
                <div class="checkbox {{ ($client->income_increase_decrease == 'yes') ? 'checkbox-marked' : ''}}">{{ ($client->income_increase_decrease == 'yes') ? 'X' : ''}}</div> <strong>Yes</strong> 
                <div class="checkbox {{ ($client->income_increase_decrease == 'no') ? 'checkbox-marked' : ''}}">{{ ($client->income_increase_decrease == 'no') ? 'X' : ''}}</div> <strong>No</strong>
            </td>
        </tr>

        @foreach($incomeChanges as $incomeChange)
        <tr>
            <td width="70%" colspan="3">
                Explain  <em>(Use attachment if needed)</em><br>
                {{$incomeChange->explanation}}<br>
            </td>
            <td>
                How much will it increase/decrease <br>{{$incomeChange->amount}}<br>
            </td>
            <td>
                When will it increase/decrease <br>{{$incomeChange->date_of_change}}<br>
            </td>
        </tr>
        @endforeach


        <tr>
            <td width="100%" colspan="5">
                <strong>15 Is the business a Federal Government Contractor </strong> <em>  (Include Federal Government contracts in #18, Accounts/Notes Receivable)</em>
                <br>
                <div class="checkbox"></div> <strong>Yes</strong> 
                <div class="checkbox"></div> <strong>No</strong>
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px;">
        <tr>
            <td colspan="4">
                <div class="section-title">Section 4: Business Asset and Liability Information (Foreign and Domestic)</div>
            </td>
        </tr>
        <tr style="text-align: left">
            <td width="70%" colspan="3">
                <strong>16a CASH ON HAND </strong> <em>Include cash that is not in the bank</em>          <strong>Total Cash on Hand</strong>
            </td>
            <td width="30%" >
                $ {{ isset($safes[0]) ? $safes[0]->value : '' }}
            </td>
        </tr>
        <tr style="text-align: left">
            <td width="50%" colspan="2">
                <strong>16b Is there a safe on the business premises </strong> 
                <div class="checkbox {{ $client->safe_on_premises == 'yes' ? 'checkbox-marked' : ''}}">{{ $client->safe_on_premises == 'yes' ? 'X' : ''}}</div> <strong>Yes</strong> 
                <div class="checkbox {{ $client->safe_on_premises == 'no' ? 'checkbox-marked' : ''}}">{{ $client->safe_on_premises == 'no' ? 'X' : ''}}</div> <strong>No</strong>
            </td>
            <td width="50%" colspan="2">
                Contents <br>{{ isset($safes[0]) ? $safes[0]->contents : '' }}<br>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong>BUSINESS BANK ACOUNTS</strong>  Include online and mobile accounts (e.g., PayPal), money market accounts, savings accounts, checking accounts
                    and stored value cards (e.g., payroll cards, government benefit cards, etc.) <br>
                    List safe deposit boxes including location, box number and value of contents. Attach list of contents
            </td>
        </tr>
        <tr style="text-align: center">
            <td width="30%" >
                Type of
                Account
            </td>
            <td width="40%">
                Full Name and Address (Street, City, State, ZIP code) of 
                Bank, Savings & Loan, Credit Union or Financial Institution
            </td>
            <td width="15%">Account Number</td>
            <td width="15%">
                Account Balance
                As of <em>(mmddyyyy)</em>
            </td>
        </tr>
        @php
            $contadorBankAccount = 0;
            $totalBankAccount = 0;
        @endphp
        @foreach($bankAccounts as $bankAccount)
            @if(isset($bankAccountTypes[$bankAccount->type_of_account]))
                @php
                    $bankAccountTypeName = $bankAccountTypes[$bankAccount->type_of_account];
                    $contadorBankAccount    += 1;
                    $totalBankAccount       += $bankAccount->current_value;
                @endphp
            @else
                @php
                    $bankAccountTypeName = (object)['name' => 'Tipo desconocido'];
                @endphp
            @endif
        <tr style="text-align: left">
            <td width="30%" >
                <strong>17{{ chr(97 + $loop->index) }}  {{$bankAccountTypeName->name}}</strong> 
            </td>
            <td width="40%">
               {{$bankAccount->bank_name}}
            </td>
            <td width="15%">{{$bankAccount->account_number}}</td>
            <td width="15%">
               $ {{ number_format($bankAccount->current_value,2)}}
            </td>
        </tr>
        @endforeach
        @if($contadorBankAccount < 4)
            @for($i = $contadorBankAccount; $i < 4; $i++)
                <tr style="text-align: left">
                    <td width="30%" >
                        <strong>17{{ chr(97 + $i) }}</strong> 
                    </td>
                    <td width="40%">
                       
                    </td>
                    <td width="15%"></td>
                    <td width="15%">
                       $ 
                    </td>
                </tr>
            @endfor
        @endif

        <tr style="text-align: left">
            <td width="80%" colspan="3">
                <strong>17d Total Cash in Banks</strong> <em> (Add lines 17a through 17c and amounts from any attachments)</em>
            </td>
            <td width="20%">
               $ {{number_format($totalBankAccount,2)}}
            </td>
        </tr>
    </table>
    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 16649P</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-B</strong> (Rev. 2-2019)</td>
        </tr>
    </table>
    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 2 -->
    <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <br><br><br><br> <br><br><br><br>
    <!-- Pagina 3 -->
    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-B (Rev. 2-2019)</td>
            <td width="5%">Page <strong style=" font-size: 12px">3</strong></td>
        </tr>
    </table> 
    <table style="font-size: 11px;border-top: 2px solid #000">
        <tr>
            <td colspan="5">
                <strong>ACCOUNTS/NOTES RECEIVABLE</strong> Include e-payment accounts receivable and factoring companies, and any bartering or online auction accounts.
                <br><em> (List all contracts separately including contracts awarded, but not started).</em><strong>Include Federal, state and local government grants and contracts</strong>
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px;">
        <tr>
            <td width="20%" >
                <strong>Name & Address</strong>
                <em>(Street, City, State, ZIP code and Country)</em> 
            </td>
            <td width="10%">
            Status <em>(e.g., age,
            factored, other)</em>
            </td>
            <td width="10%">
            Date Due <br><em>(mmddyyy)</em>
            </td>
            <td width="20%">
                Invoice Number or Government<br>
                Grant or Contract Number 
            </td>
            <td width="20%">
                <strong>Amount Due</strong>
            </td>
        </tr>
        @php
            $contadorReceivables    = 0;
            $totalReceivables       = 0;
        @endphp
        @foreach($receivables as $receivable)
            @php
                $contadorReceivables    += 1;
                $totalReceivables       +=  $receivable->amount_due;
            @endphp
        <tr style="text-align: left">
            <td width="30%" >
                <strong>18{{ chr(97 + $loop->index) }}  {{$receivable->type.' '.$receivable->account_description.' '.$receivable->address.' '.$receivable->city_state_zip }}</strong> 
                <br>

                <br>
                <br>
                Contact Name {{$receivable->contact}}<br>
                Phone {{$receivable->phone}}
            </td>
            <td width="10%">{{$receivable->status}}</td>
            <td width="10%">{{$receivable->due_date}}</td>
            <td width="30%">{{$receivable->invoice_no}}</td>
            <td width="20%">${{number_format($receivable->amount_due,2)}}</td>
        </tr>
        @endforeach

        @if($contadorReceivables < 5)
            @for($i= $contadorReceivables; $i< 5; $i++)
                <tr style="text-align: left">
                    <td width="30%" >
                        <strong>18{{ chr(97 + $i) }}</strong> 
                        <br>

                        <br>
                        <br>
                        Contact Name <br>
                        Phone
                    </td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="30%"></td>
                    <td width="20%">$</td>
                </tr>
            @endfor
        @endif



        
        <tr style="text-align: left" >
            <td width="80%" colspan="4">
                <strong>18f Outstanding Balance</strong>
            <td width="20%">$ {{number_format($totalReceivables,2)}}</td>
        </tr>
        <tr style="text-align: left" >
            <td width="100%" colspan="5" >
                <strong>INVESTMENTS</strong> List all investment assets below. Include stocks, bonds, mutual funds, stock options, certificates of deposit, commodities (e.g.,
                gold, silver, copper, etc.) and virtual currency (e.g., Bitcoin, Ripple and Litecoin).
            </td>
        </tr>
        <tr style="text-align: center">
            <td width="50%" >
                Name of Company & Address
                <br>
                <em>(Street, City, State, ZIP code)</em>
            </td>
            <td width="20%">Used as collateral on loan</td>
            <td width="10%">Current Value</td>
            <td width="10%">Loan Balance</td>
            <td width="10%"><strong>Equity</strong><br>Value Minus Loan</td>
        </tr>

        @php
            $contadorInvestmentAccounts = 0;
            $totalInvestmentAccounts = 0;
        @endphp
        @foreach($investmentAccounts as $investmentAccount)
            @php
                $contadorInvestmentAccounts += 1;
                $equity                     = $investmentAccount->current_value - $investmentAccount->loan_balance;
                $totalInvestmentAccounts    += $equity;
            @endphp
        <tr style="text-align: left">
            <td width="50%" >
                <strong>19{{ chr(97 + $loop->index) }}</strong> 
                <br>
                {{$investmentAccount->company_name.' '.$investmentAccount->address.' '.$investmentAccount->city_state_zip}}
                <br>
                <br>
                Phone {{$investmentAccount->company_phone}}
            </td>
            <td width="20%">
                    <div class="checkbox {{ ($investmentAccount->used_as_collateral == 1) ? 'checkbox-marked' : ''}}">{{ ($investmentAccount->used_as_collateral == 1) ? 'X' : ''}}</div> Yes 
                    <div class="checkbox {{ ($investmentAccount->used_as_collateral == 0) ? 'checkbox-marked' : ''}}">{{ ($investmentAccount->used_as_collateral == 0) ? 'X' : ''}}</div> No</td>
            <td width="10%">$ {{$investmentAccount->current_value}}</td>
            <td width="10%">$ {{$investmentAccount->loan_balance}}</td>
            <td width="10%">$ {{number_format($equity,2)}}</td>
        </tr>
        @endforeach

        @if($contadorInvestmentAccounts < 2)
            @for($i = $contadorInvestmentAccounts; $i < 2; $i++)
                <tr style="text-align: left">
                    <td width="50%" >
                        <strong>19{{ chr(97 + $i) }}</strong> 
                        <br>

                        <br>
                        <br>
                        Phone
                    </td>
                    <td width="20%"><div class="checkbox"></div> Yes <div class="checkbox"></div> No</td>
                    <td width="10%">$</td>
                    <td width="10%">$</td>
                    <td width="10%">$</td>
                </tr>
            @endfor
        @endif
        <tr style="text-align: left" >
            <td width="80%" colspan="4">
                <strong>19c Total Investments</strong><em>(Add lines 19a, 19b, and amounts from any attachments)</em>
            <td width="20%">$ {{number_format($totalInvestmentAccounts,2)}}</td>
        </tr>
        <tr style="text-align: left" >
            <td width="100%" colspan="5" >
                <strong>AVAILABLE CREDIT</strong> Include all lines of credit and credit cards.
            </td>
        </tr>
        <tr style="text-align: center">
            <td width="50%" colspan="2" >
            Full Name & Address (Street, City, State, ZIP code)
            </td>
            <td width="20%">Credit Limit</td>
            <td width="10%">Amount Owed As of <em>(mmddyyyy)</em></td>
            <td width="10%"><strong>Available Credit</strong>
            As of <em>(mmddyyyy)</em></td>
        </tr>
        @php
            $contadorCreditLine = 0;
            $totalCreditLine    = 0;
        @endphp

        @foreach($creditLines as $creditLine)
            @php
                $contadorCreditLine += 1;
                $available          = ($creditLine->credit_limit - $creditLine->loan_balance);
                $totalCreditLine += $available;
            @endphp
            <tr style="text-align: left">
                <td width="50%" colspan="2" >
                    <strong>20{{ chr(97 + $loop->index) }}</strong> 
                    <br>
                        {{$creditLine->bank_name.' '.$creditLine->bank_address.' '.$creditLine->city_state_zip}}
                    <br>
                    <br>
                    Account No. {{$creditLine->account_number}}
                </td>
                <td width="20%">$ {{number_format($creditLine->credit_limit,2)}}</td>
                <td width="10%">$ {{number_format($creditLine->loan_balance,2)}}</td>
                <td width="10%">$ {{number_format($available,2)}}</td>
            </tr>
        @endforeach

        @if($contadorCreditLine < 2)
            @for($i =  $contadorCreditLine; $i < 2; $i++)
                <tr style="text-align: left">
                    <td width="50%" colspan="2" >
                        <strong>20{{ chr(97 + $i) }}</strong> 
                        <br>

                        <br>
                        <br>
                        Account No.
                    </td>
                    <td width="20%">$</td>
                    <td width="10%">$</td>
                    <td width="10%">$</td>
                </tr>
            @endfor
        @endif
        <tr style="text-align: left">
            <td width="80%" colspan="4" >
                <strong>20c Total Credit Available</strong> 
                <em>(Add lines 20a, 20b, and amounts from any attachments)</em>
            </td>
            <td width="20%">$ {{number_format($totalCreditLine,2)}}</td>
        </tr>
    </table>
    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 16649P</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-B</strong> (Rev. 2-2019)</td>
        </tr>
    </table>
    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 2 -->
    <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <br><br><br><br> <br><br><br><br>
    <!-- Pagina 4 -->
    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-B (Rev. 2-2019)</td>
            <td width="5%">Page <strong style=" font-size: 12px">4</strong></td>
        </tr>
    </table> 
    <table border="1" style="font-size: 11px; text-align: center;border-top: 3px solid #000">
        <tr style="text-align: left">
            <td colspan="7"><strong>REAL PROPERTY</strong> Include all real property and land contracts the business owns/leases/rents</td>
        </tr>
        <tr>
            <td  width="28%"></td>
            <td  width="12%">Purchase/Lease Date <br> <em>( mmddyyyy )</em></td>
            <td  width="12%">Current Fair <br>Market Value <br>(FMV)</td>
            <td  width="12%">Current Loan <br>Balance</td>
            <td  width="12%">Amount of <br>Monthly Payment</td>
            <td  width="12%">Date of Final <br>Payment <br> <em>(mmddyyyy)</em></td>
            <td  width="12%"><strong>Equity</strong><br>FMV Minus Loan</td>
        </tr>
        @php
            $contadorProperty = 0;
            $totalProperty = 0;
        @endphp
        @foreach($propertys as $property)
            @php
                $contadorProperty += 1;
                $equity = $property->current_value - $property->loan_balance;
                $totalProperty += $equity;
            @endphp
            <tr style="text-align: left">
                <td  width="28%">
                    <strong>21{{ chr(97 + $loop->index) }} </strong>Property Description <br>
                    {{$property->description}}
                </td>
                <td  width="12%"><br>{{\Carbon\Carbon::parse($property->purchase_date)->format('mdY')}}</td>
                <td  width="12%"><br>$ {{number_format($property->current_value,2)}}</td>
                <td  width="12%"><br>$ {{number_format($property->loan_balance,2)}}</td>
                <td  width="12%"><br>$ {{$property->monthly_payment}}</td>
                <td  width="12%"><br>{{\Carbon\Carbon::parse($property->final_payment_date)->format('mdY')}}</td>
                <td  width="12%"><br>${{ number_format($equity, 2)}}</td>
            </tr>
            <tr>
                <td  width="28%" colspan="3">
                    Location <em>(street, city, state, ZIP code, county and country)</em> <br>
                    {{$property->street_address.' '.$property->city_state_zip.' '.$property->country}}
                </td>
                <td  width="72%" colspan="4">
                    Lender/Contract Holder Name, Address (street, city, state, ZIP code), and Phone
                    <br>{{$property->lender_address.' '.$property->lender_city_state_zip}}
                    <br>Phone  {{$property->lender_phone}}
                </td>
            </tr>
        @endforeach
        @if($contadorProperty <4)
            @for($i = $contadorProperty; $i<4; $i++)
            <tr style="text-align: left">
                <td  width="28%">
                    <strong>21{{ chr(97 + $i) }} </strong>Property Description <br>
                    xx
                </td>
                <td  width="12%"></td>
                <td  width="12%"><br>$</td>
                <td  width="12%"><br>$</td>
                <td  width="12%"><br>$</td>
                <td  width="12%"></td>
                <td  width="12%"><br>$</td>
            </tr>
            <tr>
                <td  width="28%" colspan="3">
                    Location <em>(street, city, state, ZIP code, county and country)</em> <br>
                    
                </td>
                <td  width="72%" colspan="4">
                    Lender/Contract Holder Name, Address (street, city, state, ZIP code), and Phone
                    <br>
                    <br>Phone
                </td>
            </tr>
            @endfor
        @endif

        <tr style="text-align: left">
            <td  width="80%" colspan="6">
                <br>
                <strong>21e Total Equity</strong> <em> (Add lines 21a through 21d and amounts from any attachments)</em>
            </td>
            <td  width="20%">
                <br>
                ${{number_format($totalProperty,2)}}
            </td>
        </tr>
        <tr style="text-align: left">
            <td  width="80%" colspan="7">
                <strong>VEHICLES, LEASED AND PURCHASED </strong> Include boats, RVs, motorcycles, all-terrain and off-road vehicles, trailers, mobile homes, etc.
            </td>
        </tr>
        <tr>
            <td  width="28%"></td>
            <td  width="12%">Purchase/<br/> Lease Date <br> <em>( mmddyyyy )</em></td>
            <td  width="12%">Current Fair <br>Market Value <br>(FMV)</td>
            <td  width="12%">Current Loan <br>Balance</td>
            <td  width="12%">Amount of <br>Monthly Payment</td>
            <td  width="12%">Date of Final <br>Payment <br> <em>(mmddyyyy)</em></td>
            <td  width="12%"><strong>Equity</strong><br>FMV Minus Loan</td>
        </tr>
        @php
            $contadorVehicles   = 0;
            $totalVehicles      = 0;
        @endphp
        @foreach($vehicles as $vehicle)
            @php
                $contadorVehicles += 1;
                $equity = $vehicle->current_value - $vehicle->current_loan_balance;
                $totalVehicles += $equity;
            @endphp
            <tr style="text-align: left">
                <td  width="28%" style="padding: 0">
                    <table border="1" style="font-size: 11px; text-align: left; width: 100%;margin: 0">
                        <tr>
                            <td>
                                <strong>22{{ chr(97 + $loop->index) }} </strong>Year <br>{{$vehicle->year}}<br>

                            </td>
                            <td>
                                Make/Model <br><br>
                                {{$vehicle->model}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td  width="12%">{{ \Carbon\Carbon::parse($vehicle->purchase_date)->format('mdY') }}</td>
                <td  width="12%"><br>${{number_format($vehicle->current_value,2)}}</td>
                <td  width="12%"><br>${{number_format($vehicle->current_loan_balance,2)}}</td>
                <td  width="12%"><br>${{$vehicle->monthly_payment}}</td>
                <td  width="12%">{{\Carbon\Carbon::parse($vehicle->date_of_final_payment)->format('mdY')}}</td>
                <td  width="12%"><br>${{number_format($equity,2)}}</td>
            </tr>
            <tr style="text-align: left">
                <td  width="28%" style="padding: 0">
                    <table border="1"   cellspacing="0" cellpadding="0"   style="font-size: 11px; text-align: left; width: 100% margin: 0">
                        <tr>
                            <td>
                                Mileage<br><br>
                                {{$vehicle->mileage}}
                            </td>
                            <td>
                                License/Tag Number <br><br>
                                {{$vehicle->license}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Vehicle Identification Number<br><br>
                                {{$vehicle->vin}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td  width="72%" colspan="6" style="margin: 0" >Lender/Lessor Name, Address (street, city, state, ZIP code and country), and Phone
                    <br>{{$vehicle->lender_name.' '.$vehicle->lender_address.' '.$vehicle->lender_city_state_zip}}
                    <br>Phone {{$vehicle->lender_phone}}
                </td>
            </tr>
        @endforeach

        @if($contadorVehicles < 4)
            @for($i = $contadorVehicles; $i<4; $i++)
                <tr style="text-align: left">
                    <td  width="28%" style="padding: 0">
                        <table border="1" style="font-size: 11px; text-align: left; width: 100%;margin: 0">
                            <tr>
                                <td>
                                    <strong>22{{ chr(97 + $i) }} </strong>Year <br><br>

                                </td>
                                <td>
                                    Make/Model <br><br>

                                </td>
                            </tr>
                        </table>
                    </td>
                    <td  width="12%"></td>
                    <td  width="12%"><br>$</td>
                    <td  width="12%"><br>$</td>
                    <td  width="12%"><br>$</td>
                    <td  width="12%"></td>
                    <td  width="12%"><br>$</td>
                </tr>
                <tr style="text-align: left">
                    <td  width="28%" style="padding: 0">
                        <table border="1"   cellspacing="0" cellpadding="0"   style="font-size: 11px; text-align: left; width: 100% margin: 0">
                            <tr>
                                <td>
                                    Mileage<br><br>
                                  
                                </td>
                                <td>
                                    License/Tag Number <br><br>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Vehicle Identification Number<br><br>
                                  
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td  width="72%" colspan="6" style="margin: 0" >Lender/Lessor Name, Address (street, city, state, ZIP code and country), and Phone
                        <br>
                        <br>Phone
                    </td>
                </tr>
            @endfor
        @endif
        <tr style="text-align: left">
            <td  width="80%" colspan="6">
                <br>
                <strong>22e Total Equity</strong> <em> (Add lines 22a through 22d and amounts from any attachments)</em>
            </td>
            <td  width="20%">
                <br>
                $ {{ number_format($totalVehicles,2)}}
            </td>
        </tr>
    </table>
    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 16649P</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-B</strong> (Rev. 2-2019)</td>
        </tr>
    </table>
    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 2 -->
    <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <br><br><br><br> <br><br><br><br>
    <!-- Pagina 5 -->
    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-B (Rev. 2-2019)</td>
            <td width="5%">Page <strong style=" font-size: 12px">5</strong></td>
        </tr>
    </table> 
    <table border="1" style="font-size: 11px;">
        <tr style="text-align: left; border-top: 3px solid #000">
            <td colspan="7"><strong>BUSINESS EQUIPMENT AND INTANGIBLE ASSETS</strong> Include all machinery, equipment, merchandise inventory, and other assets in 23a through 23d. List
                intangible assets in 23e through 23g (licenses, patents, logos, domain names, trademarks, copyrights, software, mining claims, goodwill and trade secrets.)
            </td>
        </tr>
        <tr>
            <td  width="28%"></td>
            <td  width="12%">Purchase/Lease Date <br> <em>( mmddyyyy )</em></td>
            <td  width="12%">Current Fair <br>Market Value <br>(FMV)</td>
            <td  width="12%">Current Loan <br>Balance</td>
            <td  width="12%">Amount of <br>Monthly Payment</td>
            <td  width="12%">Date of Final <br>Payment <br> <em>(mmddyyyy)</em></td>
            <td  width="12%"><strong>Equity</strong><br>FMV Minus Loan</td>
        </tr>
        @php
            $contadorCompany    = 0;
            $totalCompany       = 0;
        @endphp
        @foreach($companyToolEquipments as $companyToolEquipment)
            @php
                $contadorCompany    += 1;
                $equity             = $companyToolEquipment->current_value - $companyToolEquipment->current_loan_balance;
                $totalCompany       += $equity;
            @endphp
            <tr style="text-align: left">
                <td  width="28%">
                    <strong>23{{ chr(97 + $loop->index) }} </strong>Asset Description <br>
                    {{$companyToolEquipment->description}}
                </td>
                <td  width="12%">{{$companyToolEquipment->purchase_date}}</td>
                <td  width="12%"><br>$ {{number_format($companyToolEquipment->current_value,2)}}</td>
                <td  width="12%"><br>$ {{number_format($companyToolEquipment->current_loan_balance,2)}}</td>
                <td  width="12%"><br>$ {{$companyToolEquipment->monthly_payment}}</td>
                <td  width="12%">{{$companyToolEquipment->date_of_final_payment}}</td>
                <td  width="12%"><br>$ {{number_format($equity,2)}}</td>
            </tr>
            <tr>
                <td  width="28%" colspan="3">
                Location of asset <em>(Street, City, State, ZIP code) and County</em> <br>
                    {{$companyToolEquipment->street_addrees.' '.$companyToolEquipment->city_state_zip}}
                </td>
                <td  width="72%" colspan="4">
                    Lender/Lessor Name, Address, (Street, City, State, ZIP code) and Phone
                    <br>
                    {{$companyToolEquipment->lender_addrees.' '.$companyToolEquipment->lender_city_state_zip}}
                    <br>Phone {{$companyToolEquipment->lender_phone}}
                </td>
            </tr>
        @endforeach

        @if($contadorCompany < 4)
            @for($i = $contadorCompany; $i<4; $i++)

            <tr style="text-align: left">
                <td  width="28%">
                    <strong>23{{ chr(97 + $i) }} </strong>Asset Description <br>
                    xx
                </td>
                <td  width="12%"></td>
                <td  width="12%"><br>$</td>
                <td  width="12%"><br>$</td>
                <td  width="12%"><br>$</td>
                <td  width="12%"></td>
                <td  width="12%"><br>$</td>
            </tr>
            <tr>
                <td  width="28%" colspan="3">
                Location of asset <em>(Street, City, State, ZIP code) and County</em> <br>
                    xx
                </td>
                <td  width="72%" colspan="4">
                    Lender/Lessor Name, Address, (Street, City, State, ZIP code) and Phone
                    <br>
                    <br>Phone
                </td>
            </tr>
            @endfor
        @endif
        @php
            $contadorAsset      = $i;
            $init_contadorAsset = 0;
            $totalAsset         = 0;

        @endphp
        @foreach($intangibleAssets as $intangibleAsset)
            @php
                $init_contadorAsset += 1;
                $totalAsset     += $intangibleAsset->current_value;
            @endphp
        <tr>
            <td  width="80%" colspan="6">
                <strong>23{{ chr(97 + $contadorAsset) }} </strong>Intangible Asset Description
                {{$intangibleAsset->description}}
            </td>
            <td  width="20%" > 
                <br>
                $ {{number_format($intangibleAsset->current_value,2)}}
            </td>
        </tr>
            @php
                $contadorAsset++;
            @endphp
        @endforeach


        @if($init_contadorAsset < 3)
            @php
                $nuevoContador = $contadorAsset;
            @endphp
            @for($x = $init_contadorAsset; $x< 3; $x++)

                 <tr>
                    <td  width="80%" colspan="6">
                        <strong>23{{ chr(97 + $nuevoContador) }} </strong>Intangible Asset Description 8
                    </td>
                    <td  width="20%" >
                        <br>
                        $
                    </td>
                </tr>
                @php
                    $nuevoContador += 1;
                @endphp
            @endfor
        @endif

        <!--
        <tr>
            <td  width="80%" colspan="6">
                <strong>23g </strong>Intangible Asset Description
            </td>
            <td  width="20%" >
                <br>
                $
            </td>
        </tr> -->
        <tr>
            <td  width="80%" colspan="6">
                <strong>23h Total Equity</strong> <em> (Add lines 23a through 23g and amounts from any attachments) </em>
            </td>
            <td  width="20%" >
                <br>
                $ {{ number_format(($totalCompany + $totalAsset),2)  }}
            </td>
        </tr>
        <tr>
            <td colspan="7">
                <strong>BUSINESS LIABILITIES</strong>  Include notes and judgements not listed previously on this form.
            </td>
        </tr>
        <tr style="text-align: center">
            <td  width="40%" colspan="2">Business Liabilities</td>
            <td  width="12%">Secured/Unsecured</td>
            <td  width="12%"> Date Pledged <br> <em>(mmddyyyy)</em></td>
            <td  width="12%">Balance Owed</td>
            <td  width="12%">Date of Final Payment<br> <em>(mmddyyyy)</em></td>
            <td  width="12%">Payment Amount</td>
        </tr>
        @php
            $totalBusinessLiability = 0;
            $contadorBusinessLiability = 0;
        @endphp
        @foreach($businessLiabilitys as $businessLiability)
            @php
                $contadorBusinessLiability  += 1;
                $totalBusinessLiability     += $businessLiability->payment_amount;
            @endphp
        <tr style="text-align: left">
            <td  width="40%" colspan="2"><strong>24{{ chr(97 + $loop->index) }}  </strong>Description: <br>{{$businessLiability->description}}<br></td>
            <td  width="12%">
                <div class="checkbox {{ ($businessLiability->collateral == 'secured') ? 'checkbox-marked' : '' }}">{{ ($businessLiability->collateral == 'secured') ? 'X' : '' }}</div> Secured <br>
                <div class="checkbox {{ ($businessLiability->collateral == 'unsecured') ? 'checkbox-marked' : '' }}">{{ ($businessLiability->collateral == 'unsecured') ? 'X' : '' }}</div> Unsecured 
            </td>
            <td  width="12%">{{ \Carbon\Carbon::parse($businessLiability->date_pledged)->format('mdY')}}</td>
            <td  width="12%">${{number_format($businessLiability->balance_owed,2)}}</td>
            <td  width="12%">{{ \Carbon\Carbon::parse($businessLiability->final_payment)->format('mdY')}}</td>
            <td  width="12%">${{number_format($businessLiability->payment_amount,2)}}</td>
        </tr>
        <tr>
            <td colspan="7">
                Name: {{$businessLiability->name}} <br> 
                Street Address : {{$businessLiability->street}}<br>
                City, State, Zip Code : {{$businessLiability->city_state_zip}}<br>
                Phone {{$businessLiability->phone}}
            </td>
        </tr>

        @endforeach
        @if($contadorBusinessLiability < 2)
            @for($i = $contadorBusinessLiability; $i<2; $i++)
                <tr style="text-align: left">
                    <td  width="40%" colspan="2"><strong>24{{ chr(97 + $i) }} </strong>Description: <br><br></td>
                    <td  width="12%">
                        <div class="checkbox"></div> Secured <br><div class="checkbox"></div> Unsecured 
                    </td>
                    <td  width="12%"></td>
                    <td  width="12%">$</td>
                    <td  width="12%"></td>
                    <td  width="12%">$</td>
                </tr>
                <tr>
                    <td colspan="7">
                        Name <br>
                        Street Address <br>
                        City, State, Zip Code <br>
                        Phone
                    </td>
                </tr>
            @endfor
        @endif
        <tr>
            <td colspan="6">
                <br>
                <strong>24c Total Payments</strong> <em>(Add lines 24a and 24b and amounts from any attachments)</em>
            </td>
            <td>
                <br>
                $
            </td>
        </tr>
    </table>
    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 16649P</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-B</strong> (Rev. 2-2019)</td>
        </tr>
    </table>
    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 2 -->
    <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <br><br><br><br> <br><br><br><br>
    <!-- Pagina 6 -->
    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-B (Rev. 2-2019)</td>
            <td width="5%">Page <strong style=" font-size: 12px">6</strong></td>
        </tr>
    </table> 
    <table border="1" style="font-size: 12px;">
        <tr>
            <td colspan="4">
                <div class="section-title">Section 5: Monthly Income/Expenses Statement for Business</div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong>Accounting Method Used:</strong> 
                <div class="checkbox {{ (@$monthlyFinancials[0]->accounting_method == 'cash') ? 'checkbox-marked' : '' }}">{{ (@$monthlyFinancials[0]->accounting_method == 'cash') ? 'X' : '' }}</div> Cash 
                <div class="checkbox {{ (@$monthlyFinancials[0]->accounting_method == 'accrual') ? 'checkbox-marked' : '' }}">{{ (@$monthlyFinancials[0]->accounting_method == 'accrual') ? 'X' : '' }}</div>Accrual <br>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Use the prior 3, 6, 9 or 12 month period to determine your typical business income and expenses.
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Income and Expenses during the period</strong> <em> (mmddyyyy) {{ \Carbon\Carbon::parse(@$monthlyFinancials[0]->period_start)->format('mdY')}}</em>
            </td>
            <td colspan="2"> <em>to (mmddyyyy) {{ \Carbon\Carbon::parse(@$monthlyFinancials[0]->period_end)->format('mdY')}}</em> </td>
        </tr>
        <tr>
            <td colspan="4">
                <em>Provide a breakdown below of your average monthly income and expenses, based on the period of time used above</em>
            </td>
        </tr>
    </table>
    <table border="1" width="100%" style="font-size: 11px;">
        <tr style="text-align: center">
            <td colspan="2" >
                <strong>Total Monthly Business Income </strong> 
            </td>
            <td colspan="2" >
                <strong>Total Monthly Business Expenses </strong> 
            </td>
        </tr>
        <tr style="text-align: center">
            <td >Source</td>
            <td >Gross Monthly</td>
            <td >Expense Items </td>
            <td >Actual Monthly</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>25 </strong> Gross Receipts from Sales/Services</td>
            <td>$ {{ @$monthlyFinancials[0]->gross_receipts}}</td>
            <td><strong>36</strong> Materials Purchased<sup>1</sup></td>
            <td>$ {{ @$monthlyFinancials[0]->materials_purchased}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>26 </strong> Gross Rental Income</td>
            <td>$ {{ @$monthlyFinancials[0]->gross_rental_income}}</td>
            <td><strong>37</strong> Inventory Purchased<sup>2</sup></td>
            <td>$ {{ @$monthlyFinancials[0]->inventory_purchased}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>27 </strong> Interest Income</td>
            <td>$ {{ @$monthlyFinancials[0]->interest}}</td>
            <td><strong>38</strong> Gross Wages & Salaries</td>
            <td>$ {{ @$monthlyFinancials[0]->wages_salaries}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>28 </strong> Dividends</td>
            <td>$ {{ @$monthlyFinancials[0]->dividends}}</td>
            <td><strong>39</strong> Rent</td>
            <td>$ {{ @$monthlyFinancials[0]->rent}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>29 </strong> Cash Receipts not included in lines 25-28</td>
            <td>$ {{ @$monthlyFinancials[0]->cash_receipts}}</td>
            <td><strong>40</strong> Supplies<sup>3</sup></td>
            <td>$ {{ @$monthlyFinancials[0]->supplies}}</td>
        </tr>
        <tr style="text-align: left">
            <td>Other Income (Specify below)</td>
            <td>$</td>
            <td><strong>41</strong>  Utilities/Telephone<sup>4</sup></td>
            <td>$ {{ @$monthlyFinancials[0]->utilities}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>30</strong> </td>
            <td>$</td>
            <td><strong>42</strong> Vehicle Gasoline/Oil</td>
            <td>$ {{ @$monthlyFinancials[0]->vehicle_gas_oil}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>31 </strong> </td>
            <td>$</td>
            <td><strong>43</strong> Repairs & Maintenance</td>
            <td>$ {{ @$monthlyFinancials[0]->repairs_maintenance}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>32 </strong> </td>
            <td>$</td>
            <td><strong>44</strong> Insurance</td>
            <td>$ {{ @$monthlyFinancials[0]->insurance}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>33 </strong> </td>
            <td>$</td>
            <td><strong>45</strong> Current Taxes<sup>5</sup></td>
            <td>$ {{ @$monthlyFinancials[0]->current_taxes}}</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>34 </strong> </td>
            <td>$</td>
            <td><strong>46</strong> Other Expenses (Specify)</td>
            <td>$</td>
        </tr>

        @php
            $total_income = @$monthlyFinancials[0]->gross_receipts + @$monthlyFinancials[0]->gross_rental_income + @$monthlyFinancials[0]->interest + @$monthlyFinancials[0]->dividends + @$monthlyFinancials[0]->cash_receipts;

            $total_expense = @$monthlyFinancials[0]->materials_purchased + @$monthlyFinancials[0]->inventory_purchased + @$monthlyFinancials[0]->wages_salaries + @$monthlyFinancials[0]->rent + @$monthlyFinancials[0]->supplies + @$monthlyFinancials[0]->utilities + @$monthlyFinancials[0]->vehicle_gas_oil + @$monthlyFinancials[0]->repairs_maintenance + @$monthlyFinancials[0]->insurance + @$monthlyFinancials[0]->current_taxes;
        @endphp

        <tr style="text-align: left">
            <td><strong>35 </strong> Total Income (Add lines 25 through 34)</td>
            <td>${{ number_format($total_income,2)}}</td>
            <td><strong>47</strong> IRS Use Only-Allowable Installment Payments</td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td colspan="2"></td>
            <td><strong>48</strong> Total Expenses (Add lines 36 through 47)</td>
            <td>$ {{ number_format($total_expense,2)}}</td>
        </tr>
        <tr style="text-align: left">
            <td colspan="2"></td>
            <td><strong>49</strong> Net Income (Line 35 minus 48)</td>
            <td>$ {{ number_format(( $total_income -  $total_expense),2)}}</td>
        </tr>
    </table>
    <table border="1" width="100%" style="font-size: 11px;">
        <tr style="text-align: left">
            <td width="50%">
                <strong>1 Materials Purchased:</strong> : Materials are items directly related to the
                production of a product or service. 
                <br>
                <strong>2 Inventory Purchased:</strong> : Goods bought for resale.
                <br>
                <strong>3 Supplies:</strong> : Supplies are items used to conduct business and are
                    consumed or used up within one year. This could be the cost of
                    books, office supplies, professional equipment, etc
                <br>
            </td>
            <td width="50%">
                <strong>4 Utilities/Telephone:</strong> : Utilities include gas, electricity, water, oil, other
                fuels, trash collection, telephone, cell phone and business internet. <br>
                <strong>5 Current Taxes:</strong> : Real estate, excise, franchise, occupational, personal property, sales and employer’s portion of employment taxes. 
            </td>
        </tr>
        <tr style="text-align: left; ">
            <td colspan="4">
                <strong>Certification</strong><em>Under penalties of perjury, I declare that to the best of my knowledge and belief this statement of assets, liabilities, and other
                information is true, correct, and complete. </em>
            </td>
        </tr>

        <tr style="text-align: left; ">
            <td colspan="4">
                <strong>Print Name of Officer, Partner or LLC Member</strong>
                <br><br><br><br>
            </td>
        </tr>
        <tr style="text-align: left; ">
            <td colspan="2" width="40%">
                <strong>Signature</strong>
                <br><br><br><br>
            </td>
            <td width="40%">
                <strong>Title</strong>
                <br><br><br><br>
            </td>
            <td width="20%">
                <strong>Date</strong>
                <br><br><br><br>
            </td>
        </tr>
        <tr style="text-align: left; ">
            <td colspan="4">
                <strong>After we review the completed Form 433-B, you may be asked to provide verification for the assets, encumbrances, income and expenses
                    reported. Documentation may include previously filed income tax returns, profit and loss statements, bank and investment statements, loan
                    statements, financing statements, bills or statements for recurring expenses, etc.</strong>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-size: 11px;">
        <tr style="text-align: left; ">
            <td colspan="2">
                <strong>IRS USE ONLY </strong><em>(Notes)</em>
                <br><br><br><br> <br><br><br><br> 
            </td>
        </tr>
    </table>
    <table width="98%" cellspacing="0"
        style="position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr style="border-top: 1px solid #000;">
            <td colspan="3">
                <strong>Privacy Act:</strong> The information requested on this Form is covered under Privacy Acts and Paperwork Reduction Notices which have already been
                provided to the taxpayer.
            </td>
        </tr>
        <tr style="border-top: 3px solid #000;">
            <td >Catalog Number 16649P</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-B</strong> (Rev. 2-2019)</td>
        </tr>
    </table>
</body> 
</html>