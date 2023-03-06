@extends('layouts.app')

{{--afisarea tabelelor in sectiunea de view--}}

@section('content')
    <div class="container">
        <div class="row">
            <div class = "btn-group">
                <button type = "button" class="btn btn-primary dropdown-toggle "data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tabele
                </button>
                <div class="dropdown-menu">
                    @for($table = 0; $table < 7; $table++)
                    <a class="dropdown-item" href="/tables/{{$result[$table]}}">{{$result[$table]}}</a>
                    @endfor
            </div>
            </div>
            @if(Route::currentRouteName() == 'table')
            <table class="table">
                <tbody>
                @if(request()->is('tables/Camere'))
                    <thead>
                        <tr>
                            <th scope="col">CameraID</th>
                            <th scope="col">Etaj</th>
                            <th scope="col">Numar Camera</th>
                        </tr>
                    </thead>
                    @foreach($info as $row)
                    <tr>
                        <th scope="row">{{$row->CameraID}}</th>
                        <td scope="row">{{$row->Etaj}}</td>
                        <td scope="row">{{$row->NumarCamera}}</td>
                    </tr>
                @endforeach
                @endif
                @if(request()->is('tables/CamereUnitate'))
                    <thead>
                    <tr>
                        <th scope="col">Nume Unitate</th>
                        <th scope="col">Numar Camera</th>
                        <th scope="col">Tip Camera</th>
                    </tr>
                    </thead>
                    @foreach($info as $row)
                        <tr>
                            @foreach($info1 as $ex)
                                @if($ex->UnitateID == $row->UnitateID)
                                    <th scope="row">{{$ex->NumeUnitate}}</th>
                                @endif
                            @endforeach
                            @foreach($info2 as $ex)
                                    @if($ex->CameraID == $row->CameraID)
                                        <td scope="row">{{$ex->NumarCamera}}</td>
                                    @endif
                                @endforeach
                            <td scope="row">{{$row->NumeTipCamere}}</td>
                        </tr>
                    @endforeach
                @endif
                @if(request()->is('tables/Clienti'))
                    <thead>
                    <tr>
                        <th scope="col">ClientID</th>
                        <th scope="col">Nume</th>
                        <th scope="col">Prenume</th>
                        <th scope="col">Adresa</th>
                        <th scope="col">Localitate</th>
                        <th scope="col">Telefon</th>
                        <th scope="col">RezervareID</th>
                    </tr>
                    </thead>
                    @foreach($info as $row)
                        <tr>
                            <th scope="row">{{$row->ClientID}}</th>
                            <td scope="row">{{$row->Nume}}</td>
                            <td scope="row">{{$row->Prenume}}</td>
                            <td scope="row">{{$row->Adresa}}</td>
                            <td scope="row">{{$row->Localitate}}</td>
                            <td scope="row">{{$row->Telefon}}</td>
                            <td scope="row">{{$row->RezervareID}}</td>
                        </tr>
                    @endforeach
                @endif
                @if(request()->is('tables/PachetRezervare'))
                    <thead>
                    <tr>
                        <th scope="col">PachetID</th>
                        <th scope="col">Nume Unitate</th>
                        <th scope="col">Transport</th>
                        <th scope="col">Numar Persoane</th>
                        <th scope="col">Numar Nopti Cazare</th>
                        <th scope="col">Pret/Noapte</th>
                        <th scope="col">Nume Pachet</th>
                    </tr>
                    </thead>
                    @foreach($info as $row)
                        <tr>
                            <th scope="row">{{$row->PachetID}}</th>
                            @foreach($info1 as $ex)
                                @if($ex->UnitateID == $row->UnitateID)
                                    <td scope="row">{{$ex->NumeUnitate}}</td>
                                @endif
                            @endforeach
                            <td scope="row">{{$row->Transport}}</td>
                            <td scope="row">{{$row->NumarPersoane}}</td>
                            <td scope="row">{{$row->NumarNoptiCazare}}</td>
                            <td scope="row">{{$row->PretNoapte}}</td>
                            <td scope="row">{{$row->NumePachet}}</td>
                        </tr>s
                    @endforeach
                @endif
                @if(request()->is('tables/Rezervari'))
                    <thead>
                    <tr>
                        <th scope="col">RezervareID</th>
                        <th scope="col">Nume Pachet</th>
                        <th scope="col">Data Rezervare</th>
                        <th scope="col">Data Sosire</th>
                        <th scope="col">Pret Total</th>
                        <th scope="col">Avans</th>
                        <th scope="col">Numar Camera</th>
                    </tr>
                    </thead>
                    @foreach($info as $row)
                        <tr>
                            <th scope="row">{{$row->RezervareID}}</th>
                            @foreach($info3 as $ex)
                                @if($ex->PachetID == $row->PachetID)
                                    <td scope="row">{{$ex->NumePachet}}</td>
                                @endif
                            @endforeach
                            <td scope="row">{{$row->DataRezervare}}</td>
                            <td scope="row">{{$row->DataSosire}}</td>
                            <td scope="row">{{$row->PretTotal}}</td>
                            <td scope="row">{{$row->Avans}}</td>
                            @foreach($info2 as $ex)
                                @if($ex->CameraID == $row->CameraID)
                                    <td scope="row">{{$ex->NumarCamera}}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                @endif
                @if(request()->is('tables/TipUnitate'))
                    <thead>
                    <tr>
                        <th scope="col">TipID</th>
                        <th scope="col">Tip Unitate</th>
                    </tr>
                    </thead>
                    @foreach($info as $row)
                        <tr>
                            <th scope="row">{{$row->TipID}}</th>
                            <td scope="row">{{$row->NumeTip}}</td>
                        </tr>
                    @endforeach
                @endif
                @if(request()->is('tables/UnitateCazare'))
                    <thead>
                    <tr>
                        <th scope="col">UnitateID</th>
                        <th scope="col">Tip Unitate</th>
                        <th scope="col">Nume unitate</th>
                        <th scope="col">Adresa</th>
                        <th scope="col">Cod Postal</th>
                    </tr>
                    </thead>
                    @foreach($info as $row)
                        <tr>
                            <th scope="row">{{$row->UnitateID}}</th>
                            @foreach($info4 as $ex)
                                @if($ex->TipID == $row->TipUnitateID)
                                    <td scope="row">{{$ex->NumeTip}}</td>
                                @endif
                            @endforeach
                            <td scope="row">{{$row->NumeUnitate}}</td>
                            <td scope="row">{{$row->Adresa}}</td>
                            <td scope="row">{{$row->CodPostal}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
