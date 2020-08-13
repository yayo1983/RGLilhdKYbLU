@extends('layouts.layout')
@section('content')
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <a href="{{ route('payment.create') }}" class="btn btn-info" >Transacción</a>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('payment.show') }}" class="btn btn-info" >Verificar transacción</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-container">
                                    Trabajo con API REST de Pago facil
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </div>
@endsection
