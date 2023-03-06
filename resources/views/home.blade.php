@extends('layouts.app')
{{--pagina principala--}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <a href = '/tables'>View Tables </a><br>
                        @if($userType == 'Admin')
                            <a href = '/edit'>Edit Tables </a><br>
                        @endif
                        <a href = '/Cazare+Pachete'>Pachete si Cazari</a><br>
                        <a href = '/UnitatiCazare'>Unitati Cazare</a><br>
                        <a href = '/Camere'>Camere in fiecare unitate</a><br>
                        <a href = '/Clienti'>Clienti+Unitati cazare</a><br>
                        <a href = '/StatisticiUnitati'>Statistici unitati cazare</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
