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
                {{ trim($client->first_name . ' ' . $client->last_name) }}

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
                {{ trim($client->address_1 . ', ' . $client->city.', ' . $client->state.', ' . $client->zipcode) }}
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
                        <td>{{$dependent->name}}</td>
                        <td>{{$dependent->age}}</td>
                        <td>{{$dependent->relationship}}</td>
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
                            texto
                        </td>
                        <td>
                            <div class="input-box-title" ><strong>1d</strong> Home Phone</div>
                            {{ trim($client->phone_home) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-box-title" ><strong>1e</strong> Cell Phone</div>
                            {{ trim($client->cell_home) }}
                        </td>
                        <td>
                            <div class="input-box-title" ><strong>1f</strong> Work Phone</div>
                            {{ trim($client->phone_work) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>2a</strong> Marital Status: <div class="checkbox {{($client->marital_status == 1) ? 'checkbox-marked' : '' }}">
                                {{($client->marital_status == 1) ? 'x' : '' }}
                            </div> Married <div class="checkbox {{($client->marital_status == 2) ? 'checkbox-marked' : '' }}">
                                {{($client->marital_status == 2) ? 'x' : '' }}
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
                        <td>{{ trim($client->ssn) }}</td>
                        <td>{{ \Carbon\Carbon::parse($client->date_birdth)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Spouse</td>
                        <td>{{ trim($client->spouse_ssn) }}</td>
                        <td>{{ \Carbon\Carbon::parse($client->spouse_date_birdth)->format('d/m/Y') }}</td>
                    </tr>
                </table>
            </td>
            <td width="50%"  style="margin: 0 auto; padding: 0">
                <div class="input-box-title"><strong>3a</strong>   Do you or your spouse have any outside business interests? Include
                any interest in an LLC, LLP, corporation, partnership, etc.</div>
                <div class="checkbox"></div> Yes (percentage of ownership %) <div class="checkbox"></div> No <br>
                Title: 
                <table border="1" style=" margin: 0 auto">
                    <tr>
                        <td colspan="2">
                            <strong>3b</strong>  Business name <br>
                            texto ejemplo
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>3c</strong>  Type of business (select one) <br>
                            <div class="checkbox"></div> Partnership <div class="checkbox"></div> LLC  <div class="checkbox"></div> Corporation <div class="checkbox"></div> Sole Proprietorship <div class="checkbox"></div> 
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
                <div class="input-box-title"><strong>4a</strong> Taxpayer's Employer Name</div>
                texto
            </td>
            <td colspan="2">
                <div class="input-box-title"><strong>5a</strong> Spouse's Employer Name</div>
                texto
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="input-box-title"><strong>4b</strong> Address (street, city, state, ZIP code and country)</div>
                texto
            </td>
            <td colspan="2">
                <div class="input-box-title"><strong>5b</strong> Address (street, city, state, ZIP code and country)</div>
                texto
            </td>
        </tr>
        <tr>
            <td >
                <div class="input-box-title"><strong>4c</strong> Work Phone</div>
                123456789 
            </td>
            <td >
                <div class="input-box-title"><strong>4d</strong> Does employer allow contact at work</div>
                <div class="checkbox"></div> Yes <div class="checkbox"></div> No 
            </td>
            <td >
                <div class="input-box-title"><strong>5c</strong> Work Phone</div>
                123456789
            </td>
            <td >
                <div class="input-box-title"><strong>5d</strong> Does employer allow contact at work</div>
                <div class="checkbox"></div> Yes <div class="checkbox"></div> No 
            </td>
        </tr>
        <tr>
            <td >
                <div class="input-box-title"><strong>4e</strong> How long with this employer</div>
                xxxx <em>(Years)</em> | xxxx <em>(Months)</em>
            </td>
            <td >
                <div class="input-box-title"><strong>4f</strong> Occupation</div>
                text
            </td>
            <td >
                <div class="input-box-title"><strong>5e</strong> How long with this employer</div>
                xxxx <em>(Years)</em> | xxxx <em>(Months)</em>
            </td>
            <td >
                <div class="input-box-title"><strong>5f</strong> Occupation</div>
                text
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
                <div class="checkbox"></div> Weekly <div class="checkbox"></div> Bi-weekly <br>
                <div class="checkbox"></div> Monthly <div class="checkbox"></div> Other 
            </td>
            <td >
                <div class="input-box-title"><strong>5g</strong> Humber claimed as a dependent
                on your Form 1040</div>
                xxxx
            </td>
            <td >
                <div class="input-box-title"><strong>5h</strong> Pay Period</div>
                <div class="checkbox"></div> Weekly <div class="checkbox"></div> Bi-weekly <br>
                <div class="checkbox"></div> Monthly <div class="checkbox"></div> Other 
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
                <strong>6 Are you a party to a lawsuit</strong> <em>(If yes, answer the following)</em> <div class="checkbox"></div> Yes <div class="checkbox"></div> No
            </td>
        </tr>
        <tr>
            <td  style="text-align: center">
                <div class="checkbox"></div> Plaintiff <div class="checkbox"></div> defendant
            </td>
            <td>
                <div class="input-box-title">Location of Filing</div>
                text
            </td>
            <td>
                <div class="input-box-title">Represented by</div>
                text
            </td>
            <td>
                <div class="input-box-title">Dockent/case No.</div>
                text
            </td>
        </tr>
        <tr>
            <td  style="text-align: center">
                <div class="input-box-title">Amount of Suit</div>
                $  text
            </td>
            <td>
                <div class="input-box-title">Possible Completion Date <em>(mmddyyyy)</em></div>
                text
            </td>
            <td colspan ="2">
                <div class="input-box-title">Subject of Suit</div>
                text
            </td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center">
                <strong>7 Have you ever filed bankruptcy</strong> <em>(If yes, answer the following)</em> <div class="checkbox"></div> Yes <div class="checkbox"></div> No
            </td>
        </tr>
    </table>
    <table border="1" style="font-size: 11px;">
        <tr>
            <td>
                <div class="input-box-title">Date Filed <em>(mmddyyyy)</em></div>
                text
            </td>
            <td>
                <div class="input-box-title">Date Dismissed <em>(mmddyyyy)</em></div>
                text
            </td>
            <td>
                <div class="input-box-title">Date Discharged <em>(mmddyyyy)</em></div>
                text
            </td>
            <td>
                <div class="input-box-title">Peticion No.</div>
                text
            </td>
            <td>
                <div class="input-box-title">Location Filed</div>
                text
            </td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: center">
                <strong>8 In the past 10 years, have you lived outside of the U.S for 6 months or longer</strong> <em>(If yes, answer the following)</em> <div class="checkbox"></div> Yes <div class="checkbox"></div> No
            </td>
        </tr>
        <tr>
            <td colspan="3">
            Dates lived abroad: from <em>(mmddyyyy)</em>
            </td>
            <td colspan="2">
            to <em>(mmddyyyy)</em>
            </td>
        </tr>
        <tr>
            <td colspan="4" >
                <strong>9a Are you the beneficiary of a trust, estate, or life insurance policy including those located in foreign countries or
                jurisdictions</strong> <em>(If yes, answer the following)</em>
            </td>
            <td width="10%">
                <div class="checkbox"></div> Yes <div class="checkbox"></div> No
            </td>
        </tr>
        <tr>
            <td colspan="3" >
                Name of the trust:
            </td>
            <td width="10%">
                EIN:
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
                <div class="checkbox"></div> Yes <div class="checkbox"></div> No
            </td>
        </tr>
        <tr>
            <td colspan="3" >
                <div class="input-box-title">Location (Name, address and box number(s))</div>
                text
            </td>
            <td>
                <div class="input-box-title">Content</div>
                xxxx
            </td>
            <td >
            <div class="input-box-title">Value</div>
                $ xxxx
            </td>
        </tr>
        <tr>
            <td colspan="4" >
                <strong>11 In the past 10 years, have you transferred any assets with a fair market value of more than $10,000 including real
                property, for less than their full value</strong> <em>(If yes, answer the following)</em>
            </td>
            <td width="10%">
                <div class="checkbox"></div> Yes <div class="checkbox"></div> No
            </td>
        </tr>
        <tr>
            <td colspan="2" width="30%">
                <div class="input-box-title">List Asset(s)</div>
                text
            </td>
            <td width="20%">
                <div class="input-box-title">Value at Time of Transfer</div>
                $
            </td>
            <td width="20%">
                <div class="input-box-title">Date Transferred (mmddyyyy)</div>
                xxxx
            </td>
            <td width="30%">
            <div class="input-box-title">To Whom or Where was it Transferred</div>
                 xxxx
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

    <table border="1" style="font-size: 11px;">
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
    </table>
