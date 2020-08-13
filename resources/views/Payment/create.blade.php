@extends('layouts.layout')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-info">
                        {{Session::get('success')}}
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nueva transacción</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-container">
                            <form method="POST" action="{{ route('payment.store') }}" role="form">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <input type="text" name="name" id="name" class="form-control input-sm"
                                                   placeholder="Nombre del tarjetahabiente" maxlength="50"
                                                   value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                            <input type="text" name="last_name" id="last_name"
                                                   class="form-control input-sm" maxlength="50"
                                                   placeholder="Apellidos del tarjetahabiente"
                                                   value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                            <input type="text" name="card_number" id="card_number"
                                                   class="form-control input-sm" maxlength="16"
                                                   placeholder="Número del plástico de la tarjeta"
                                                   value="{{ old('card_number') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('cvt') ? ' has-error' : '' }}">
                                            <input type="text" name="cvt" id="cvt" class="form-control input-sm"
                                                   placeholder="Código de verificación de tarjeta" maxlength="4"
                                                   value="{{ old('cvt') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('cp') ? ' has-error' : '' }}">
                                            <input type="text" name="cp" id="cp" class="form-control input-sm"
                                                   placeholder="Código postal de la dirección donde vive el tarjetahabiente"
                                                   value="{{ old('cp') }}" maxlength="9" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('expiration_month') ? ' has-error' : '' }}">
                                            <input type="text" name="expiration_month" id="expiration_month"
                                                   class="form-control input-sm" maxlength="2"
                                                   placeholder="El mes en el cual el plástico expira MM"
                                                   value="{{ old('expiration_month') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('expiration_year') ? ' has-error' : '' }}">
                                            <input type="text" name="expiration_year" id="expiration_year"
                                                   class="form-control input-sm" maxlength="2"
                                                   placeholder="El año en el cual el plástico expira YY."
                                                   value="{{ old('expiration_year') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                            <input type="text" name="amount" id="amount" class="form-control input-sm"
                                                   placeholder="El monto (MXP) del cargo a la tarjeta."
                                                   value="{{ old('amount') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('id_branch_office') ? ' has-error' : '' }}">
                                            <select class=" form-control" id="id_branch_office" name="id_branch_office"
                                                    required="required">
                                                <option value="-1" selected="selected">Seleccione sucursal</option>
                                                <option value="2" @if (old('id_branch_office') == '2') selected="selected" @endif>Sucursal Pago facil</option>
                                                {{--@foreach($clientes as $clave => $cliente)
                                                    <option value="{{$cliente->id}}">{{$cliente->persona->nombre.' '.$cliente->persona->primer_apellido.' '.
                                          $cliente->persona->segundo_apellido}}</option>
                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('id_service') ? ' has-error' : '' }}">
                                            <select class=" form-control" id="id_service" name="id_service" required>
                                                <option value="-1" selected="selected">Seleccione servicio</option>
                                                <option value="2" @if (old('id_service') == '2') selected="selected" @endif>WebForm</option>
                                                <option value="3" @if (old('id_service') == '3') selected="selected" @endif>ThirdParty (ssl)</option>
                                                {{--@foreach($clientes as $clave => $cliente)
                                                    <option value="{{$cliente->id}}">{{$cliente->persona->nombre.' '.$cliente->persona->primer_apellido.' '.
                                          $cliente->persona->segundo_apellido}}</option>
                                                @endforeach--}}
                                            </select></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input type="email" name="email" id="email" class="form-control input-sm"
                                                   placeholder="Correo para enviar resumen de la transacción"
                                                   value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                            <input type="text" name="telephone" id="telephone"
                                                   class="form-control input-sm" maxlength="10"
                                                   placeholder="Teléfono del tarjetahabiente."
                                                   value="{{ old('telephone') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('cellular') ? ' has-error' : '' }}">
                                            <input type="text" name="cellular" id="cellular"
                                                   class="form-control input-sm" maxlength="10"
                                                   placeholder="celular del tarjetahabiente"
                                                   value="{{ old('cellular') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('streetnumber') ? ' has-error' : '' }}">
                                            <input type="text" name="streetnumber" id="streetnumber" class="form-control input-sm"
                                                   placeholder="calle y numero del tarjetahabiente" maxlength="45"
                                                   value="{{ old('streetnumber') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('suburb') ? ' has-error' : '' }}">
                                            <input type="text" name="suburb" id="suburb" class="form-control input-sm"
                                                   placeholder="Colonia del tarjetahabiente" maxlength="30"
                                                   value="{{ old('suburb') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('municipality') ? ' has-error' : '' }}">
                                            <input type="text" name="municipality" id="municipality"
                                                   class="form-control input-sm" maxlength="30"
                                                   placeholder="Municipio del tarjetahabiente"
                                                   value="{{ old('municipality') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                            <input type="text" name="state" id="state" class="form-control input-sm"
                                                   placeholder="Estado del tarjetahabiente" maxlength="30"
                                                   value="{{ old('state') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                            <input type="text" name="country" id="country"
                                                   class="form-control input-sm"
                                                   placeholder="País del tarjetahabiente" maxlength="50"
                                                   value="{{ old('country') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('param1') ? ' has-error' : '' }}">
                                            <input type="text" name="param1" id="param1"
                                                   class="form-control input-sm"
                                                   placeholder="Parámmetro 1" maxlength="60" value="{{ old('param1') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('param2') ? ' has-error' : '' }}">
                                            <input type="text" name="param2" id="param2" class="form-control input-sm"
                                                   placeholder="Parámmetro 2" maxlength="60" value="{{ old('param2') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('param3') ? ' has-error' : '' }}">
                                            <input type="text" name="param3" id="param3"
                                                   class="form-control input-sm"
                                                   placeholder="Parámmetro 3" maxlength="60" value="{{ old('param3') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('param4') ? ' has-error' : '' }}">
                                            <input type="text" name="param4" id="param4" class="form-control input-sm"
                                                   placeholder="Parámmetro 4" maxlength="60" value="{{ old('param4') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('param5') ? ' has-error' : '' }}">
                                            <input type="text" name="param5" id="param5"
                                                   class="form-control input-sm"
                                                   placeholder="Parámmetro 5" maxlength="60" value="{{ old('param5') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
                                            <select class=" form-control" id="plan" name="plan">
                                                <option value="-1" selected="selected">Seleccione el plan</option>
                                                <option value="MSI" @if (old('plan') == 'MSI') selected="selected" @endif>MSI (meses sin intereses)</option>
                                                <option value="NOR" @if (old('plan') == 'NOR') selected="selected" @endif> NOR (normal, en el caso que la transacción NO es en meses sin intereses)</option>
                                                {{--@foreach($clientes as $clave => $cliente)
                                                    <option value="{{$cliente->id}}">{{$cliente->persona->nombre.' '.$cliente->persona->primer_apellido.' '.
                                          $cliente->persona->segundo_apellido}}</option>
                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group{{ $errors->has('monthly_payments') ? ' has-error' : '' }}">
                                            <input type="text" name="monthly_payments" id="monthly_payments"
                                                   class="form-control input-sm" maxlength="2" value="{{ old('monthly_payments') }}"
                                                   placeholder="Mensualidades. Formato:##(2 caracteres numéricos, p.e. 03, 06, etc.)">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="method" id="method"
                                                   class="form-control input-sm" value="transaccion">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit" value="Guardar" class="btn btn-success btn-block">
                                        <a href="{{ route('payment.index') }}" class="btn btn-info btn-block">Atrás</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
@endsection
