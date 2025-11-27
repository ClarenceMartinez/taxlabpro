<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>f8821</title>
    <style>
        /* Estilos generales */
        @page {
            margin: 30px;
        }
        body {
            /*font-family: "Arial", "DejaVu Sans", sans-serif;*/
            font-family: Arial, Helvetica, sans-serif;
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
            font-weight: bold;
            border-bottom: 1px solid black;
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


        .page-container {
            margin: 10px auto;
            width: fit-content;
        }
        .page {
            overflow: hidden;
            position: relative;
            background-color: white;
        }
        .annotations-container {
            position: absolute;
            pointer-events: none;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 3;
        }
        .annotations-container > div {
            position: absolute; pointer-events: auto; -webkit-user-select: none;
        }
        .annotations-container > div:hover {
            background-color: rgba(255, 255, 0, 0.25);
            cursor: pointer;
        }


        .t {
          transform-origin: bottom left;
          z-index: 2;
          position: absolute;
          white-space: pre;
          overflow: visible;
          line-height: 1.5;
        }
        .text-container {
          white-space: pre;
        }
        @supports (-webkit-touch-callout: none) {
          .text-container {
            white-space: normal;
          }
        }





        @font-face {
  font-family: HelveticaNeueLTStd-BdIt_7x;
src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff");
}

@font-face {
  font-family: HelveticaNeueLTStd-Bd_7w;
src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff");
}

@font-face {
  font-family: HelveticaNeueLTStd-BlkCn_7u;
src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAAW4AAkAAAAACIwAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAApcAAAK1+IA2gE9TLzIAAAN4AAAAKgAAAGAJsQelY21hcAAAA6QAAABSAAABkgM8CZdoZWFkAAAD+AAAADMAAAA2+L23ymhoZWEAAAQsAAAAIAAAACQEcgBUaG10eAAABEwAAAAQAAAAEAUUAABtYXhwAAAEXAAAAAYAAAAGAAVQAG5hbWUAAARkAAABPQAAAq/j4fTCcG9zdAAABaQAAAATAAAAIP+GADZ4nD2QTUwTURSFZwqlVStqS41WUt7WUBCISDHRpFShBiwKxBBJ0OnMo30wnSlvfqCQLjQuEDWhZYG1iK2xURe4NCFxQVzhDhM1/kRIiJoYFiyMvoFHotONd3Nvzj335MtlmXILw7JsdQiKOlQRz4WhBrv6elWhrk0cCUrXWrTS3mscYw1XOW2lEzvrO9et5N0B8vXQe+Ov06h2uBkLy/74FZQTSYyiMRU0trY2+EBTQ0MTCAhyBILepKLCuAIuSLyMEzLmVCjUg4Aogp7SgQJ6oAKxXhL/gwCkAA6omBNgnMMjQB4yd0iAYgTiKMTgHNb4kTin8DEkQQkEOnwAjvOipiAdikkgIh5KChSAGsOyFo2BLiTJajIBzSGCOZwEHfFIyAc4SQBxLglMSgyjyOTE5hGSAA+xypl9WMNIERCvIllS6k+09/aVQk4CAQ4xZrGMk3ExRxmr+UfGwpQzdcwUW1UJKkldXjd0YieWMZZ0knCZYT283U89NqV5QKUV03ZqJ55d3WYa7xBg9BM7+4S0bZlGMmDE3M9tX4rZ4rOF8e4rqUQ06qUHqdN62o8bj3uMIQLoVEUm/zifyxHLnyPLyy9WNj2/uQ0arr2scMiLuJuXptvsZnTKBIDEgnUSJ3bnAgnTAAltkpDZwq4lcj/lJr5vr0jw8/DqqQc192yul2uPCitvPMTa+ZH6qb/zLLVeLITXxry3ba6lMzf4ULOHBr9fJbVe14cB46F7tZArFguT7ee1ydFRLffW6/p0iy671/L5xcW87m/RdYT0/Lq3MpXdHszS7iypyVaQYmYjs/t61jYxvz04T4fn7Kayldn9ObeHePaS0D5iSc/MzKbTaYeDgKfp0rD/rqPSmK8yytz/AFhnIWUAeJxjYGa8wjiBgZWBgSENCBnQaUY4YMAGHEAEs8J/CxDJcAJTAQB5RgZiAAB4nGNgYGBmgGAZBkYGEOgB8kCsEAYWBgsgzcXAwcAEhAoMRgwW///+/w8UU2AwhLD/P/x/8f8ZqA4YIFcfAyMbA6oAFoAhz8QMtXR4AAAq6R7KAAB4nGNgZGBgAOKNG9bviue3+crAwPwCKMJwmnEXA4z+H/1fisWb+QyQy87ABBIFAGB2C/0AeJxjYGRgYFb4b8HAwMTxP/q/AOMXBqAICmAGAHNQBMgCCAAAAQQAAAIIAAAAAAAAAABQAAAFAAB4nJ2PvWoCQRSFz/gHSSBlmhRuG4KiFgopElAREV0WXWxl2R114joj665glSp93iOQLk+RJ8lb5CwOKS0cmMs35557hgvgFl8QOJ0q74kF7vk6cQFlPFku4hEvlkv0vFou4wbvlivUP+gUpSu+nvFpWaCNX8sFXIuq5SLm4sFyCW3xZrmMO/FtuUL9xzVOaHbHRK3WqaP00iTbIFVGO0uT6ag+lPFBpioMXJnJsT9Lo1o33vT0opNNzTbQI09GQex4/UFr6E/Gzhn/mdZcJvv8z2a9ccYFFwYOQtYdjkigsMIaKTUFjSX1BFsEVBRZU8+1jBShjiEkYhxY835In0vOeMfwMaMaoYYuPRv0OLNAh90pE/JMjRE8eiNyzGQPfQzQYqqPCROcC/Mvm5qzn2D/v2eT+zUuy/oD+CuFJwAAAHicY2BmAIP/zQxmDFgAACiYAbwA) format("woff");
}

@font-face {
  font-family: HelveticaNeueLTStd-Roman_7t;
src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff");
}

@font-face {
  font-family: ITCFranklinGothicStd-Demi_7v;
src: url(data:application/font-woff;charset=utf-8;base64,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) format("woff");
}

@font-face {
  font-family: UniversalStd-NewswithCommPi_7r;
src: url(data:application/font-woff;charset=utf-8;base64,d09GRk9UVE8AAARwAAkAAAAAB4QAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABDRkYgAAAA4AAAAWkAAAG0EpgSq09TLzIAAAJMAAAAKgAAAGAJsQfFY21hcAAAAngAAAA/AAABcrSomhFoZWFkAAACuAAAADMAAAA2+O22/WhoZWEAAALsAAAAHwAAACQDHAMiaG10eAAAAwwAAAAIAAAACAPoAABtYXhwAAADFAAAAAYAAAAGAAJQAG5hbWUAAAMcAAABQAAAAtNBGjUIcG9zdAAABFwAAAATAAAAIP+GADZ4nH2Qzy8DQRTHZ6oqQSokIiF4N5EUVcSPW0OoRESUs0x3nt1hd6beTNUmji5SBzdx8Y/0D7PdJtg6OLq878vL9/vNJ4+zfI5xzhcvtbpHsiKsO7lyim3bVi7YN1F0pq62aWCZT+Z5MpN/6rfTu97rcDIzkcxOvid7U8nC+DQrZDWswIrsm4/zJb5claaBxxK1Uy7eN82YlB84WN/d2Sllc3erBJVyuQK/svHrhnpsHUYWjrVnqGlIOJSrUA1DOB+ELZyjRbofHP9wQVkQ4EhIjATdgrmGGiqJYQPJR4IDanm3kbBeoDRqqB6VAB+8sGWzfBhDqDzUFiW4gEzLD+BEaePiJmZLgwTFcBQ1aiUQWkIkYsgoCX2VcVIWUho8JCcyvWmRslJ5ThltV9cO6xeDkk2QeP3Pa/0yY4y/sBznubli+tinVPK3VA6lzc+P6S+ZPA5/yZFip9N77hT67c5Id7Q79gPRHZf3AAAAeJxjYGb8wjiBgZWBgSENCBnQaUY4YMAGHEAEs8J/CxDJcAJTAQCE5gaCAAB4nGNgYGBmgGAZBkYGEMgB8kAsFwYWBg0gzQakGRmYVLf9//v/PwMDhL7lDVUFAsSqY2BkY0BwRigAACEuFvgAeJxjYGRgYADijRvW74rnt/nKwMD8AijCcJpxFwOM/v/zvyzzXaY/QC47AxNIFAB0gQ1eAHicY2BkYGBW+G8BJF/8//n/PwMDA1AEBTABAJjmBkAAAAAAAAPoAAAAAFAAAAIAAHicpZBPTsJAGMXfQCFRE5cudS4AoWxYiC6EEEKANPxbmZCGFpiEzpBSaLiEW+Il3HoQT+EB3Puw45ZNO2n7+9733jeZAXCLDwhkzwPfjAXuWWVcQAlPlouo4sWyQ8/Wcgk3eLNcpv5Op3CuWD3j07JAEz+WC7gWruUiXsWjZQdNcbJcwp34slym/j00cmG2x1it1olUemniyE+U0XJp9jqoTrU6hPHO34yToDIM012qknXLRJGn5o14ZCJf97ww8DfSa3fq3cmgLy9HLndnbJ03d6u1y0YMYSCx4HeLI2IorLBGQk1BY0k9RgSfiiJr6mdtTwp43VP+FQ4I6drRtcGYzgAVzg2RUkvZTzixxVTE5bGeo0H/6E/xOaFHNWTqnJfkNjqoo4sJBuhTybNLnuzMpv5P7vLEtTwTfwGV7ZQ5eJxjYGYAg//NDGYMWAAAKJgBvAA=) format("woff");
}



    .s0{font-size:11px;font-family:HelveticaNeueLTStd-Roman_7t;color:#000;}
    .s1{font-size:37px;font-family:HelveticaNeueLTStd-BlkCn_7u;color:#000;}
    .s2{font-size:21px;font-family:ITCFranklinGothicStd-Demi_7v;color:#000;}
    .s3{font-size:9px;font-family:UniversalStd-NewswithCommPi_7r;color:#000;}
    .s4{font-size:12px;font-family:HelveticaNeueLTStd-Bd_7w;color:#000;}
    .s5{font-size:12px;font-family:HelveticaNeueLTStd-BdIt_7x;color:#000;}
    .s6{font-size:8px;font-family:HelveticaNeueLTStd-Roman_7t;color:#000;}
    .s7{font-size:9px;font-family:HelveticaNeueLTStd-Bd_7w;color:#000;}
    .s8{font-size:14px;font-family:HelveticaNeueLTStd-Bd_7w;color:#000;}
    .s9{font-size:14px;font-family:HelveticaNeueLTStd-Roman_7t;color:#000;}
    .sa{font-size:11px;font-family:UniversalStd-NewswithCommPi_7r;color:#000;}
    .sb{font-size:12px;font-family:HelveticaNeueLTStd-Roman_7t;color:#000;}
    .sc{font-size:15px;font-family:HelveticaNeueLTStd-Bd_7w;color:#000;}
    .t.v0{transform:scaleX(0.969);}
    .t.v1{transform:scaleX(0.94);}
    .t.v2{transform:scaleX(0.98);}
    </style>






</head>
<body>
<!-- Encabezado -->
    <table style="border-bottom: 2px solid #000;">
        <tr>
            <td width="18%" style="font-family: Helvetica, Arial, sans-serif; font-size: 9px; margin: 0; padding: 1px; border-right: 1px solid #000; line-height: 1.5;">
                Form <span style="font-size:35px; font-weight: bold; letter-spacing: -1px;" class="s1">8821</span>                    
                <br>
                (Rev. January 2021)
                <br>
                Department of the Treasury <br>
                Internal Revenue Service
            </td>
            <td width="62%" style="text-align: center;border-right: 1px solid #000;">
                <div style="font-size: 20px;font-weight: bold;">Tax Information Authorization</div>
                <div style="font-size: 9px; font-weight: bold;">
                    ▶ Go to www.irs.gov/Form8821 for instructions and the latest information.<br>
                    ▶ Don’t sign this form unless all applicable lines have been completed.<br>
                    ▶ Don’t use Form 8821 to request copies of your tax returns
                    or to authorize someone to represent you. See instructions.
                </div>
            </td>
            <td width="15%" style="">
                <div style="font-size: 8px;text-align: center; border-bottom: 1px solid #000">OMB No. 1545-1165</div>
                <div style="font-size: 9px;text-align: center; font-weight: bold">For IRS Use Only</div>
                <div style="font-size: 8px;">
                    Received by:<br>
                    Name: <br>
                    Telephone: <br>
                    Function: <br>
                    Date:
                </div>
            </td>
        </tr>
    </table>
    <table style="font-size: 11px;">
        <tr>
            <td colspan="2">
                <div class="section-title">1. Taxpayer information. <span style="font-weight: normal;">Taxpayer must sign and date this form on line 6.</span></div>
            </td>
        </tr>
    </table>
    <table style="font-size: 11px; ">
        <tr>
            <td width="60%" style="vertical-align: top;border-right: 1px solid black;">
                <div class="input-box-title" >Taxpayer name and address
                    <br>
                    Respuesta
                </div>
            </td>
            <td width="40%" >
                <div class="input-box-title">
                    Taxpayer identification number (TIN) <br>
                    Respuesta
                    <br>
                    Daytime telephone number: Respuesta<br>
                    Plan number (if applicable): Respuesta <br>
                </div>
            </td>
        </tr>
        <tr style="border-top: 1px solid black;">
            <td colspan="2">
                <div class="section-title">
                    2. Designee(s).
                    <span style="font-weight: normal;">If you wish to name more than two designees, attach a list to this form.</span>
                    <br>
                    Check here if a list of additional designees is attached ▶ <div class="checkbox-marked">X</div>
                </div>
            </td>
        </tr>
        <tr  style="border-bottom: 1px solid black;">
            <td width="50%" style="vertical-align: top;border-right: 1px solid black;">
                <div class="input-box-title" >Name and address
                    <br>
                    Respuesta
                </div>
                <span style="font-weight: bold;">Check if to be sent copies of notices and communications <div class="checkbox"></div> </span>
            </td>
            <td width="50%" >
                <div class="input-box-title">
                    CAF No.: <br>
                    PTIN: <br>
                    Telephone No.: <br>
                    Fax No.: <br>
                    Check if new: Address ▶ <div class="checkbox"></div> Telephone ▶ <div class="checkbox"></div> Fax ▶ <div class="checkbox"></div>
                </div>
            </td>
        </tr>
        <tr  style="border-bottom: 1px solid black;">
            <td width="50%" style="vertical-align: top;border-right: 1px solid black;">
                <div class="input-box-title" >Name and address
                    <br>
                    Respuesta
                </div>
                <span style="font-weight: bold;">Check if to be sent copies of notices and communications <div class="checkbox"></div> </span>
            </td>
            <td width="50%" >
                <div class="input-box-title">
                    CAF No.: <br>
                    PTIN: <br>
                    Telephone No.: <br>
                    Fax No.: <br>
                    Check if new: Address ▶ <div class="checkbox"></div> Telephone ▶ <div class="checkbox"></div> Fax ▶ <div class="checkbox"></div>
                </div>
            </td>
        </tr>
        <tr style="border-top: 1px solid black;">
            <td colspan="2">
                <div class="section-title">
                    3. Tax information.
                    <span style="font-weight: normal;">Each designee is authorized to inspect and/or receive confidential tax information for the type of tax, forms,
                    periods, and specific matters you list below. See the line 3 instructions.</span>
                    <br>
                    <div class="checkbox"></div> <span style="font-weight: normal;">By checking here, I authorize access to my IRS records via an Intermediate Service Provider.</span>
                </div>
            </td>
        </tr>
    </table>
    <table class="tax-table" style="font-size: 11px; ">
        <tr>
            <th width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                <span style="font-weight: bold;">(a)</span> <br>
                Type of Tax Information (Income,
                Employment, Payroll, Excise, Estate, Gift,
                Civil Penalty, Sec. 4980H Payments, etc.)
            </th>
            <th width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                <span style="font-weight: bold;">(b)</span> <br>
                Tax Form Number <br>
                (1040, 941, 720, etc.)
            </th>
            <th width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black;">
                <span style="font-weight: bold;">(c)</span>  <br>
                Year(s) or Period(s)
            </th>
            <th width="25%" style="border-bottom: 1px solid black;">
                <span style="font-weight: bold;">(d)</span> <br>
                Specific Tax Matters
            </th>
        </tr>
        <!-- aplica foreach  -->
        @for($i=0; $i < 3; $i++)
            <tr>
                <td style="border-bottom: 1px solid black;border-right: 1px solid black;">Respuesta</td>
                <td style="border-bottom: 1px solid black;border-right: 1px solid black;">Respuesta</td>
                <td style="border-bottom: 1px solid black;border-right: 1px solid black;">Respuesta</td>
                <td style="border-bottom: 1px solid black;">Respuesta</td>
            </tr>
        @endfor
        <tr >
            <td colspan="4">
                <div class="section-title">
                    4. Specific use not recorded on the Centralized Authorization File (CAF)..
                    <span style="font-weight: normal;">If the tax information authorization is for a
                    specific use not recorded on CAF, check this box. See the instructions. If you check this box, skip line 5 . . . . . . ▶</span>
                    <div class="checkbox"></div> <span style="font-weight: normal;">
                </div>
            </td>
        </tr>
        <tr >
            <td colspan="4">
                <div class="section-title">
                    5. Retention/revocation of prior tax information authorizations.
                    <span style="font-weight: normal;">If the line 4 box is checked, skip this line. If the line 4 box
                    isn’t checked, the IRS will automatically revoke all prior tax information authorizations on file unless you check the line 5
                    box and <strong>attach a copy</strong> of the tax information authorization(s) that you want to retain . . . . . . . . . . . . ▶</span>
                    <div class="checkbox"></div> <br>
                    <span style="font-weight: normal;"> To revoke a prior tax information authorization(s) without submitting a new authorization, see the line 5 instructions.</span>
                </div>
            </td>
        </tr>
        <tr >
            <td colspan="4">
                <div class="section-title" style="border-bottom: none;">
                    6. Taxpayer signature.
                    <span style="font-weight: normal;">If signed by a corporate officer, partner, guardian, partnership representative (or designated
                    individual, if applicable), executor, receiver, administrator, trustee, or individual other than the taxpayer, I certify that I have
                    the legal authority to execute this form with respect to the tax matters and tax periods shown on line 3 above.</span>
                    <div class="checkbox"></div> <br>
                    <span style="font-weight: normal;"> To revoke a prior tax information authorization(s) without submitting a new authorization, see the line 5 instructions.</span>

                    <br>
                    ▶ IF NOT COMPLETED, SIGNED, AND DATED, THIS TAX INFORMATION AUTHORIZATION WILL BE RETURNED.
                    <br>
                    ▶ DON’T SIGN THIS FORM IF IT IS BLANK OR INCOMPLETE.
                    <br>
                </div>
            </td>
        </tr>
    </table>
    <table style="font-size: 9px;margin-top: 20px">
        <tr>
            <td width="70%" style="border-right: 1px solid black;">
                <div class="input-box-title" style="height: 50px">Signature of taxpayer(s) <br>
                    <!-- <div style="border-bottom: 1px solid black; width: 50%; margin: 0 auto;"></div> -->
                </div>
            </td>
            <td width="30%" >
                <div class="input-box-title" style="height: 50px">
                    Date <br>
                    
                </div>
            </td>
        </tr>
        <tr style="border-top: 1px solid black;">
            <td width="70%" style="border-right: 1px solid black;">
                <div class="input-box-title" >Print Name <br>
                </div>
            </td>
            <td width="30%" >
                <div class="input-box-title">Title (if applicable) </div>
            </td>
        </tr>
    </table>
    <table width="98%" cellspacing="0"
        style="border-top: 3px solid #000;position: absolute; bottom: 25px; ; text-align: center" >
        <tr>
            <td >For Privacy Act and Paperwork Reduction Act Notice, see the instructions</td>
            <td >Cat. No. 11596P</td>
            <td >Form <strong class="title">8821</strong> (Rev. 01-2021)</td>
        </tr>
    </table>
</body>
</html>
