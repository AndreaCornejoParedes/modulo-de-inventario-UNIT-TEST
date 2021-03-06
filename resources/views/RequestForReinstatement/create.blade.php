@extends('layouts.master')

@section('content')
<form action='{{ route("RequestForReinstatement.save") }}' method="POST" id="main_form" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Nueva Solicitud de Reposición</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Crear Nueva Solicitud de Reposición</h6>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        @foreach($nuevoCodigo as $data)
                        <label for="Codigo_reposicion">Codigo Reposición</label>
                        <input type="text" class="form-control" readonly name="Codigo_reposicion" id="Codigo_reposicion" value="{{ $data->Cod }}">
                        @endforeach
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Codigo_reposicion">Proveedor</label>
                        <select class="form-control selectpicker border" data-live-search="true" data-size="4" name="Proveedor" id="Proveedor" >
                            <option value="" selected hidden>Proveedor para la Solicitud</option>
                            @foreach($reinstatement as $data)
                            <option value="{{$data->Codigo_proveedor}}" data-tokens="{{$data->Codigo_proveedor}}">{{$data->Razon_social}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text Proveedor_error" ></span>                     
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Fecha</label>
                        <div class="input-group date" id="datepicker">
                            <input type="text"  class="form-control readonlyD" name="Fecha" id="Fecha" placeholder="Fecha de la Reposición" data-date-language="es" autocomplete="off">
                            <span class="input-group-append">
                                <span class="input-group-text bg-white">
                                    <i class="fa fa-calendar" style="color:blue;"></i>
                                </span>
                            </span>
                        </div>
                        <span class="text-danger error-text Fecha_error" ></span>                     
                    </div>
                </div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Requerimientos</h6>
            </div>
            <div class="card-body">
                <span id="result"></span>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="user_table">
                        <thead>
                            <tr>
                                <th width="18%">Numero de Parte</th>
                                <th width="15%">Cantidad</th>
                                <th width="10%">Prioridad</th>
                                <th width="28%">Observaciones</th>
                                <th width="22%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td>
                                @csrf
                                <input type="submit" name="save" id="save" class="btn btn-primary" value="Guardar" />
                                <input type="hidden" id="Confirmacion" name="Confirmacion" value="EnConfirmacion"/>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script src="{{asset('admin/vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<link href="{{asset('admin/vendor/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="{{asset('admin/vendor/datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('admin/vendor/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

<script>
    // Establecer parametros para el datepicker //
    $(function() {
        $('#Fecha').datepicker({
            format: "yyyy-mm-dd",
            startView: 1,
            language: "es",
            autoclose: true,
            todayHighlight: true
        });    
    });
</script>
<script>
    // Funcion para solo permitir numeros (0 a 9) //
    function onlyNumberKey(evt) {    
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
<script>
    // Script para no permitir escribir  //
    $(".readonlyD").on('keydown', function(e){
        if(e.keyCode != 9)
            e.preventDefault();
    });
</script>
<script>
    // Script permitir el ingreso de todos los requerimientos //
    var count = 1;
    var count2 = 1;
    $(document).ready(function(){
        dynamic_field(count, count2);
        function dynamic_field(number, numberF)
        {
            html = '<tr>';
            html += '<td><select class="form-control selectpicker border"  data-live-search="true" data-size="4" name="numParte[]" id="num'+numberF+'Parte" required>';
            html += '<option value="" selected hidden>Nro Parte</option>';
            html += '@foreach($materials as $data)';
            html += '<option value="{{$data->ID}}" data-tokens="{{$data->ID}}">{{$data->ID}}</option>';
            html += '@endforeach';
            html += '</select></td>';
            html += '<td><input type="text" id="num'+numberF+'Cant" name="cant[]" class="form-control" onkeypress="return onlyNumberKey(event)" autocomplete="off" style="width:50%; margin-left:15px;"/></td>';
            html += '<td><input type="hidden" name="prior[]" class="form-control" /><input type="checkbox" name="prior[]" class="form-control mt-1 ml-4" style="width:25px; height:25px;" value="1"/></td>';
            html += '<td><input type="text" name="observ[]" class="form-control" autocomplete="off"/></td>';
            if(number > 1)
            {
                html += '<td><button type="button" class="btn btn-success btn-icon-split btn-sm mr-1" name="add" id="add">';
                html += '<span class="icon text-white-50">';
                html += '<i class="fa fa-plus"></i></span>';
                html += '<span class="text">Agregar</span></button>';
                html += '<button type="button" class="btn btn-danger btn-icon-split btn-sm remove" name="remove" id="">';
                html += '<span class="icon text-white-50">';
                html += '<i class="fa fa-trash"></i></span>';
                html += '<span class="text">Remover</span></button></td></tr>';
                $('tbody').append(html);
            }
            else
            {   
                html += '<td><button type="button" class="btn btn-success btn-icon-split btn-sm" name="add" id="add">';
                html += '<span class="icon text-white-50">';
                html += '<i class="fa fa-plus"></i></span>';
                html += '<span class="text">Agregar</span></button></td></tr>';
                $('tbody').html(html);
            }
            $(function() {
                $('.selectpicker').selectpicker();
            });
        }
        function checkDuplicates() {
            var selects = document.getElementsByName("numParte[]"),
                i,
                current,
                selected = {};
            for(i = 0; i < selects.length; i++){
                current = selects[i].selectedIndex;
                if (selected[current]) {
                    return false;
                } else
                selected[current] = true;
            }
            return true;
        }
        $(document).on('click', '#add', function(){
            count++;
            count2++;
            dynamic_field(count, count2);
            $(function() {
                $('.selectpicker').selectpicker();
            });
        });
        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
        });

        $('#main_form').on('submit', function(event){
            event.preventDefault();       
            $.ajax({
                url:'{{ route("RequestForReinstatement.save") }}',
                method:'post',
                data:$(this).serialize(),
                dataType:'json',
                beforeSend:function(){
                    for(var c = 0; c <= count2; c++){
                        $('#num'+c+'Cant').css('border',"1px solid #d4daed");
                        $('#num'+c+'Cant').focusin(function () {
                        $(this).css({ 'box-shadow': '0 0 0 0.2rem rgba(78, 115, 223, 0.25)' }); 
                        });
                        $('#num'+c+'Cant').focusout(function () {
                        $(this).css({ 'box-shadow': 'bac8f3' });
                        });
                    }
                    $(document).find('span.error-text').text(' ');
                },
                success:function(data)
                {
                    if((data.status == 0) || (!(checkDuplicates())))
                    {
                        for(var c = 0; c <= count2; c++)
                        {
                            if($('#num'+c+'Cant').val() == ''){
                                $('#num'+c+'Cant').css('border',"0.12em solid red");
                                $('#num'+c+'Cant').focusin(function () {
                                    $(this).css({ 'box-shadow': '0 0 5px red' });
                                });
                                $('#num'+c+'Cant').focusout(function () {
                                    $(this).css({ 'box-shadow': '0 0 5px #f4f4f4 ' });
                                });
                            }
                        }
                        var error_html = '';
                        var can = 1;
                        $.each(data.error, function(prefix, val){
                            if((prefix.substring(0,4) == 'cant') && (can == 1)){
                                error_html += '<p style="margin:0;">- La <b>Cantidad</b> es un campo Requerido y Numerico</p>';
                                can = 0;
                            }
                            $('span.'+prefix+'_error').text(val[0]);
                        });
                        if((!(checkDuplicates()))){
                                error_html += '<p style="margin:0;">- El <b>Numero De Parte</b> esta siendo repetido</p>';
                        }
                        if((can == 0) || (!(checkDuplicates()))){
                            $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                        }else{
                            $('#result').html('');
                        }
                        $("html, body").animate({ scrollTop: 0 }, 800);
                    }else{
                        $('#result').html('');
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'La solicitud fue creada correctamente'
                        })
                        dynamic_field(1,1);
                        $("#main_form input").attr("readonly","readonly");
                        $('#main_form select').attr('disabled', false);
                        count = 1;
                        count2 = 1;
                        setTimeout(function () {
                            window.location=('{{ route("RequestForReinstatement.index") }}');
                        },3000);
                    }
                    $('#save').attr('disabled', false);
                }
            })
        });
    });
</script>
@endsection