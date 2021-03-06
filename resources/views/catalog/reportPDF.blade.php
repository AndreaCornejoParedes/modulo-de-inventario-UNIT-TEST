<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Medicamentos</title>
    <style>
        th,td,tr{
            
        }
        #factura_detalle{
            border-collapse: collapse;
            text-align: center;
        }
        #factura_detalle thead th{
            background: #058167;
            color: #FFF;
            padding: 5px;
        }
        #materiales_de_catalogo tr:nth-child(even) {
            background: #ededed;
        }
        .page{
            width: 95%;
            margin: 15px auto 10px auto;
        }
        #factura_head, #factura_cliente, #factura_detalle{
            width: 100%;
            margin-bottom: 10px;
        }
        .cabec{
            width: 98%;
            margin-bottom: 10px;
            margin-left: 15px;
        }
        .catalogo{
            margin-left: 25px;

        }
    </style>
</head>
<body>
<div>
    <div class="">
        <div class="">
            <table class="cabec">
                <thead></thead>
                <tbody>
                    <th>
                    <td width="73%">
                            <strong>PROVIDENCIA E.I.R.L.</strong><br>
                            <strong>Razon social: PROVIDENCIA EMPRESA INDIVIDUAL <br>DE RESPONSABILIDAD LIMITADA </strong> <br>
                            Direccion: C. San Juan de Dios 315, Arequipa<br>
                            Teléfono: +51 999999999<br>
                            Email: consultas@providencia.com.pe <br>
                            Arequipa, Perú
                            <br>
                        </td>
                        <td>
                        <div class="">
                            <h1>PROVIDENCIA E.I.R.L.</h1>               
                        </div>
                        </td>
                    </th>
                    
                </tbody>
            </table>
            <div style="margin-bottom: 0px">&nbsp;</div>
            <div class="catalogo">
                <div class="">
                    @foreach($listCat as $data2)
                    <span><strong>Reporte de Medicamentos de Catalogo: {{$data2 ->ID_Catalogo}}</strong></span> <br>
                    <span>Ubicacion: {{$data2->Ubicacion}}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="page">
        <table id="factura_detalle">
            <thead>
                <tr>
                    <th width="17%">Numero de Parte</th>
                    <th width="15%">Codigo SAP</th>
                    <th width="40%">Descripcion</th>
                    <th width="17%">Unidad De Medida</th>
                    <th width="10%">Stock</th>
                    <th width="10%">Total</th>
                    <th width="10%">Cotizacion</th>
                </tr>
            </thead>
            <tbody id="materiales_de_catalogo">
                @foreach($materiales as $data)
                <tr>
                    <td>{{$data->ID}}</td>
                    <td>{{$data->Codigo_sap}}</td>
                    <td>{{$data->Descripcion}}</td>
                    <td>{{$data->Unidad_de_medida}}</td>
                    <td>{{$data->Stock}}</td>
                    <td>{{$data->Total}}</td>
                    <td>{{$data->Cotizacion}}</td>
                </tr>
                @endforeach
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>