<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okacake - cetak</title>
    <style>
        body{
            font:11px/28px sans-serif;
        }
        table{
            border-collapse: collapse;
            font-size:12px;
        }

        #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                width: 100%;
            }

            #table td, #table th {
                border-top: 1px solid #4d4d4d;
            }

            #table th {
                text-align: left;
                background-color: #bdbdbd;
            }
            #table tr.tus td{
                border: none;
            }
            #table tr.tus td.ts{
                text-align: left;
                font-weight: bold;
                /*background-color: #bdbdbd;*/
            }
            #table tr.tus td.tf{
                border-bottom: 1px solid black;
                font-weight: bold;
            }
            #table tr.tus td.ta{
                font-weight: bold;
            }

        img{
            width: 100px;
            height: auto;
        }
        .tengah{
            margin: 0 auto;
            display: block;
        }
        #kop {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                border-bottom: 2px solid black;
            }
        table#kop tr td.desk{
            padding-left: 30px;
            width: 90%;
        }
            .jarak{
                display: block;
                height: 85px;
            }
        .judul{
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
        table.he tr td{
            font-weight: bold;
            padding-left:3px;
        }
        table#table tr th,td{
            height: 20px;
        }

        .isi{
            border-bottom:1px solid #4d4d4d;
        }
        .spasi{
            display: inline-block;
            width: 50px;
        }
        .sps{
            display: inline-block;
            width: 20px;
        }
        .kiri{
            display: inline-block;
            text-align: left;
            margin-right: 70px;
        }
        .kanan{
            text-align: left;
            display: inline-block;
        }
        .tebal{
            font-weight: bold;
        }
        .tr{
            text-align:right;
            padding-right: 5px;
        }
        .b{
            font-weight: bold;
        }
        td.tinggi{
            height: 50px;
        }
    </style>
    </head>
<body>
        <div class="tengah">
            <table id="kop">
                <tr style="line-height: 1.2">
                    <td><img src="{{ asset($toko->logo) }}"></td>
                    <td class="desk">
            <font size="6"> <b>{{ $toko->nama }}</b> </font>
                <br>
                            {{ $toko->alamat }}
                <br>        {{ $toko->kota }} | 
                    No.Telp: {{ $toko->no_hp }}
                <br>Email : {{ $toko->email }} | Fax :{{ $toko->fax }}</b>
                    </td></tr>
            </table>
        </div>
