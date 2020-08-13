@extends('layouts.layout')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{ route('payment.index') }}" class="btn btn-info">Regresar</a>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Verificar transacción</h3>
                            </div>
                            <div class="panel-body">
                              @if(is_object($data))
                                @foreach($data->{'WebServices_Transacciones'}->{'transaccion'} as $key =>$value)
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="pull-right">
                                                {{ $key}}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="pull-left">
                                                @if($key=='error'|| $key=='data' || $key=='dataVal')
                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                        @foreach ($value as $value2)
                                                            <div class="pull-left">
                                                                {{ print_r($value2) }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    {{ print_r($value) }}
                                                @endif

                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                            {{$data}}
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
