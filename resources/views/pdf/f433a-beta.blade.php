<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>433a</title>
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
                Form <span style="font-size: 20px;font-weight: bold;">433-A</span>
                <br>
                (July 2022)
                <br>
                Department of the Treasury <br>
                Internal Revenue Service
            </td>
            <td width="82%" style="text-align: center;border-right: 1px solid #000;">
                <div style="font-size: 20px;font-weight: bold;">
                    Collection Information Statement for Wage <br>
                    Earners and Self-Employed Individuals
                </div>
            </td>
        </tr>
    </table>
    <table style="font-size: 10px;">
        <tr>
            <td colspan="2">
                <div >
                <strong>Wage Earners</strong> Complete Sections 1, 2, 3, 4, and 5 including the signature line on page 4. <em>Answer all questions or write N/A if the question is not applicable.</em> <br>
                <strong>Self-Employed Individuals</strong>  Complete Sections 1, 3, 4, 5, 6 and 7 and the signature line on page 4. <em>Answer all questions or write N/A if the question is not applicable.</em><br>
                <strong>For Additional Information</strong>, refer to Publication 1854, "How To Prepare a Collection Information Statement."<br>
                <em><strong>Include attachments if additional space is needed to respond completely to any question.</strong></em>
                </div>
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px;">
        <tr>
            <td colspan="2">
                <div class="section-title">Section 1: Personal Information</div>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-right: 1px solid black;">
                <div class="input-box-title" ><strong>1a</strong> Full Name of Taxpayer and Spouse (if applicable)</div>
                <span class="parrafo">{{ strtoupper(trim($client->first_name . ' ' . $client->last_name)) }}</span>
            </td>
            <td width="50%" >
                <div class="input-box-title">
                <strong>2c</strong> Provide information on all other persons in household or claimed as dependents
                </div>
                texto
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-right: 1px solid black;">
                <div class="input-box-title" ><strong>1b</strong>  Address (street, city, state, ZIP code and country)</div>
                <span class="parrafo">{{ strtoupper(trim($client->address_1 . ', ' . $client->city.', ' . $client->zipcode.' United states Of America'))}}</span>
            </td>
            <td width="50%" style="margin: 0 auto; padding: 0">
                <table border="1" style="text-align: center; margin: 0 auto; padding: 0">
                    <tr>
                        <td>Name</td>
                        <td>Age</td>
                        <td>Relationship</td>
                    </tr>
                    @foreach ($dependents as $dependent)
                    <tr>
                        <td><span class="parrafo">{{ strtoupper($dependent->name)}}</span></td>
                        <td><span class="parrafo">{{$dependent->age}}</span></td>
                        <td><span class="parrafo">{{strtoupper($dependent->relationship)}}</span></td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td width="50%" style="border-right: 1px solid black;margin: 0 auto; padding: 0">
                <table border="1" style=" margin: 0 auto">
                    <tr>
                        <td>
                            <div class="input-box-title" ><strong>1c</strong> County of Residence</div>
                            <span class="parrafo">{{strtoupper(trim($client->state_name))}}</span>
                        </td>
                        <td>
                            <div class="input-box-title" ><strong>1d</strong> Home Phone</div>
                            <span class="parrafo">{{strtoupper(trim($client->phone_home))}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-box-title" ><strong>1e</strong> Cell Phone</div>
                            <span class="parrafo">{{strtoupper(trim($client->cell_home))}}</span>
                        </td>
                        <td>
                            <div class="input-box-title" ><strong>1f</strong> Work Phone</div>
                            <span class="parrafo">{{strtoupper(trim($client->phone_work))}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>2a</strong> Marital Status: <div class="checkbox {{($client->marital_status == 1) ? 'checkbox-marked' : '' }}">
                                <span class="parrafo">{{($client->marital_status == 1) ? 'x' : '' }}</span>
                            </div> Married <div class="checkbox {{($client->marital_status == 2) ? 'checkbox-marked' : '' }}">
                                <span class="parrafo">{{($client->marital_status == 2) ? 'x' : '' }}</span>
                            </div> Unmarried <em>(Single, Divorced, Widowed)</em>
                        </td>
                    </tr>
                </table>
                <table border="1" style="text-align: center; margin: 0 auto; padding: 0">
                    <tr>
                        <td><strong>2b</strong></td>
                        <td>SSN or ITIN</td>
                        <td>Date of Birth (mmddyyyy)</td>
                    </tr>
                    <tr>
                        <td>Taxpayer</td>
                        <td><span class="parrafo">{{ trim($client->ssn) }}</span></td>
                        <td><span class="parrafo">{{ \Carbon\Carbon::parse($client->date_birdth)->format('d/m/Y') }}</span></td>
                    </tr>
                    <tr>
                        <td>Spouse</td>
                        <td><span class="parrafo">{{ trim($client->spouse_ssn) }}</span></td>
                        <td><span class="parrafo">{{ \Carbon\Carbon::parse($client->spouse_date_birdth)->format('d/m/Y') }}</span></td>
                    </tr>
                </table>
            </td>
            <td width="50%"  style="margin: 0 auto; padding: 0">
                <div class="input-box-title"><strong>3a</strong>   Do you or your spouse have any outside business interests? Include
                any interest in an LLC, LLP, corporation, partnership, etc.</div>
                <div class="checkbox {{($client->business_interest =='yes') ? 'checkbox-marked' : '' }}">{{($client->business_interest =='yes') ? 'X' : '' }}</div> Yes (percentage of ownership %) 
                <div class="checkbox {{($client->business_interest =='no') ? 'checkbox-marked' : '' }}">{{($client->business_interest =='no') ? 'X' : '' }}</div> No <br>
                Title: {{ trim(@$businessInterests[0]->title) }}
                <table border="1" style=" margin: 0 auto">
                    <tr>
                        <td colspan="2">
                            <strong>3b</strong>  Business name <br>
                            <span class="parrafo">{{ strtoupper(trim(@$businessInterests[0]->business_name)) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>3c</strong>  Type of business (select one) <br>
                            @if(isset($businessInterests[0]->type))
                                @switch($businessInterests[0]->type)
                                    @case(1)

                                        @break
                                @endswitch
                            @endif


                            <div class="checkbox {{(@$businessInterests[0]->type ==  2) ? 'checkbox-marked' : ''}}">{{(@$businessInterests[0]->type ==  2) ? 'X' : ''}}</div> Partnership 
                            <div class="checkbox {{(@$businessInterests[0]->type ==  5) ? 'checkbox-marked' : ''}}">{{(@$businessInterests[0]->type ==  5) ? 'X' : ''}}</div> LLC  
                            <div class="checkbox {{(@$businessInterests[0]->type ==  3) ? 'checkbox-marked' : ''}}">{{(@$businessInterests[0]->type ==  3) ? 'X' : ''}}</div> Corporation 
                            <div class="checkbox {{(@$businessInterests[0]->type ==  1) ? 'checkbox-marked' : ''}}">{{(@$businessInterests[0]->type ==  1) ? 'X' : ''}}</div> Sole Proprietorship 
                            <div class="checkbox {{(@$businessInterests[0]->type ==  4 || @$businessInterests[0]->type ==  6 || @$businessInterests[0]->type ==  7) ? 'checkbox-marked' : ''}}">{{(@$businessInterests[0]->type ==  4 || @$businessInterests[0]->type ==  6 || @$businessInterests[0]->type ==  7 ) ? 'X' : ''}}</div> 
                            <br>Other 

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px;">
        <tr>
            <td colspan="4">
                <div class="section-title">Section 2: Employment Information for Wage Earners</div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <em>If you or your spouse have self-employment income instead of, or in addition to wage income, complete Business Information in Sections 6 and 7.</em>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">
                <strong>Taxpayer</strong> 
            </td>
            <td colspan="2" style="text-align: center">
                <strong>Spouse</strong>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="input-box-title"><strong>4a</strong> Taxpayer's Employer Name</div> <span class="parrafo">{{ strtoupper(trim($employments->first()->employer)) ?? '' }}</span>
            </td>
            <td colspan="2">
                <div class="input-box-title"><strong>5a</strong> Spouse's Employer Name</div> <span class="parrafo">{{ strtoupper(trim($employmentSpouses->first()->employer)) ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="input-box-title"><strong>4b</strong> Address (street, city, state, ZIP code and country)</div>
                <span class="parrafo">{{ $employments->first() ? strtoupper(trim($employments->first()->street.', '.$employments->first()->city.', '.$employments->first()->state.', '.$employments->first()->zip_code)) : '' }}</span>
            </td>
            <td colspan="2">
                <div class="input-box-title"><strong>5b</strong> Address (street, city, state, ZIP code and country)</div>
                <span class="parrafo">{{ $employmentSpouses->first() ? strtoupper(trim($employmentSpouses->first()->street.', '.$employmentSpouses->first()->city.', '.$employmentSpouses->first()->state.', '.$employmentSpouses->first()->zip_code)) : '' }}</span>
            </td>
        </tr>
        <tr>
            <td >
                <div class="input-box-title"><strong>4c</strong> Work Phone</div>
                <span class="parrafo">{{ $employments->first() ? strtoupper(trim($employments->first()->work_phone)) : '' }}</span>
            </td>
            <td >
                <div class="input-box-title"><strong>4d</strong> Does employer allow contact at work</div>
                @php
                    $contactAllowed = $employments[0]->contact_at_work_allowed ?? null;
                @endphp

                <div class="checkbox {{ $contactAllowed === 1 ? 'checkbox-marked' : '' }}">{{ $contactAllowed === 1 ? 'X' : '' }}</div> Yes  
                <div class="checkbox {{ $contactAllowed === 0 ? 'checkbox-marked' : '' }}">{{ $contactAllowed === 0 ? 'X' : '' }}</div> No  

            </td>
            <td >
                <div class="input-box-title"><strong>5c</strong> Work Phone</div>
                <span class="parrafo">{{ $employmentSpouses->first() ? strtoupper(trim($employmentSpouses->first()->work_phone)) : '' }}</span>
            </td>
            <td >
                <div class="input-box-title"><strong>5d</strong> Does employer allow contact at work</div>
                @php
                    $contactAllowed2 = $employmentSpouses[0]->contact_at_work_allowed ?? null;
                @endphp

                <div class="checkbox {{ $contactAllowed2 === 1 ? 'checkbox-marked' : '' }}">{{ $contactAllowed2 === 1 ? 'X' : '' }}</div> Yes  
                <div class="checkbox {{ $contactAllowed2 === 0 ? 'checkbox-marked' : '' }}">{{ $contactAllowed === 0 ? 'X' : '' }}</div> No  

            </td>
        </tr>
        <tr>
            <td >
                <div class="input-box-title"><strong>4e</strong> How long with this employer</div>
                <span class="parrafo">{{ isset($employments[0]) ? strtoupper(trim($employments[0]->employer_year)) : '' }}</span>
                <em>(Years)</em> | 
                <span class="parrafo">{{ isset($employments[0]) ? strtoupper(trim($employments[0]->employer_month)) : '' }}</span>
                 <em>(Months)</em>
            </td>
            <td >
                <div class="input-box-title"><strong>4f</strong> Occupation</div>
                <span class="parrafo">{{ isset($employments[0]) ? strtoupper(trim($employments[0]->occupation)) : '' }}</span>
            </td>
            <td >
                <div class="input-box-title"><strong>5e</strong> How long with this employer</div>
                <span class="parrafo">{{ isset($employmentSpouses[0]) ? strtoupper(trim($employmentSpouses[0]->employer_year)) : '' }}</span>
                <em>(Years)</em> | 
                <span class="parrafo">{{ isset($employmentSpouses[0]) ? strtoupper(trim($employmentSpouses[0]->employer_month)) : '' }}</span>
                 <em>(Months)</em>
            </td>
            <td >
                <div class="input-box-title"><strong>5f</strong> Occupation</div>
                <span class="parrafo">{{ isset($employmentSpouses[0]) ? strtoupper(trim($employmentSpouses[0]->occupation)) : '' }}</span>
            </td>
        </tr>
        <tr>
            <td >
                <div class="input-box-title"><strong>4g</strong> Number claimed as a dependent
                on your Form 1040</div>
                xxxx
            </td>
            <td >
                <div class="input-box-title"><strong>4h</strong> Pay Period</div>
                @php
                    $payPeriods = [
                        1 => 'Weekly',
                        2 => 'Bi-weekly',
                        3 => 'Other',
                        4 => 'Monthly',
                    ];
                @endphp

                @foreach($payPeriods as $key => $label)
                    <div class="checkbox {{ isset($employments[0]) && $employments[0]->pay_period == $key ? 'checkbox-marked' : '' }}">
                        {{ isset($employments[0]) && $employments[0]->pay_period == $key ? 'X' : '' }}
                    </div> {{ $label }}
                @endforeach

            </td>
            <td >
                <div class="input-box-title"><strong>5g</strong> Humber claimed as a dependent
                on your Form 1040</div>
                xxxx
            </td>
            <td >
                <div class="input-box-title"><strong>5h</strong> Pay Period</div>
                @php
                    $payPeriods = [
                        1 => 'Weekly',
                        2 => 'Bi-weekly',
                        3 => 'Other',
                        4 => 'Monthly',
                    ];
                @endphp

                @foreach($payPeriods as $key => $label)
                    <div class="checkbox {{ isset($employmentSpouses[0]) && $employmentSpouses[0]->pay_period == $key ? 'checkbox-marked' : '' }}">
                        {{ isset($employmentSpouses[0]) && $employmentSpouses[0]->pay_period == $key ? 'X' : '' }}
                    </div> {{ $label }}
                @endforeach

            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px;">
        <tr>
            <td colspan="4">
                <div class="section-title">Section 3: Other Financial Information <em>(Attach copies of applicable documentation)</em></div>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center">
                <strong>6 Are you a party to a lawsuit</strong> <em>(If yes, answer the following)</em> 
                <div class="checkbox {{($client->lawsuit_party == 'yes') ? 'X' : ''}}">{{($client->lawsuit_party == 'yes') ? 'X' : ''}}</div> Yes 
                <div class="checkbox {{($client->lawsuit_party == 'no') ? 'X' : ''}}">{{($client->lawsuit_party == 'no') ? 'X' : ''}}</div> No
            </td>
        </tr>
        <tr>
            <td  style="text-align: center">
                <div class="checkbox {{(isset($lawsuits[0]) && $lawsuits[0]->role == 'plaintiff') ? 'checkbox-marked' : ''}}">{{(isset($lawsuits[0]) && $lawsuits[0]->role == 'plaintiff') ? 'X' : ''}}</div> Plaintiff 
                <div class="checkbox {{(isset($lawsuits[0]) && $lawsuits[0]->role == 'defendant') ? 'checkbox-marked' : ''}}">{{(isset($lawsuits[0]) && $lawsuits[0]->role == 'defendant') ? 'X' : ''}}</div> defendant
            </td>
            <td>
                <div class="input-box-title">Location of Filing</div>
                <span class="parrafo">{{ isset($lawsuits[0]) ? strtoupper(trim($lawsuits[0]->location_of_filing)) : '' }}</span>
            </td>
            <td>
                <div class="input-box-title">Represented by</div>
                <span class="parrafo">{{ isset($lawsuits[0]) ? strtoupper(trim($lawsuits[0]->represented_by)) : '' }}</span>
            </td>
            <td>
                <div class="input-box-title">Dockent/case No.</div>
                <span class="parrafo">{{ isset($lawsuits[0]) ? strtoupper(trim($lawsuits[0]->docket_case_number)) : '' }}</span>
            </td>
        </tr>
        <tr>
            <td  style="text-align: center">
                <div class="input-box-title">Amount of Suit</div>
                $  <span class="parrafo">{{ isset($lawsuits[0]) ? strtoupper(trim($lawsuits[0]->amount_of_suit)) : '' }}</span>
            </td>
            <td>
                <div class="input-box-title">Possible Completion Date <em>(mmddyyyy)</em></div>
                <span class="parrafo">{{ isset($lawsuits[0]) ? strtoupper(trim($lawsuits[0]->possible_completion_date)) : '' }}</span>
            </td>
            <td colspan ="2">
                <div class="input-box-title">Subject of Suit</div>
                <span class="parrafo">{{ isset($lawsuits[0]) ? strtoupper(trim($lawsuits[0]->subject_of_suit)) : '' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center">
                <strong>7 Have you ever filed bankruptcy</strong> <em>(If yes, answer the following)</em> 
                <div class="checkbox {{($client->filed_bankruptcy == 'yes') ? 'X' : ''}}">{{($client->filed_bankruptcy == 'yes') ? 'X' : ''}}</div> Yes 
                <div class="checkbox {{($client->filed_bankruptcy == 'no') ? 'X' : ''}}">{{($client->filed_bankruptcy == 'no') ? 'X' : ''}}</div> No
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px;">
        <tr>
            <td>
                <div class="input-box-title">Date Filed <em>(mmddyyyy)</em></div>
                <span class="parrafo">{{ isset($bankruptcys[0]) ? strtoupper(trim($bankruptcys[0]->date_field)) : '' }}</span>
            </td>
            <td>
                <div class="input-box-title">Date Dismissed <em>(mmddyyyy)</em></div>
                <span class="parrafo">text</span>
            </td>
            <td>
                <div class="input-box-title">Date Discharged <em>(mmddyyyy)</em></div>
                <span class="parrafo">text</span>
            </td>
            <td>
                <div class="input-box-title">Peticion No.</div>
                <span class="parrafo">{{ isset($bankruptcys[0]) ? strtoupper(trim($bankruptcys[0]->petition_no)) : '' }}</span>
            </td>
            <td>
                <div class="input-box-title">Location Filed</div>
                <span class="parrafo">{{ isset($bankruptcys[0]) ? strtoupper(trim($bankruptcys[0]->location)) : '' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: center">
                <strong>8 In the past 10 years, have you lived outside of the U.S for 6 months or longer</strong> <em>(If yes, answer the following)</em> 
                <div class="checkbox {{($client->lived_outside_us == 'yes') ? 'X' : ''}}">{{($client->lived_outside_us == 'yes') ? 'X' : ''}}</div> Yes 
                <div class="checkbox {{($client->lived_outside_us == 'no') ? 'X' : ''}}">{{($client->lived_outside_us == 'no') ? 'X' : ''}}</div> No
            </td>
        </tr>
        <tr>
            <td colspan="3">
            Dates lived abroad: from <em>(mmddyyyy)</em> <span class="parrafo">{{ isset($livedAbroads[0]) ? strtoupper(trim($livedAbroads[0]->lived_abroad_from)) : '' }}</span>
            </td>
            <td colspan="2">
            to <em>(mmddyyyy)</em>  <span class="parrafo">{{ isset($livedAbroads[0]) ? strtoupper(trim($livedAbroads[0]->lived_abroad_to)) : '' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="4" >
                <strong>9a Are you the beneficiary of a trust, estate, or life insurance policy including those located in foreign countries or
                jurisdictions</strong> <em>(If yes, answer the following)</em>
            </td>
            <td width="10%">
                <div class="checkbox {{($client->trust_beneficiary == 'yes') ? 'X' : ''}}">{{($client->trust_beneficiary == 'yes') ? 'X' : ''}}</div> Yes 
                <div class="checkbox {{($client->trust_beneficiary == 'no') ? 'X' : ''}}">{{($client->trust_beneficiary == 'no') ? 'X' : ''}}</div> No
            </td>
        </tr>
        <tr>
            <td colspan="3" >
                Name of the trust: <span class="parrafo">{{ isset($trustees[0]) ? strtoupper(trim($trustees[0]->trust_name)) : '' }}</span>
            </td>
            <td width="10%">
                EIN: <span class="parrafo">{{ isset($trustees[0]) ? strtoupper(trim($trustees[0]->ein)) : '' }}</span>
            </td>
            <td width="10%">
                
            </td>
        </tr>
        <tr>
            <td colspan="4" >
                <strong>10 Do you have a safe deposit box (business or personal) including 
                    those located in foreign countries or jurisdictions</strong> <em>(If yes, answer the following)</em>
            </td>
            <td width="10%">
                <div class="checkbox {{($client->safe_deposit_box == 'yes') ? 'X' : ''}}">{{($client->safe_deposit_box == 'yes') ? 'X' : ''}}</div> Yes 
                <div class="checkbox {{($client->safe_deposit_box == 'no') ? 'X' : ''}}">{{($client->safe_deposit_box == 'no') ? 'X' : ''}}</div> No
            </td>
        </tr>
        <tr>
            <td colspan="3" >
                <div class="input-box-title">Location (Name, address and box number(s))</div>
                <span class="parrafo">{{ isset($safeDepositBoxs[0]) ? strtoupper(trim($safeDepositBoxs[0]->location_name).' '.trim($safeDepositBoxs[0]->location_address).' '.trim($safeDepositBoxs[0]->city_state_zip).' ('.trim($safeDepositBoxs[0]->box_numbers).')') : '' }}</span>
            </td>
            <td>
                <div class="input-box-title">Content</div>
                <span class="parrafo">{{ isset($safeDepositBoxs[0]) ? strtoupper(trim($safeDepositBoxs[0]->contents)) : '' }}</span>
            </td>
            <td >
            <div class="input-box-title">Value</div>
                $ <span class="parrafo">{{ isset($safeDepositBoxs[0]) ? strtoupper(trim($safeDepositBoxs[0]->value)) : '' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="4" >
                <strong>11 In the past 10 years, have you transferred any assets with a fair market value of more than $10,000 including real
                property, for less than their full value</strong> <em>(If yes, answer the following)</em>
            </td>
            <td width="10%">
                <div class="checkbox {{($client->assets_transferred_10_years == 'yes') ? 'X' : ''}}">{{($client->assets_transferred_10_years == 'yes') ? 'X' : ''}}</div> Yes 
                <div class="checkbox {{($client->assets_transferred_10_years == 'no') ? 'X' : ''}}">{{($client->assets_transferred_10_years == 'no') ? 'X' : ''}}</div> No
            </td>
        </tr>
        <tr>
            <td colspan="2" width="30%">
                <div class="input-box-title">List Asset(s)</div>
                <span class="parrafo">text</span>
            </td>
            <td width="20%">
                <div class="input-box-title">Value at Time of Transfer</div>
                $<span class="parrafo"></span>
            </td>
            <td width="20%">
                <div class="input-box-title">Date Transferred (mmddyyyy)</div>
                <span class="parrafo">xxxx</span>
            </td>
            <td width="30%">
            <div class="input-box-title">To Whom or Where was it Transferred</div>
                 <span class="parrafo">xxxx</span>
            </td>
        </tr>
    </table>

    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 20312N</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-A</strong> (Rev. 7-2022)</td>
        </tr>
    </table>

    <br>
    <br>
    <br>
    <!-- Pagina 2 -->
    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-A (Rev. 7-2022)</td>
            <td width="5%">Page <strong style=" font-size: 12px">2</strong></td>
        </tr>
    </table>
    <table style="font-size: 11px;">
        <tr>
            <td colspan="4">
                <div class="section-title">Section 4: Personal Asset Information for all Individuals (Foreign and Domestic). Include assets located in
                foreign countries or jurisdictions and add attachment(s) if additional space is needed to respond</div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>12 CASH ON HAND </strong> Include cash that is not in a bank
                text
            </td>
            <td style="text-align: right">
                <strong>Total Cash on Hand</strong>
            </td>
            <td width="10%">
                $
            </td>
        </tr>
        <tr>
            <td colspan="4" style="border-top: 1px solid #000">
                <strong>PERSONAL BANK ACCOUNTS</strong>  Include all checking, online and mobile <em>(e.g., PayPal etc.)</em> accounts, money market accounts, savings accounts,
                and stored value cards <em>(e.g., payroll cards, government benefit cards, etc.)</em>.
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px; text-align: center">
        <tr>
            <td width="20%">
                Type of Account
            </td>
            <td width="40%">
                Full Name & Address <em>(Street, City, State, ZIP code and
                Country)</em> of Bank, Savings & Loan, Credit Union, or
                Financial Institution
            </td>
            <td width="20%">
                Account Number
            </td>
            <td width="20%">
                <strong>Account Balance</strong> <br>
                As of xxxxxxxx
            </td>
        </tr>
        @php 
            $totalAmountBank = 0;
        @endphp
        @foreach($bankAccounts as $bankAccount)
            @php
                $totalAmountBank += $bankAccount->current_value;
            @endphp
        <tr>
            <td width="20%" style="text-align: left">
                <strong>13{{ chr(97 + $loop->index) }}  <span class="parrafo">{{ strtoupper(trim($bankAccount->bank_type_name)) }}</span></strong>
            </td>
            <td width="40%" style="text-align: left"><span class="parrafo">{{ strtoupper(trim($bankAccount->bank_name)) .', '.strtoupper(trim($bankAccount->address)).', '.strtoupper(trim($bankAccount->city_state_zip))  }}</span>
            </td>
            <td width="20%"><span class="parrafo">{{ strtoupper(trim($bankAccount->account_number)) }}</span>
            </td>
            <td width="20%" style="text-align: left">
                $ <span class="parrafo">{{ strtoupper(trim($bankAccount->current_value)) }}</span>
            </td>
        </tr>

        @endforeach
        <!-- <tr>
            <td width="20%" style="text-align: left">
                <strong>13b</strong>
            </td>
            <td width="40%">
            </td>
            <td width="20%">
            </td>
            <td width="20%" style="text-align: left">
                $ 
            </td>
        </tr> -->


        <tr style="text-align: left">
            <td colspan="3" width="80%">
                <strong>13c  Total Cash</strong> <em>(Add lines 13a, 13b, and amounts from any attachments)</em> 
            </td>
            <td width="20%">
                $ {{ number_format($totalAmountBank, 2) }}
            </td>
        </tr>
        <tr>
            <td colspan="4" style="border-top: 1px solid #000">
                <strong>INVESTMENTS</strong> Include stocks, bonds, mutual funds, stock options, certificates of deposit, and retirement assets such as IRAs, Keogh, 401(k) plans
                    and commodities (e.g., gold, silver, copper, etc.). Include all corporations, partnerships, limited liability companies, or other business entities in which
                    you are an officer, director, owner, member, or otherwise have a financial interest.
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px; text-align: center">
        <tr>
            <td width="20%">
                Type of Investment
                or Financial Interest
            </td>
            <td width="20%">
                Full Name & Address <br> <em>(Street, City, State, ZIP code and
                Country)</em>  of Company
            </td>
            <td width="20%">
                Current Value
            </td>
            <td width="20%">
               Loan Balance <em>(if applicable)</em> <br>
                As of xxxxxxxx
            </td>
            <td width="20%">
                <strong>Equity</strong> <br>
                Value minus Loan
            </td>
        </tr>

        @foreach($investmentAccounts as $investmentAccount)
        <tr style="text-align: left">
            <td width="20%">
               <strong>14{{ chr(97 + $loop->index) }}  <span class="parrafo">{{ strtoupper(trim($investmentAccount->bank_type_name)) }}</span></strong>
            </td>
            <td width="20%"><span class="parrafo">{{ strtoupper(trim($investmentAccount->company_name)).', '.strtoupper(trim($investmentAccount->address)).', '.strtoupper(trim($investmentAccount->city_state_zip)) }}</span>
                phone <span class="parrafo">{{ strtoupper(trim($investmentAccount->company_phone)) }}</span>
            </td>
            <td width="20%">
            $ <span class="parrafo">{{ strtoupper(trim($investmentAccount->current_value)) }}</span>
            </td>
            <td width="20%">
            $<span class="parrafo"></span>
            </td>
            <td width="20%">
            $<span class="parrafo"></span>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5" style="border-top: 1px solid #000 text-align: left">
                <strong>DIGITAL ASSETS</strong>  List all digital assets such as virtual currency (cryptocurrency), non-fungible token (NFT), and smart contracts you own or in which
                you have a financial interest (e.g., Bitcoin, Ethereum, Litecoin, Ripple, etc.) If applicable, attach a statement with each virtual currency’s public key.
            </td>
        </tr>
        <tr>
            <td colspan="5" style="border-top: 1px solid #000 text-align: left">
                <strong> 14c </strong> List the name(s) of individuals who have access to the private key(s) and/or digital wallets <br>
                xxx
            </td>
        </tr>
        <tr >
            <td width="20%">
                Type of Digital Asset
            </td>
            <td width="20%">
                Name of Digital Asset such as
                Virtual Currency Wallet, Exchange
                or Digital Currency Exchange
                (DCE)
            </td>
            <td width="20%">
                Email Address Used to Set-up
                With the Digital Assets such as
                Virtual Currency Exchange or
                DCE
            </td>
            <td width="20%">
                Location(s) of Digital Assets
                <em>(Mobile Wallet, Online, and/or
                External Hardware storage)</em>
            </td>
            <td width="20%">
                Digital Asset Amount
                and Value in US
                dollars as of today
                <em>(e.g., 1 Bitcoins
                $38,000.00 USD)</em>
            </td>
        </tr>
            @php 
                $totalDigitalAsset = 0;
            @endphp
            @foreach($digitalAssets as $digitalAsset)
        <tr style="text-align: left">
            @php
                $totalDigitalAsset += $digitalAsset->current_value;
            @endphp


            <td width="20%">
               <strong>14{{ chr(100 + $loop->index) }}</strong>
            </td>
            <td width="20%">
               <span class="parrafo">{{$digitalAsset->asset_name}}</span>
            </td>
            <td width="20%">
                <span class="parrafo">{{$digitalAsset->email}}</span>
            </td>
            <td width="20%">
                <span class="parrafo">{{$digitalAsset->location}}</span>
            </td>
            <td width="20%">
            $   <span class="parrafo">{{$digitalAsset->current_value}}</span>
            </td>
        </tr>
        @endforeach
        <!-- <tr style="text-align: left">
            <td width="20%">
               <strong>14e</strong>
            </td>
            <td width="20%">
               
            </td>
            <td width="20%">
            
            </td>
            <td width="20%">
            
            </td>
            <td width="20%">
            $
            </td>
        </tr> -->
        <tr style="text-align: left">
            <td width="20%" colspan="4">
               <strong>14f Total Equity</strong> <em>(Add lines 14a, 14b, 14d and 14e. Also include any amounts from any attachments to your total equity)</em>
            </td>
            <td width="20%">
            $ <span class="parrafo">{{number_format($totalDigitalAsset,2)}}</span>
            </td>
        </tr>
        <tr style="text-align: left">
            <td width="20%" colspan="5">
               <strong>AVAILABLE CREDIT</strong>  Include all lines of credit and bank issued credit cards.
            </td>
        </tr>
        <tr >
            <td width="40%" colspan="2">
                Full Name & Address <br>
                <em>(Street, City, State, ZIP code and Country)</em> of Credit Institution
            </td>
            <td width="20%">
                Credit Limit
            </td>
            <td width="20%">
                Amount Owed <br>
                As of xxxxxxx
            </td>
            <td width="20%">
                <strong>Available Credit</strong><br>
                As of xxxxxxx
            </td>
        </tr>
        @php
            $available_credit = 0;
        @endphp

        @foreach($creditAccounts as $creditAccount)
            @php
                        $available_credit += $creditAccount->credit_limit - $creditAccount->loan_balance;
            @endphp
        <tr style="text-align: left">
            <td width="40%" colspan="2">
               <strong>15{{ chr(97 + $loop->index) }}</strong> <span class="parrafo">{{strtoupper($creditAccount->bank_name.' '.$creditAccount->bank_address.' '.$creditAccount->city_state_zip)}}</span>
               <br>
               Acct. No <span class="parrafo">{{$creditAccount->account_number}}</span>
            </td>
            <td width="20%">
            $ <span class="parrafo">{{$creditAccount->credit_limit}}</span>
            </td>
            <td width="20%">
            $ <span class="parrafo">{{$creditAccount->loan_balance}}</span>
            </td>
            <td width="20%">
            $ <span class="parrafo">{{number_format(($creditAccount->credit_limit - $creditAccount->loan_balance),2)}}</span>
            </td>
        </tr>
        @endforeach
        <!-- <tr style="text-align: left">
            <td width="40%" colspan="2">
               <strong>15b</strong> 
               <br>
               Acct. No
            </td>
            <td width="20%">
            $
            </td>
            <td width="20%">
            $
            </td>
            <td width="20%">
            $
            </td>
        </tr> -->
        <tr style="text-align: left">
            <td width="80%" colspan="4">
               <strong>15c Total Available Credit</strong>  <em> (Add lines 15a, 15b and amounts from any attachments)</em>
            </td>
            <td width="20%">
            $ <span class="parrafo">{{number_format($available_credit,2)}}</span>
            </td>
        </tr>
        <tr style="text-align: left">
            <td width="80%" colspan="5">
               <strong>16a LIFE INSURANCE</strong>  Do you own or have any interest in any life insurance policies with cash value <br> <br>
               <div class="checkbox {{($client->life_insurance_cash_value == 'yes') ? 'checkbox-marked' : ''}}">{{($client->life_insurance_cash_value == 'yes') ? 'X' : ''}}</div> Yes 
               <div class="checkbox {{($client->life_insurance_cash_value == 'no') ? 'checkbox-marked' : ''}}">{{($client->life_insurance_cash_value == 'no') ? 'X' : ''}}</div> No  
               If yes, complete blocks 16b through 16f for each policy.
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px; text-align: left">
        @php $availableLifeInsurance = 0; @endphp
        <tr>
            <td width="40%">
                <strong>16b</strong> Name and Address of Insurance <br>
                Company(ies):
            </td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[0]) ? strtoupper(trim($lifeInsurances[0]->company_name)) : '' }}</span></td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[1]) ? strtoupper(trim($lifeInsurances[1]->company_name)) : '' }}</span></td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[2]) ? strtoupper(trim($lifeInsurances[2]->company_name)) : '' }}</span></td>
        </tr>
        <tr>
            <td width="40%">
                <strong>16c</strong> Policy Number(s)
            </td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[0]) ? strtoupper(trim($lifeInsurances[0]->policy_number)) : '' }}</span></td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[1]) ? strtoupper(trim($lifeInsurances[1]->policy_number)) : '' }}</span></td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[2]) ? strtoupper(trim($lifeInsurances[2]->policy_number)) : '' }}</span></td>
        </tr>
        <tr>
            <td width="40%">
                <strong>16d</strong> Owner of Policy
            </td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[0]) ? strtoupper(trim($lifeInsurances[0]->policy_owner)) : '' }}</span></td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[1]) ? strtoupper(trim($lifeInsurances[1]->policy_owner)) : '' }}</span></td>
            <td width="20%"><span class="parrafo">{{ isset($lifeInsurances[2]) ? strtoupper(trim($lifeInsurances[2]->policy_owner)) : '' }}</span></td>
        </tr>
        <tr>
            <td width="40%">
                <strong>16e</strong> Current Cash Value
            </td>
            <td width="20%">$ <span class="parrafo">{{ isset($lifeInsurances[0]) ? strtoupper(trim($lifeInsurances[0]->current_cash_value)) : '' }}</span></td>
            <td width="20%">$ <span class="parrafo">{{ isset($lifeInsurances[1]) ? strtoupper(trim($lifeInsurances[1]->current_cash_value)) : '' }}</span></td>
            <td width="20%">$ <span class="parrafo">{{ isset($lifeInsurances[2]) ? strtoupper(trim($lifeInsurances[2]->current_cash_value)) : '' }}</span></td>
        </tr>
        <tr>
            <td width="40%">
                <strong>16f</strong> Outstanding Loan Balance
            </td>
            <td width="20%">$ <span class="parrafo">{{ isset($lifeInsurances[0]) ? strtoupper(trim($lifeInsurances[0]->outstanding_loan_balance)) : '' }}</span></td>
            <td width="20%">$ <span class="parrafo">{{ isset($lifeInsurances[1]) ? strtoupper(trim($lifeInsurances[1]->outstanding_loan_balance)) : '' }}</span></td>
            <td width="20%">$ <span class="parrafo">{{ isset($lifeInsurances[2]) ? strtoupper(trim($lifeInsurances[2]->outstanding_loan_balance)) : '' }}</span></td>
        </tr>
        @php
        $availableLifeInsurance1 = isset($lifeInsurances[0]) ? (trim($lifeInsurances[0]->current_cash_value) - trim($lifeInsurances[0]->outstanding_loan_balance)) : 0;
        $availableLifeInsurance2 = isset($lifeInsurances[1]) ? (trim($lifeInsurances[1]->current_cash_value) - trim($lifeInsurances[1]->outstanding_loan_balance)) : 0;
        $availableLifeInsurance3 = isset($lifeInsurances[2]) ? (trim($lifeInsurances[2]->current_cash_value) - trim($lifeInsurances[2]->outstanding_loan_balance)) : 0;

        $totalLifeInsurance = $availableLifeInsurance1 + $availableLifeInsurance2 + $availableLifeInsurance3;

        @endphp
        <tr>
            <td width="80%" colspan="3">
                <strong>16g Total Available Cash</strong> 
            </td>
            <td width="20%">$ <span class="parrafo">{{number_format($totalLifeInsurance,2)}}</span></td>
        </tr>
    </table>

    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 20312N</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-A</strong> (Rev. 7-2022)</td>
        </tr>
    </table>

    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 2 -->
    <br><br><br><br> <br><br><br><br>  <br><br><br><br>  <br><br><br><br>  <br><br><br><br>
    <!-- Pagina 3 -->
    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-A (Rev. 7-2022)</td>
            <td width="5%">Page <strong style=" font-size: 12px">3</strong></td>
        </tr>
    </table>
    <table style="font-size: 11px;">
        <tr>
            <td colspan="7">
                <div class="section-title">Section 4: Personal Asset Information for all Individuals (Foreign and Domestic) (Continued)</div>
            </td>
        </tr>
        <tr>
            <td colspan="7">
                <strong>REAL PROPERTY </strong> Include all real property owned or being purchased
                text
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px; text-align: center">
        <tr>
            <td  width="28%"></td>
            <td  width="12%">Purchase Date <br> <em>( mmddyyyy )</em></td>
            <td  width="12%">Current Fair <br>Market Value <br>(FMV)</td>
            <td  width="12%">Current Loan <br>Balance</td>
            <td  width="12%">Amount of <br>Monthly Payment</td>
            <td  width="12%">Date of Final <br>Payment <br> <em>(mmddyyyy)</em></td>
            <td  width="12%"><strong>Equity</strong><br>FMV Minus Loan</td>
        </tr>
        @php
            $contador = 0;
            $totalProperty = 0;
        @endphp
        @foreach($propertys as $property)
            @php
                $equity = $property->purchase_price  - $property->loan_balance;
                $totalProperty += $equity;
                $contador+= 1;
            @endphp


        <tr style="text-align: left">
            <td  width="28%">
                <strong>17{{ chr(97 + $loop->index) }} </strong>Property Description <br>
                
            </td>
            <td  width="12%" class="parrafo">{{ isset($property) ? strtoupper(trim($property->purchase_date)) : '' }}</td>
            <td  width="12%" class="parrafo"><br>$ {{ isset($property) ? number_format($property->purchase_price,2) : '' }}</td>
            <td  width="12%" class="parrafo"><br>$ {{ isset($property) ? number_format($property->loan_balance,2) : '' }}</td>
            <td  width="12%" class="parrafo"><br>$ {{ isset($property) ? number_format($property->monthly_payment,2) : '' }}</td>
            <td  width="12%" class="parrafo"> {{ isset($property) ? trim($property->final_payment_date) : '' }}</td>
            <td  width="12%" class="parrafo"><br>$ {{number_format($equity, 2)}}</td>
        </tr>
        <tr>
            <td  width="28%" colspan="3" style="">
                Location <em>(street, city, state, ZIP code, county and country)</em> <br>
                <p class="parrafo tl" style="margin: 0px;  margin-top: 5px; margin-left: 5px;">
                {{ isset($property) ? strtoupper(trim($property->street_address)) : '' }}
                <br>
                {{ isset($property) ? strtoupper(trim($property->city_state_zip)) : '' }}
                    
                </p>
            </td>
            <td  width="72%" colspan="4">
                Lender/Contract Holder Name, Address (street, city, state, ZIP code), and Phone
                <br>
                <p class="parrafo tl" style="margin: 0px;  margin-top: 5px; margin-left: 5px;">
                {{ isset($property) ? strtoupper(trim($property->lender_name)) : '' }}
                <br>
                {{ isset($property) ? strtoupper(trim($property->lender_address.' '.$property->lender_city_state_zip)) : '' }}
                    
                </p>
                <br>Phone <span class="parrafo">{{ isset($property) ? strtoupper(trim($property->lender_phone)) : '' }}</span>
            </td>
        </tr>
        @endforeach

        @if($contador == 1)
            <tr style="text-align: left">
                <td  width="28%">
                    <strong>17b </strong>Property Description <br>
                    
                </td>
                <td  width="12%"></td>
                <td  width="12%"><br>$</td>
                <td  width="12%"><br>$</td>
                <td  width="12%"><br>$</td>
                <td  width="12%"></td>
                <td  width="12%"><br>$</td>
            </tr>
        @endif
        <tr style="text-align: left">
            <td  width="72%" colspan="6">
                <strong>17c Total Equity </strong> <em>(Add lines 17a, 17b and amounts from any attachments)</em>
            </td>
            <td  width="28%" colspan="6">
                $ <span class="parrafo">{{ number_format($totalProperty,2)}}</span>
            </td>
        </tr>
        <tr style="text-align: left">
            <td  width="100%" colspan="7">
                <strong>PERSONAL VEHICLES LEASED AND PURCHASED </strong> Include boats, RVs, motorcycles, all-terrain and off-road vehicles, trailers, etc
            </td>
        </tr>
        <tr>
            <td  width="28%"><strong>Description </strong>(Year, Mileage, Make/Model, Tag Number, Vehicle Identification Number)</td>
            <td  width="12%">Purchase/<br/> Lease Date <br> <em>( mmddyyyy )</em></td>
            <td  width="12%">Current Fair <br>Market Value <br>(FMV)</td>
            <td  width="12%">Current Loan <br>Balance</td>
            <td  width="12%">Amount of <br>Monthly Payment</td>
            <td  width="12%">Date of Final <br>Payment <br> <em>(mmddyyyy)</em></td>
            <td  width="12%"><strong>Equity</strong><br>FMV Minus Loan</td>
        </tr>
        @php
            $contadorVehicle = 0;
            $totalEquity = 0;
        @endphp
        @foreach($vehicles as $vehicle)

        @php
            $equityVe = $vehicle->current_value - $vehicle->current_loan_balance;
            $totalEquity += $equityVe;
        @endphp

        <tr style="text-align: left">
            <td  width="28%" style="padding: 0">
                <table border="1" style="font-size: 11px; text-align: left; width: 100%;margin: 0">
                    <tr>
                        <td>
                            <strong>18{{ chr(97 + $loop->index) }} </strong>Year <br><br>
                            <span class="parrafo">{{$vehicle->year}}</span>
                        </td>
                        <td>
                            Make/Model <br><br>
                            <span class="parrafo">{{ strtoupper(trim($vehicle->make).' '.trim($vehicle->model))}}</span>
                        </td>
                    </tr>
                </table>
            </td>
            <td  width="12%"><span class="parrafo">{{$vehicle->purchase_date}}</span></td>
            <td  width="12%"><br>$ <span class="parrafo">{{$vehicle->current_value}}</span></td>
            <td  width="12%"><br>$ <span class="parrafo">{{$vehicle->current_loan_balance}}</span></td>
            <td  width="12%"><br>$ <span class="parrafo">{{$vehicle->monthly_payment}}</span></td>
            <td  width="12%"><span class="parrafo">{{$vehicle->date_of_final_payment}}</span></td>
            <td  width="12%"><br>$ <span class="parrafo">{{number_format($equityVe, 2)}}</span></td>
        </tr>
        <tr style="text-align: left">
            <td  width="28%" style="padding: 0">
                <table border="1"   cellspacing="0" cellpadding="0"   style="font-size: 11px; text-align: left; width: 100% margin: 0">
                    <tr>
                        <td>
                            Mileage<br><span class="parrafo">{{ strtoupper(trim($vehicle->mileage)) }}</span><br>
                          
                        </td>
                        <td>
                            License/Tag Number <br><span class="parrafo">{{ strtoupper(trim($vehicle->license)) }}</span><br>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Vehicle Identification Number<br><span class="parrafo">{{ strtoupper(trim($vehicle->vin)) }}</span><br>
                          
                        </td>
                    </tr>
                </table>
            </td>
            <td  width="72%" colspan="6" style="margin: 0" >Lender/Lessor Name, Address (street, city, state, ZIP code and country), and Phone
                <br><span class="parrafo">{{ strtoupper(trim($vehicle->lender_name.' '.$vehicle->lender_address.' '.$vehicle->lender_city_state_zip)) }}</span>
                <br>Phone <span class="parrafo">{{ strtoupper(trim($vehicle->lender_phone)) }}</span>
            </td>
        </tr>
        @endforeach



        @if($contadorVehicle == 0)
        <tr style="text-align: left">
            <td  width="28%" style="padding: 0">
                <table border="1" style="font-size: 11px; text-align: left; width: 100%;margin: 0">
                    <tr>
                        <td>
                            <strong>18b </strong>Year <br><br>

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
        @endif
        <tr style="text-align: left">
            <td  width="72%" colspan="6">
                <strong>18c Total Equity </strong> <em>(Add lines 18a, 18b and amounts from any attachments)</em>
            </td>
            <td  width="28%" >
                $ <span class="parrafo">{{number_format($totalEquity,2)}}</span>
            </td>
        </tr>
        <tr style="text-align: left">
            <td  width="100%" colspan="7">
                <strong>PERSONAL ASSETS </strong>  Include all furniture, personal effects, artwork, jewelry, collections (coins, guns, etc.), antiques or other assets. Include
                intangible assets such as licenses, domain names, patents, copyrights, mining claims, etc.
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px; text-align: center">
        <tr>
            <td  width="28%"></td>
            <td  width="12%">Purchase Date <br> <em>( mmddyyyy )</em></td>
            <td  width="12%">Current Fair <br>Market Value <br>(FMV)</td>
            <td  width="12%">Current Loan <br>Balance</td>
            <td  width="12%">Amount of <br>Monthly Payment</td>
            <td  width="12%">Date of Final <br>Payment <br> <em>(mmddyyyy)</em></td>
            <td  width="12%"><strong>Equity</strong><br>FMV Minus Loan</td>
        </tr>
        @php
        $contadorOtherAsset = 0;
        $totalOtherAsset = 0;
        @endphp
        @foreach($otherAssets as $otherAsset)
            @php
                $contadorOtherAsset += 1;
                $equity = $otherAsset->current_value - $otherAsset->current_loan_balance;
                $totalOtherAsset += $equity;
            @endphp
        <tr style="text-align: left">
            <td  width="28%">
                <strong>19a </strong>Property Description <br>
                <span class="parrafo">{{ strtoupper(trim($otherAsset->description)) }}</span>
            </td>
            <td  width="12%"></td>
            <td  width="12%"><br>$<span class="parrafo">{{ number_format($otherAsset->current_value,2) }}</span></td>
            <td  width="12%"><br>$<span class="parrafo">{{ number_format($otherAsset->current_loan_balance,2) }}</span></td>
            <td  width="12%"><br>$<span class="parrafo">{{ number_format($otherAsset->monthly_payment,2) }}</span></td>
            <td  width="12%"></td>
            <td  width="12%"><br>$<span class="parrafo">{{ number_format($equity,2) }}</span></td>
        </tr>
        <tr>
            <td  width="28%" colspan="3">
                Location <em>(street, city, state, ZIP code, county and country)</em> <br>
                <span class="parrafo">{{ strtoupper(trim($otherAsset->street_address.', '.$otherAsset->city_state_zip)) }}</span>
            </td>
            <td  width="72%" colspan="4">
                Lender/Contract Holder Name, Address (street, city, state, ZIP code), and Phone
                <br>
                <span class="parrafo">{{ strtoupper(trim($otherAsset->lender_address.', '.$otherAsset->lender_city_state_zip)) }}</span>
                <br>Phone <span class="parrafo">{{ strtoupper(trim($otherAsset->lender_phone)) }}</span>
            </td>
        </tr>
        @endforeach

        @if($contadorOtherAsset == 1)

        <tr style="text-align: left">
            <td  width="28%">
                <strong>19b </strong>Property Description <br>
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
                xx
            </td>
            <td  width="72%" colspan="4">
                Lender/Contract Holder Name, Address (street, city, state, ZIP code), and Phone
                <br>
                <br>Phone
            </td>
        </tr>
        @endif
        <tr style="text-align: left">
            <td  width="72%" colspan="6">
                <strong>19c Total Equity </strong> <em>(Add lines 19a, 19b and amounts from any attachments)</em>
            </td>
            <td  width="28%" colspan="6">
                $ <span class="parrafo">{{ number_format($totalOtherAsset,2) }}</span>
            </td>
        </tr>
    </table>

    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 20312N</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-A</strong> (Rev. 7-2022)</td>
        </tr>
    </table>

    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 4 -->
    <br><br><br><br> <br><br><br><br>  <br><br><br><br>  <br><br><br><br>  <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <!-- Pagina 4 -->
    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-A (Rev. 7-2022)</td>
            <td width="5%">Page <strong style=" font-size: 12px">4</strong></td>
        </tr>
    </table>
    <table border="1" width="100%" style="font-size: 11px;">
        <tr>
            <td colspan="5" style="text-align: center; border-top: 1px solid #000">
                <strong>If you are self-employed, sections 6 and 7 must be completed before continuing</strong>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <div class="section-title">Section 5: Monthly Income and Expenses (Foreign and Domestic) </div>
            </td>
        </tr>
        
        <tr>
            <td colspan="5" >
                Monthly Income/Expense Statement (For additional information, refer to Publication 1854.)
            </td>
        </tr>
        <tr style="text-align: center">
            <td colspan="2" >
                <strong>Total Income </strong> <em>(Amounts reported in U.S. dollars)</em>
            </td>
            <td colspan="2" >
                <strong>Total Living Expenses </strong> <em>(Amounts reported in U.S. dollars)</em>
            </td>
            <td >
                <strong>IRS USE ONLY</strong> 
            </td>
        </tr>
        <tr style="text-align: center">
            <td >Source</td>
            <td >Gross Monthly</td>
            <td >Expense Items <sup>6</sup></td>
            <td >Actual Monthly</td>
            <td >Allowable Expenses</td>
        </tr>

        @php
                $expenseFields_35 = [
                      'expenses_food',
                      'expenses_housekeeping_supplies',
                      'expenses_clothing',
                      'expenses_personal_care_products',
                      'expenses_credit_card_payments',
                      'expenses_bank_fees',
                      'expenses_school_supplies',
                      'expenses_miscellaneous',
                ];

                $expenseFields_36 = [
                      'expenses_mortgage',
                      'expenses_homeowners_insurance',
                      'expenses_rent',
                      'expenses_renters_insurance',
                      'expenses_real_estate_taxes',
                      'expenses_housing_maintenance',
                      'expenses_dues',
                      'expenses_fees',
                      'expenses_repairs',
                      'expenses_electric',
                      'expenses_natural_gas',
                      'expenses_water',
                      'expenses_trash_collection',
                      'expenses_home_phone',
                      'expenses_cellphone',
                      'expenses_internet',
                      'expenses_cable',
                      'expenses_oil',
                      'expenses_fuel',
                      'expenses_other_fuels',
                  ];

                  $expenseFields_37 = [
                      'expenses_car_loan_payment',
                      'expenses_car_lease_payment',
                  ];

                  $expenseFields_38 = [
                      'expenses_vehicle_maintenance',
                      'expenses_vehicle_repairs',
                      'expenses_vehicle_insurance',
                      'expenses_vehicle_fuel',
                      'expenses_vehicle_registrations',
                      'expenses_vehicle_licenses',
                      'expenses_parking',
                      'expenses_inspections',
                      'expenses_tolls',
                  ];

                  $expenseFields_39 = [
                      'expenses_bus',
                      'expenses_train',
                      'expenses_ferry',
                      'expenses_taxi',
                      'expenses_ride_share',
                  ];

                  $expenseFields_40 = [
                      'expenses_health_insurance',
                      'expenses_dental_insurance',
                      'expenses_vision_insurance',
                  ];

                  $expenseFields_41 = [
                      'expenses_medical_services',
                      'expenses_prescription_drugs',
                      'expenses_medical_supplies',
                      'expenses_medical_equipment',
                      'expenses_eyeglasses',
                      'expenses_contacts',
                      'expenses_hearing_aids',
                  ];

                  $expenseFields_42 = [
                      'expenses_alimony',
                      'expenses_child_support',
                      'expenses_restitution',
                  ];

                  $expenseFields_43 = [
                      'expenses_daycare',
                      'expenses_babysitter_fees',
                      'expenses_elder_care',
                  ];

                  $expenseFields_44 = [
                     'expenses_life_insurance',
                  ];

                  $expenseFields_45 = [
                    'expenses_w2_federal',
                    'expenses_w2_state',
                    'expenses_fed_estimated_taxes',
                    'expenses_state_estimated_taxes',
                    'expenses_social_security',
                    'expenses_medicare',
                  ];

                  $expenseFields_46 = [
                    'expenses_heloc',
                    'expenses_personal_loan',
                    'expenses_student_loans',
                    'expenses_secured_cc',
                    'expenses_cd_loans',
                    'expenses_jewelry',
                    'expenses_stocks_bonds',
                  ];

                  $expenseFields_47 = [
                      'expenses_state_taxes',
                      'expenses_property_taxes',
                      'expenses_sales_taxes',
                      'expenses_local_taxes',
                    ];

                $expenseFields_48 = [
                    'expenses_pet_related',
                    'expenses_charitable_contributions',
                    'expenses_legal_fees',
                    'expenses_disability_expenses',
                    'expenses_professional_dues',
                  ];
                                      
                                      
                                      
                                      
                                      
                                          
                
                $groupedExpenseFields = [
                    'total_35' => $expenseFields_35,
                    'total_36' => $expenseFields_36,
                    'total_37' => $expenseFields_37,
                    'total_38' => $expenseFields_38,
                    'total_39' => $expenseFields_39,
                    'total_40' => $expenseFields_40,
                    'total_41' => $expenseFields_41,
                    'total_42' => $expenseFields_42,
                    'total_43' => $expenseFields_43,
                    'total_44' => $expenseFields_44,
                    'total_45' => $expenseFields_45,
                    'total_46' => $expenseFields_46,
                    'total_47' => $expenseFields_47,
                    'total_48' => $expenseFields_48,
                ];

                $totals         = [];
                $total_expense  = 0;
                $total_income   = 0;



                foreach ($groupedExpenseFields as $key => $fields) {
                    $totals[$key] = 0;

                    foreach ($fields as $field) {
                        $totals[$key] += isset($monthlyFinancials[0]) && isset($monthlyFinancials[0]->$field)
                            ? floatval($monthlyFinancials[0]->$field)
                            : 0;
                    }
                        $total_expense += $totals[$key];
                }

                $incomeFields = [
                    'primary_gross_wages',
                    'spouse_gross_wages',
                    'interested',
                    'dividends_income',
                    'net_business_income',
                    'net_rental_income',
                    'distributions',
                    'primary_pension',
                    'spouse_pension',
                    'primary_social_security',
                    'spouse_social_security',
                    'child_support_received',
                    'alimony_received',
                ];

                foreach ($incomeFields as $key => $fieldsIncome)
                {
                    
                    $total_income += isset($monthlyFinancials[0]) && isset($monthlyFinancials[0]->$fieldsIncome)
                            ? floatval($monthlyFinancials[0]->$fieldsIncome) : 0;
                }


                $diferencia = $total_income - $total_expense;
        @endphp





        
        <tr style="text-align: left">
            <td><strong>20 </strong>Wages (Taxpayer) <sup>1</sup></td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->primary_gross_wages : '' }}</td>
            <td><strong>35 </strong>Food, Clothing and Misc.<sup>7</sup></td>
            <td>$ {{ number_format($totals['total_35'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>21 </strong>Wages (Spouse) <sup>1</sup></td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->spouse_gross_wages : '' }}</td>
            <td><strong>36 </strong>Housing and Utilities<sup>8</sup></td>
            <td>${{ number_format($totals['total_36'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>22 </strong>Interest - Dividends</td>
            <td>${{ isset($monthlyFinancials[0]) ? ($monthlyFinancials[0]->interested + $monthlyFinancials[0]->dividends_income) : '' }}</td>
            <td><strong>37 </strong>Vehicle Ownership Costs <sup>9</sup></td>
            <td>${{ number_format($totals['total_37'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>23 </strong>Net Business Income <sup>2</sup></td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->net_business_income : '' }}</td>
            <td><strong>38 </strong>Vehicle Operating Costs<sup>10</sup></td>
            <td>${{ number_format($totals['total_38'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>24 </strong>Net Rental Income <sup>3</sup></td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->net_rental_income : '' }}</td>
            <td><strong>39 </strong>Public Transportation<sup>11</sup></td>
            <td>${{ number_format($totals['total_39'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>25 </strong>Distributions (K-1, IRA, etc.) <sup>4</sup></td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->distributions : '' }}</td>
            <td><strong>40 </strong>Health Insurance</td>
            <td>${{ number_format($totals['total_40'],2) }}</td>
            <td></td>
        </tr>
        <!-- 'primary_unemployment',
        'spouse_unemployment',
        'additional_household_income', -->
        <tr style="text-align: left">
            <td><strong>26 </strong> Pension (Taxpayer)</td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->primary_pension : '' }}</td>
            <td><strong>41 </strong>Out of Pocket Health Care Costs <sup>12</sup></td>
            <td>${{ number_format($totals['total_41'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>27 </strong>Pension (Spouse)</td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->spouse_pension : '' }}</td>
            <td><strong>42 </strong>Court Ordered Payments</td>
            <td>${{ number_format($totals['total_42'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>28 </strong>Social Security (Taxpayer)</td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->primary_social_security : '' }}</td>
            <td><strong>43 </strong>Child/Dependent Care</td>
            <td>${{ number_format($totals['total_43'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>29 </strong>Social Security (Spouse)</td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->spouse_social_security : '' }}</td>
            <td><strong>44 </strong>Life Insurance</td>
            <td>${{ number_format($totals['total_44'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>30 </strong>Child Support</td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->child_support_received : '' }}</td>
            <td><strong>45 </strong>Current year taxes (Income/FICA) <sup>13</sup></td>
            <td>${{ number_format($totals['total_45'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>31 </strong>Alimony</td>
            <td>${{ isset($monthlyFinancials[0]) ? $monthlyFinancials[0]->alimony_received : '' }}</td>
            <td><strong>46 </strong>Secured Debts (Attach list)</td>
            <td>${{ number_format($totals['total_46'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong> </strong>Other Income (Specify below) <sup>5</sup></td>
            <td>$</td>
            <td><strong>47 </strong>Delinquent State or Local Taxes</td>
            <td>${{ number_format($totals['total_47'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>32 </strong></td>
            <td>$</td>
            <td><strong>48 </strong>Other Expenses (Attach list)</td>
            <td>${{ number_format($totals['total_48'],2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>33 </strong></td>
            <td>$</td>
            <td><strong>49 </strong>Total Living Expenses (add lines 35-48)</td>
            <td>${{ number_format($total_expense,2) }}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td><strong>34 </strong>Total Income (add lines 20-33)</td>
            <td>$ {{ number_format($total_income,2) }}</td>
            <td><strong>50 </strong>Net difference (Line 34 minus 49)</td>
            <td>$ {{number_format($diferencia,2) }}</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" style="font-size:10px">
                <strong>1 Wages, salaries, pensions, and social security:</strong> 
                Enter gross monthly wages and/or salaries. Do not deduct tax withholding or allotments taken out of
                pay, such as insurance payments, credit union deductions, car payments, etc. To calculate the gross monthly wages and/or salaries: <br>
                <em>If paid weekl</em> - multiply weekly gross wages by 4.3. Example: $425.89 x 4.3 = $1,831.33 <br>
                <em>If paid biweekly (every 2 weeks)</em> - multiply biweekly gross wages by 2.17. Example: $972.45 x 2.17 = $2,110.22 <br>
                <em>If paid semimonthly (twice each month) -</em> If paid semimonthly (twice each month)
                <br>
                <strong>2 Net Income from Business:</strong>
                Enter monthly net business income. This is the amount earned after ordinary and necessary monthly business
                expenses are paid.<strong> This figure is the amount from page 6, line 89.</strong> If the net business income is a loss, enter “0”. Do not enter a negative
                number. If this amount is more or less than previous years, attach an explanation
                <br>
                <strong>3 Net Rental Income:</strong>
                Enter monthly net rental income. This is the amount earned after ordinary and necessary monthly rental expenses are
                paid. Do not include deductions for depreciation or depletion. If the net rental income is a loss, enter “0.” Do not enter a negative number
                <br>
                <strong>4 Distributions:</strong>
                Enter the total distributions from partnerships and subchapter S corporations reported on Schedule K-1, and from limited
                liability companies reported on Form 1040, Schedule C, D or E. Enter total distributions from IRAs if not included under pension income.
                <br>
                <strong>5 Other Income:</strong>
                Include agricultural subsidies, unemployment compensation, gambling income, oil credits, rent subsidies, sharing economy
                income from providing on-demand work, services or goods (e.g., Uber, Lyft, AirBnB, VRBO) and income through digital platforms like an app or
                website (e.g., YouTube, TikTok), etc. Recurring capital gains from the sale of securities including cryptocurrency and non-fungible tokens.
                <br>
                <strong>6 Expenses not generally allowed:</strong>
                We generally do not allow tuition for private schools, public or private college expenses, charitable
                contributions, voluntary retirement contributions or payments on unsecured debts. However, we may allow the expenses if proven that they are
                necessary for the health and welfare of the individual or family or the production of income. See Publication 1854 for exceptions.
                <br>
                <strong>7 Food, Clothing and Miscellaneous:</strong>
                Total of food, clothing, housekeeping supplies, and personal care products for one month. The miscellaneous
                allowance is for expenses incurred that are not included in any other allowable living expense items. Examples are credit card payments, bank fees
                and charges, reading material, and school supplies.
                <br>
                <strong>8 Housing and Utilities:</strong>
                For principal residence: Total of rent or mortgage payment. Add the average monthly expenses for the following:
                property taxes, homeowner’s or renter’s insurance, maintenance, dues, fees, and utilities. Utilities include gas, electricity, water, fuel, oil,
                other fuels, trash collection, telephone, cell phone, cable television and internet services
                <br>
                <strong>9 Vehicle Ownership Costs:</strong>
                Total of monthly lease or purchase/loan payments.
                <br>
                <strong>10 Vehicle Operating Costs: </strong>
                Total of maintenance, repairs, insurance, fuel, registrations, licenses, inspections, parking, and tolls for one month.
                <br>
                <strong>11 Public Transportation: </strong>
                Total of monthly fares for mass transit (e.g., bus, train, ferry, taxi, etc.)
                <br>
                <strong>12 Out of Pocket Health Care Costs: </strong>
                Monthly total of medical services, prescription drugs and medical supplies (e.g., eyeglasses, hearing aids, etc.)
                <br>
                <strong>13 Current Year Taxes:</strong>
                Include state and Federal taxes withheld from salary or wages, or paid as estimated taxes.
            </td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:center">
                <strong>Certification:</strong> <em>Under penalties of perjury, I declare that to the best of my knowledge and belief this statement of assets, liabilities, and other
                information is true, correct, and complete.</em>
            </td>
        </tr>
        <tr style="text-align: left">
            <td colspan="2">
                <strong>Taxpayer's Signature</strong>
                <br><br>
            </td>
            <td colspan="2">
                <strong>Spouse's signature</strong>
                <br><br>
            </td>
            <td>
                <strong>Date</strong>
                <br><br>
            </td>
        </tr> 
        <tr>
            <td colspan="5" style="text-align:left">
                <strong>After we review the completed Form 433-A, you may be asked to provide verification for the assets, encumbrances, income and expenses
                reported. Documentation may include previously filed income tax returns, pay statements, self-employment records, bank and investment
                statements, loan statements, bills or statements for recurring expenses, etc.</strong>
            </td>
        </tr> 
        <tr>
            <td colspan="5" style="text-align:left">
                <strong>IRS USE ONLY</strong> <em>(Notes)</em>
                <br><br><br><br><br><br>
            </td>
        </tr> 
    </table>
     
    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 20312N</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-A</strong> (Rev. 7-2022)</td>
        </tr>
    </table>

    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 4 -->
    <br><br><br><br> <br><br><br><br>  <br><br><br><br>  <br><br><br><br>  <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <!-- Pagina 5 -->

    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-A (Rev. 7-2022)</td>
            <td width="5%">Page <strong style=" font-size: 12px">5</strong></td>
        </tr>
    </table>
    <table border="1" width="100%" style="font-size: 11px;">
        <tr>
            <td colspan="5" style="text-align: center; border-top: 1px solid #000">
                <strong>Sections 6 and 7 must be completed only if you are SELF-EMPLOYED.</strong>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <div class="section-title">Section 6: Business Information (Foreign and Domestic)</div>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <strong>51</strong> Is the business a sole proprietorship (filing Schedule C) 
                <div class="checkbox {{  ($client->sole_proprietorship == 1) ? 'checkbox-marked' :'' }}">{{  ($client->sole_proprietorship == 1) ? 'X' :'' }}</div> <strong>Yes</strong>, Continue with Sections 6 and 7.  
                <div class="checkbox {{  ($client->sole_proprietorship == 0) ? 'checkbox-marked' :'' }}">{{  ($client->sole_proprietorship == 0) ? 'X' :'' }}</div> <strong>No</strong>, Complete Form 433-B.
                <br>
                All other business entities, including limited liability companies, partnerships or corporations, must complete Form 433-B.
            </td>
        </tr>
        <tr>
            <td colspan="4" width="70%">
                <strong>51</strong> Business Name & Address <em>(if different than 1b)</em> 
                <br>
                <span class="parrafo">{{ strtoupper($client->business_name.', '.$client->business_street.', '.$client->business_city.', '.$client->business_state.' '.$client->business_zip_code) }}</span>
            </td>
            <td  width="30%">
                <strong>52b Business Telephone Number</strong><br>
                <span class="parrafo">{{ strtoupper($client->business_phone)}}</span>

            </td>
        </tr>
        <tr>
            <td  width="30%">
                <strong>53 </strong>Employer Identification Number<br>
                <span class="parrafo">{{ strtoupper($client->business_ein)}}</span>

            </td>
            <td colspan="3" width="40%">
                <strong>54</strong> Type of Business
                <br>
                <span class="parrafo">{{ strtoupper($client->type_of_business)}}</span>
            </td>
            <td  width="30%">
                <strong>55</strong>  Is the business a<br>
                Federal Contractor 
                <div class="checkbox {{  ($client->federal_contractor == 1) ? 'checkbox-marked' :'' }}">{{  ($client->federal_contractor == 1) ? 'X' :'' }}</div> <strong>Yes</strong>   
                <div class="checkbox {{  ($client->federal_contractor == 0) ? 'checkbox-marked' :'' }}">{{  ($client->federal_contractor == 0) ? 'X' :'' }}</div> <strong>No</strong>
            </td>
        </tr>
        <tr>
            <td  width="30%">
                <strong>56 </strong>Business Website (web address)<br>
                <span class="parrafo">{{ strtoupper($client->business_website)}}</span>

            </td>
            <td colspan="3" width="40%">
                <strong>57</strong> Total Number of Employees
                <br>
                <span class="parrafo">{{ strtoupper($client->total_number_of_employees)}}</span>
            </td>
            <td  width="30%">
                <strong>58</strong>  Average Gross Monthly Payroll<br>
                <span class="parrafo">{{ strtoupper($client->average_gross_monthly_payroll)}}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2"  width="70%">
                <strong>59 </strong>Frequency of Tax Deposits<br>
                <span class="parrafo">{{ strtoupper($client->frequency_tax_deposits)}}</span>

            </td>
            <td colspan="3"  width="30%">
                <strong>60</strong>  Does the business engage in e-Commerce<br>
                (Internet sales) If yes, complete lines 61a and 61b      
                <div class="checkbox {{  ($client->business_ecommerce_virtual_currency == 1) ? 'checkbox-marked' :'' }}">{{  ($client->business_ecommerce_virtual_currency == 1) ? 'X' :'' }}</div> <strong>Yes</strong>   
                <div class="checkbox {{  ($client->business_ecommerce_virtual_currency == 0) ? 'checkbox-marked' :'' }}">{{  ($client->business_ecommerce_virtual_currency == 0) ? 'X' :'' }}</div> <strong>No</strong>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <strong>PAYMENT PROCESSOR</strong> <em> (e.g., PayPal, Authorize.net, Google Checkout, BitPay, Crypto.com, etc.)</em> 
                Include virtual currency wallet, exchange or digital currency exchange.
            </td>
        </tr>

        <tr>
            <td colspan="3" style="text-align:center">
                Name & Address (Street, City, State, ZIP code, and Country)
            </td>
            <td colspan="2" style="text-align:center">
                Payment Processor Account
                Number
            </td>
        </tr>
        @php
            $contadorPayment = 0;
        @endphp
        @foreach($paymentProcessors as $paymentProcessor)
        @php
            $contadorPayment += 1;
        @endphp
        <tr>
            <td colspan="3" style="text-align:left">
                <strong>61{{ chr(97 + $loop->index) }}</strong> <span class="parrafo">{{ strtoupper($paymentProcessor->processor_name.' '.$paymentProcessor->street_address.' '.$paymentProcessor->city_state_zip) }}</span> 
            </td>
            <td colspan="2" style="text-align:left">
               <span class="parrafo">{{$paymentProcessor->account_number}}</span> 
            </td>
        </tr>
        @endforeach
        @if($contadorPayment < 3)
            @for($i =  $contadorPayment; $i< 3; $i++)
            <tr>
                <td colspan="3" style="text-align:left">
                    <strong>61{{ chr(97 + $i) }}</strong> 
                </td>
                <td colspan="2" style="text-align:left">
                   
                </td>
            </tr>
            @endfor
        @endif
        
        <tr>
            <td colspan="5" style="text-align:left">
                <strong>CREDIT CARDS ACCEPTED BY THE BUSINESS</strong> 
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:center">
                Credit Card
            </td>
            <td style="text-align:center">
                Merchant Account Number
            </td>
            <td style="text-align:center">
                Issuing Bank Name & Address <em>(Street, City, State, ZIP code, and Country)</em> 
            </td>
        </tr>

        @php
            $contadorCreditCard = 0;
        @endphp

        @foreach($creditCards as $creditCard)
            @php
                $contadorCreditCard += 1;
            @endphp
            <tr>
                <td colspan="3" style="text-align:left">
                    <strong>62{{ chr(97 + $loop->index) }}  </strong>
                    <span class="parrafo">{{ strtoupper($creditCard->name_on_account) }}</span> 
                </td>
                <td style="text-align:left">
                   <span class="parrafo">{{ strtoupper($creditCard->merchant_account_number)}}</span> 
                </td>
                <td style="text-align:left">
                    <span class="parrafo">{{ strtoupper($creditCard->street_address.' '.$creditCard->city_state_zip) }}</span> 
                </td>
            </tr>
        @endforeach

        @if($contadorCreditCard < 3)
            @for($i = $contadorCreditCard; $i< 3; $i++)
                <tr>
                    <td colspan="3" style="text-align:left">
                        <strong>62{{ chr(97 + $i) }}</strong>
                    </td>
                    <td style="text-align:left">
                       
                    </td>
                    <td style="text-align:left">
                        
                    </td>
                </tr>
            @endfor
        @endif


        <tr>
            <td colspan="4" width="80%" style="text-align:left">
                <strong>63 BUSINESS CASH ON HAND</strong>  Include cash that is not in a bank

                <strong>Total Cash on Hand</strong>
            </td>
            <td style="text-align:left">
                $
            </td>
        </tr>
        <tr>
            <td colspan="5" width="80%" style="text-align:left">
                <strong>BUSINESS BANK ACCOUNTS </strong> Include checking accounts, online and mobile <em>(e.g., PayPal)</em> accounts, money market accounts, savings accounts,
                and stored value cards <em>(e.g., payroll cards, government benefit cards, etc.)</em>. Report Personal Accounts in Section 4.
            </td>
        </tr>
        <tr>
            <td width="10%"  style="text-align:center">
                Type of Account
            </td>
            <td width="70%" colspan="2" style="text-align:center">
            Full name & Address <em>(Street, City, State, ZIP code, and Country)</em> 
            of Bank, Savings & Loan, Credit Union or Financial Institution.
            </td>
            <td width="10%" style="text-align:center">
            Account Number
            </td>
            <td width="10%" style="text-align:center">
                <strong>Account Balance</strong><br>
                As of xxxxxxxx
            </td>
        </tr>

        @php
            $contadorBusinessBankAccounts = 0;
            $totalBusinessBankAccounts = 0;
        @endphp

        @foreach($businessBankAccounts as $businessBankAccount)
            @php
                $totalBusinessBankAccounts += $businessBankAccount->current_value;
            @endphp
        <tr>
            <td width="10%"  style="text-align:left">
                <strong>64{{ chr(97 + $loop->index) }}</strong>
                <span class="parrafo">{{ strtoupper($businessBankAccount->bank_type_name)}}</span>
            </td>
            <td width="70%" colspan="2" style="text-align:left"><span class="parrafo">{{ strtoupper($businessBankAccount->bank_name.' '.$businessBankAccount->bank_address.' '.$businessBankAccount->city_state_zip)}}</span></td>
            <td width="10%" style="text-align:left"><span class="parrafo">{{ strtoupper($businessBankAccount->account_number)}}</span></td>
            <td width="10%" style="text-align:left">$<span class="parrafo">{{ strtoupper($businessBankAccount->current_value)}}</span></td>
        </tr>
        @endforeach

        @if($contadorBusinessBankAccounts> 2)
            @for($i = $contadorBusinessBankAccounts; $i<2; $i++)
            <tr>
                <td width="10%"  style="text-align:left">
                    <strong>64{{ chr(97 + $i) }}</strong>
                </td>
                <td width="70%" colspan="2" style="text-align:left"></td>
                <td width="10%" style="text-align:left"></td>
                <td
                 width="10%" style="text-align:left">$</td>
            </tr>
            @endfor
        @endif
        <tr>
            <td width="80%" colspan="4" style="text-align:left"><strong>64c Total Cash in Banks</strong> <em>(Add lines 64a, 64b and amounts from any attachments)</em> </td>
            <td width="20%" style="text-align:left">$<span class="parrafo">{{ number_format($totalBusinessBankAccounts,2)}}</span></td>
        </tr>
        <tr>
            <td width="80%" colspan="4" style="text-align:left"><strong>ACCOUNTS/NOTES RECEIVABLE</strong> Include e-payment accounts receivable and factoring companies, and any bartering or online auction accounts.
            <em>(List all contracts separately, including contracts awarded, but not started.)</em> <strong>Include Federal, state and local government grants and contracts.</strong></td>
            <td width="20%" style="text-align:left">$</td>
        </tr>
    </table>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" style="font-size: 11px;">
        <tr>
            <td width="30%"  style="text-align:center">
                Accounts/Notes Receivable & Address <br>
                <em>(Street, City, State, ZIP code, and Country)</em>
            </td>
            <td width="15%" style="text-align:center">Status <em>(e.g., age, factored, other)</em></td>
            <td width="15%" style="text-align:center">Date Due <br> <em>(mmddyyyy)</em></td>
            <td width="20%" style="text-align:center">Invoice Number or Government Grant or Contract Number</td>
            <td width="20%" style="text-align:center"> <strong>Amount Due</strong> </td>
        </tr>

        @php
        $contadorCompanyAccountReceivable = 0;
        $totalCompanyAccountReceivable = 0;
        @endphp
        @foreach($companyAccountReceivables as $companyAccountReceivable)
            
            <tr>
                <td width="30%"  style="text-align:left">
                    <strong>65{{ chr(97 + $loop->index) }}</strong>
                    <span class="parrafo">{{$companyAccountReceivable->account_description.', '.$companyAccountReceivable->address.' '.$companyAccountReceivable->city_state_zip}}</span>
                </td>
                <td width="15%" style="text-align:center"><span class="parrafo">{{$companyAccountReceivable->status}}</span></td>
                <td width="15%" style="text-align:center"><span class="parrafo">{{$companyAccountReceivable->due_date}}</span></td>
                <td width="20%" style="text-align:center"><span class="parrafo">{{$companyAccountReceivable->invoice_no}}</span></td>
                <td width="20%" style="text-align:left">$<span class="parrafo">{{$companyAccountReceivable->amount_due}}</span></td>
            </tr>
            @php
                $contadorCompanyAccountReceivable += 1;
                $totalCompanyAccountReceivable += $companyAccountReceivable->amount_due;
            @endphp
        @endforeach

        @if($contadorCompanyAccountReceivable< 4)
            @for($i = $contadorCompanyAccountReceivable; $i < 4; $i++) 
            <tr>
                <td width="30%"  style="text-align:left">
                    <strong>65{{ chr(97 + $i) }}</strong>
                </td>
                <td width="15%" style="text-align:center"></td>
                <td width="15%" style="text-align:center"></td>
                <td width="20%" style="text-align:center"></td>
                <td width="20%" style="text-align:left">$</td>
            </tr>
            @endfor
        @endif
        
        <tr>
            <td width="80%" colspan="4"  style="text-align:left">
                <strong>65f Total Outstanding Balance</strong> <em>(Add lines 65a through 65e and amounts from any attachments)</em>
            </td>
            <td width="20%" style="text-align:left"><strong>$<span class="parrafo">{{number_format($totalCompanyAccountReceivable,2)}}</span></strong></td>
        </tr>
    </table>

    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 15px; ; text-align: center; font-size: 10px" >
        <tr>
            <td >Catalog Number 20312N</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-A</strong> (Rev. 7-2022)</td>
        </tr>
    </table>
    <!-- Eliminar br si es necesario por la informacion que se rellene en la tabla de la pagina 4 -->
    <br><br><br><br> <br><br><br><br>  <br><br><br><br>  <br><br><br><br>  <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <br><br><br><br> <br><br><br><br> <br><br><br><br>
    <!-- Pagina 6 -->

    <table style="font-size: 9px;">
        <tr>
            <td width="95%">Form 433-A (Rev. 7-2022)</td>
            <td width="5%">Page <strong style=" font-size: 12px">6</strong></td>
        </tr>
    </table>
     
    <table border="1" width="100%" style="font-size: 11px;">
        <tr>
            <td colspan="5" style="text-align: center; border-top: 1px solid #000">
                <strong>BUSINESS ASSETS</strong>Include all tools, books, machinery, equipment, inventory or other assets used in trade or business. Include a list and show the
                value of all intangible assets such as licenses, patents, domain names, copyrights, trademarks, mining claims, etc.
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px; text-align: center">
        <tr>
            <td  width="28%"></td>
            <td  width="12%">Purchase Date <br> <em>( mmddyyyy )</em></td>
            <td  width="12%">Current Fair <br>Market Value <br>(FMV)</td>
            <td  width="12%">Current Loan <br>Balance</td>
            <td  width="12%">Amount of <br>Monthly Payment</td>
            <td  width="12%">Date of Final <br>Payment <br> <em>(mmddyyyy)</em></td>
            <td  width="12%"><strong>Equity</strong><br>FMV Minus Loan</td>
        </tr>
        @php
            $contadorToolEquipment    = 0;
            $totalToolEquipment       = 0;
        @endphp

        @foreach($companyToolEquipments as $companyToolEquipment)

            @php
                $equity = $companyToolEquipment->current_value - $companyToolEquipment->current_loan_balance;
            @endphp
            <tr style="text-align: left">
                <td  width="28%">
                    <strong>66{{ chr(97 + $loop->index) }} </strong>Property Description <br>
                    <span class="parrafo">{{$companyToolEquipment->description}}</span>
                </td>
                <td  width="12%"><span class="parrafo">{{$companyToolEquipment->purchase_date}}</span></td>
                <td  width="12%"><br>$<span class="parrafo">{{ number_format($companyToolEquipment->current_value,2) }}</span></td>
                <td  width="12%"><br>$<span class="parrafo">{{ number_format($companyToolEquipment->current_loan_balance,2) }}</span></td>
                <td  width="12%"><br>$<span class="parrafo">{{$companyToolEquipment->monthly_payment}}</span></td>
                <td  width="12%"><span class="parrafo">{{$companyToolEquipment->date_of_final_payment}}</span></td>
                <td  width="12%"><br>$<span class="parrafo">{{ number_format($equity,2) }}</span></td>
            </tr>
            <tr>
                <td  width="28%" colspan="3">
                    Location <em>(street, city, state, ZIP code, county and country)</em> <br>
                    <span class="parrafo">{{$companyToolEquipment->street_address.' '.$companyToolEquipment->city_state_zip}}</span>
                </td>
                <td  width="72%" colspan="4">
                    Lender/Contract Holder Name, Address (street, city, state, ZIP code), and Phone
                    <br>
                    <span class="parrafo">{{$companyToolEquipment->lender.' '.$companyToolEquipment->lender_address.' '.$companyToolEquipment->lender_city_state_zip}}</span>
                    <br>Phone <span class="parrafo">{{$companyToolEquipment->lender_phone}}</span>
                </td>
            </tr>
            @php
                $contadorToolEquipment    += 1;
                $totalToolEquipment       += $equity;
            @endphp
        @endforeach
        @if($contadorToolEquipment < 2)
            @for($i=$contadorToolEquipment; $i< 2; $i++)
                <tr style="text-align: left">
                    <td  width="28%">
                        <strong>66{{ chr(97 + $i) }} </strong>Property Description <br>
                        xx
                    </td>
                    <td  width="12%"></td>
                    <td  width="12%"><br>$</td>
                    <td  width="12%"><br>$</td>
                    <td  width="12%"><br>$</td>
                    <td  width="12%"></td>
                    <td  width="12%"><br>$</td>
                </tr>
            @endfor
        @endif
        <tr style="text-align: left">
            <td  width="72%" colspan="6">
                <strong>66c Total Equity </strong> <em>(Add lines 66a, 66b and amounts from any attachments)</em>
            </td>
            <td  width="28%" colspan="6">
                $<span class="parrafo">{{number_format($totalToolEquipment,2)}}</span>
            </td>
        </tr>
    </table>
    <table border="1" width="100%" style="font-size: 11px;">
        <tr>
            <td colspan="5" style="text-align: center; border-top: 1px solid #000; font-size: 13px;">
                <strong>Section 7 should be completed only if you are SELF-EMPLOYED</strong>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <div class="section-title">Section 7: Sole Proprietorship Information <em>(lines 67 through 87 should reconcile with business Profit and Loss Statement)</em> </div>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                Accounting Method Used: <div class="checkbox"></div> Cash <div class="checkbox"></div>Accrual <br>
                <em>Use the prior 3, 6, 9 or 12 month period to determine your typical business income and expenses</em>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>Income and Expenses during the period</strong> <em> (mmddyyyy) </em>
            </td>
            <td colspan="2"> <em>to (mmddyyyy)</em> </td>
        </tr>
        <tr>
            <td colspan="5">
                <em>Provide a breakdown below of your average monthly income and expenses, based on the period of time used above</em>
            </td>
        </tr>
    </table>
    <table border="1" width="100%" style="font-size: 11px;">
        <tr style="text-align: center">
            <td colspan="2" >
                <strong>Total Monthly Business Income </strong> <br> <em>(Amounts reported in U.S. dollars)</em>
            </td>
            <td colspan="2" >
                <strong>Total Monthly Business Expenses </strong>  <br><em>(Amounts reported in U.S. dollars)</em>(Use attachments as needed)
            </td>
        </tr>
        <tr style="text-align: center">
            <td >Source</td>
            <td >Gross Monthly</td>
            <td >Expense Items <sup>6</sup></td>
            <td >Actual Monthly</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>67 </strong> Gross Receipts</td>
            <td>$</td>
            <td><strong>77</strong> Materials Purchased<sup>1</sup></td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>68 </strong> Gross Rental Income</td>
            <td>$</td>
            <td><strong>78</strong> Inventory Purchased<sup>2</sup></td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>69 </strong> Interest</td>
            <td>$</td>
            <td><strong>79</strong> Gross Wages & Salaries</td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>70 </strong> Dividends</td>
            <td>$</td>
            <td><strong>80</strong> Rent</td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>71 </strong> Cash Receipts not included in lines 67-70</td>
            <td>$</td>
            <td><strong>81</strong> Supplies<sup>3</sup></td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td>Other Income (Specify below)</td>
            <td>$</td>
            <td><strong>82</strong>  Utilities/Telephone<sup>4</sup></td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>72 </strong> </td>
            <td>$</td>
            <td><strong>83</strong> Vehicle Gasoline/Oil</td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>73 </strong> </td>
            <td>$</td>
            <td><strong>84</strong> Repairs & Maintenance</td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>74 </strong> </td>
            <td>$</td>
            <td><strong>85</strong> Insurance</td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>75 </strong> </td>
            <td>$</td>
            <td><strong>86</strong> Current Taxes<sup>5</sup></td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td><strong>76 </strong> Total Income (Add lines 67 through 75)</td>
            <td>$</td>
            <td><strong>87</strong> Other Expenses, including installment payments
            (Specify)</td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td colspan="2"></td>
            <td><strong>88</strong> Total Expenses (Add lines 77 through 87)</td>
            <td>$</td>
        </tr>
        <tr style="text-align: left">
            <td colspan="2"></td>
            <td><strong>89</strong> Net Business Income (Line 76 minus 88) <sup>6</sup></td>
            <td>$</td>
        </tr>
        <tr style="text-align: center">
            <td colspan="4">
                <strong>Enter the monthly net income amount from line 89 on line 23, section 5. If line 89 is a loss, enter "0" on line 23, section 5.
                Self-employed taxpayers must return to page 4 to sign the certification.</strong>
            </td>
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
                <strong>3 Supplies:</strong> : Supplies are items used in the business that are
                    consumed or used up within one year. This could be the cost of
                    books, office supplies, professional equipment, etc.
                <br>
                <strong>4 Utilities/Telephone:</strong> : Utilities include gas, electricity, water, oil, other
                    fuels, trash collection, telephone, cell phone and business internet.
            </td>
            <td width="50%">
                <strong>5 Current Taxes:</strong> : Real estate, excise, franchise, occupational, personal property, sales and employer’s portion of employment taxes. 
                <br>
                <strong>6 Net Business Income:</strong> : Net profit from Form 1040, Schedule C may
                    be used if duplicated deductions are eliminated (e.g., expenses for
                    business use of home already included in housing and utility
                    expenses on page 4). Deductions for depreciation and depletion on
                    Schedule C are not cash expenses and must be added back to the
                    net income figure. In addition, interest cannot be deducted if it is
                    already included in any other installment payments allowed. 
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
            <td >Catalog Number 20312N</td>
            <td ><a href="https://www.irs.gov/" style="text-decoration: none;">www.irs.gov</a></td>
            <td >Form <strong style=" font-size: 12px">433-A</strong> (Rev. 7-2022)</td>
        </tr>
    </table>