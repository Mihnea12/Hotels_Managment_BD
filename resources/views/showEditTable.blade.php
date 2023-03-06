
@extends('layouts.app')

{{--Afisarea informatiilor in fiecare tabel din sectiunea EDIT--}}
@section('content')

    <div class="container-fluid">
        <div class="row">
            <h1>Edit</h1>
                <div class="table">
                    <div class="container-fluid  mr-0 ml-0">

                    @if(request()->is('edit/Camere'))

                            <div class="container-fluid mr-0 ml-0">
                                <span class="col ml-lg-4 mr-lg-5 pl-5">CameraID</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Etaj</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Numar camera</span>
                            </div>

                            @foreach($info as $row)
                                <form action="/edit/Camere/save" method="POST" class="tr">
                                    @csrf
                                    <span class="td"><input class="mb-5 mr-3" id="cameraid" name="CameraID" value="{{$row->CameraID}}"></span>
                                    <span class="td"><input class="mr-3"id="etaj" name="Etaj" value="{{$row->Etaj}}"></span>
                                    <span class="td"><input id="numarcamera" name="NumarCamera" value="{{$row->NumarCamera}}"><button type="submit" class="btn btn-primary ml-2">Save</button><button type="submit" formaction="/edit/Camere/delete"  class="btn btn-danger ml-2">Delete</button></span>
                                </form>
                            @endforeach

                            <a type="button" class="btn btn-secondary btn-lg" href="/edit/Camere/add">Add new row</a>
                    @endif
                    @if(request()->is('edit/CamereUnitate'))
                            <div class="container-fluid mr-0 ml-0">
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Nume Unitate</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Numar Camera</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Tip Camera</span>
                            </div>
                            @foreach($info as $row)
                                <form action="/edit/CamereUnitate/save" method="POST" class="tr">
                                    @csrf
                                    @foreach($info1 as $ex)
                                        @if($ex->UnitateID == $row->UnitateID)
                                            <span class="td"><input class="mb-5 mr-3" id="unitateid" name="UnitateID" value="{{$ex->NumeUnitate}}"></span>
                                        @endif
                                    @endforeach

                                    @foreach($info2 as $ex)
                                        @if($ex->CameraID == $row->CameraID)
                                            <span class="td"><input class="mr-3"id="cameraid" name="CameraID" value="{{$ex->NumarCamera}}"></span>
                                        @endif
                                    @endforeach
                                        <span class="td"><input id="numetipcamera" name="NumeTipCamera" value="{{$row->NumeTipCamere}}"><button type="submit" class="btn btn-primary ml-2">Save</button><button type="submit" formaction="/edit/CamereUnitate/delete"  class="btn btn-danger ml-2">Delete</button></span>
                                    </form>
                            @endforeach
                                <a type="button" class="btn btn-secondary btn-lg" href="/edit/CamereUnitate/add">Add new row</a>
                    @endif
                    @if(request()->is('edit/Clienti'))

                            <div class="container-fluid mr-0 ml-0">
                                <span class="col ml-lg-4 mr-lg-5 pl-5">ClientID</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Nume</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Prenume</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Adresa</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Localitate</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Telefon</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">RezervareID</span>
                            </div>

                            @foreach($info as $row)
                                <form action="/edit/Clienti/save" method="POST" class="tr">
                                    @csrf

                                    <span class="td"><input  id="clientid" name="ClientID" value="{{$row->ClientID}}"></span>
                                    <span class="td"><input  id="nume" name="Nume" value="{{$row->Nume}}"></span>
                                    <span class="td"><input id="prenume" name="Prenume" value="{{$row->Prenume}}"></span>
                                    <span class="td"><input id="adresa" name="Adresa" value="{{$row->Adresa}}"></span>
                                    <span class="td"><input id="localitate" name="Localitate" value="{{$row->Localitate}}"></span>
                                    <span class="td"><input id="telefon" name="Telefon" value="{{$row->Telefon}}"></span>
                                    <span class="td"><input id="rezervareid" name="RezervareID" value="{{$row->RezervareID}}"><button type="submit" class="btn btn-primary ml-2">Save</button><button type="submit" formaction="/edit/Clienti/delete"  class="btn btn-danger ml-2">Delete</button></span>

                                </form>
                            @endforeach
                                <a type="button" class="btn btn-secondary btn-lg" href="/edit/Clienti/add">Add new row</a>
                    @endif
                    @if(request()->is('edit/Rezervari'))
                            <div class="container-fluid mr-0 ml-0">
                                <span class="col ml-lg-4 mr-lg-5 pl-5">RezervareID</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Nume Pachet</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Data Rezervare</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Data Sosire</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Pret Total</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Avans</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Numar Camera</span>
                            </div>

                            @foreach($info as $row)
                                <form action="/edit/Rezervari/save" method="POST" class="tr">
                                    @csrf

                                    <span class="td"><input  id="rezervareid" name="RezervareID" value="{{$row->RezervareID}}"></span>

                                    @foreach($info3 as $ex)
                                        @if($ex->PachetID == $row->PachetID)
                                            <span class="td"><input  id="pachetid" name="PachetID" value="{{$ex->NumePachet}}"></span>
                                        @endif
                                    @endforeach
                                    <span class="td"><input id="datarezervare" name="DataRezervare" value="{{$row->DataRezervare}}"></span>
                                    <span class="td"><input id="datasosire" name="DataSosire" value="{{$row->DataSosire}}"></span>
                                    <span class="td"><input id="prettotal" name="PretTotal" value="{{$row->PretTotal}}"></span>
                                    <span class="td"><input id="avans" name="Avans" value="{{$row->Avans}}"></span>
                                    @foreach($info2 as $ex)
                                        @if($ex->CameraID == $row->CameraID)
                                            <span class="td"><input id="CameraID" name="CameraID" value="{{$ex->NumarCamera}}">
                                        @endif
                                    @endforeach
                                    </span><button type="submit" class="btn btn-primary ml-2">Save</button><button type="submit" formaction="/edit/Rezervari/delete"  class="btn btn-danger ml-2">Delete</button>

                                </form>
                            @endforeach
                                <a type="button" class="btn btn-secondary btn-lg" href="/edit/Rezervari/add">Add new row</a>
                    @endif
                    @if(request()->is('edit/TipUnitate'))
                            <div class="container-fluid mr-0 ml-0">
                                <span class="col ml-lg-4 mr-lg-5 pl-5">TipID</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Tip Unitate</span>
                            </div>

                            @foreach($info as $row)
                                <form action="/edit/TipUnitate/save" method="POST" class="tr">
                                    @csrf

                                    <span class="td"><input  id="tipid" name="TipID" value="{{$row->TipID}}"></span>
                                    <span class="td"><input  id="numetip" name="NumeTip" value="{{$row->NumeTip}}"><button type="submit" class="btn btn-primary ml-2">Save</button> <button type="submit" formaction="/edit/TipUnitate/delete"  class="btn btn-danger ml-2">Delete</button></span>


                                </form>
                            @endforeach
                                <a type="button" class="btn btn-secondary btn-lg" href="/edit/TipUnitate/add">Add new row</a>
                    @endif
                    @if(request()->is('edit/UnitateCazare'))
                            <div class="container-fluid mr-0 ml-0">
                                <span class="col ml-lg-4 mr-lg-5 pl-5">UnitateID</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Tip Unitate</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Nume unitate</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Adresa</span>
                                <span class="col ml-lg-4 mr-lg-5 pl-5">Cod Postal</span>
                            </div>

                            @foreach($info as $row)
                                <form action="/edit/UnitateCazare/save" method="POST" class="tr">
                                    @csrf

                                    <span class="td"><input  id="unitateid" name="UnitateID" value="{{$row->UnitateID}}"></span>

                                    @foreach($info4 as $ex)
                                        @if($ex->TipID == $row->TipUnitateID)
                                            <span class="td"><input  id="tipunitateid" name="TipUnitateID" value="{{$ex->NumeTip}}"></span>
                                        @endif
                                    @endforeach
                                    <span class="td"><input id="numeunitate" name="NumeUnitate" value="{{$row->NumeUnitate}}"></span>
                                    <span class="td"><input id="adresa" name="Adresa" value="{{$row->Adresa}}"></span>
                                    <span class="td"><input id="codpostal" name="CodPostal" value="{{$row->CodPostal}}"><button type="submit" class="btn btn-primary ml-2">Save</button><button type="submit" formaction="/edit/UnitateCazare/delete"  class="btn btn-danger ml-2">Delete</button></span>
                                </form>
                            @endforeach
                                <a type="button" class="btn btn-secondary btn-lg" href="/edit/UnitateCazare/add">Add new row</a>
                    @endif

                        @if(request()->is('edit/PachetRezervare'))

                            <div class="container-fluid mr-0 ml-0">
                                <span class="col ml-lg-3 mr-lg-3 pl-5">PachetID</span>
                                <span class="col ml-lg-3 mr-lg-5 pl-5">Nume Unitate</span>
                                <span class="col ml-lg-3 mr-lg-5 pl-5">Transport</span>
                                <span class="col ml-lg-3 mr-lg-5 pl-5">Numar Persoane</span>
                                <span class="col ml-lg-3 mr-lg-5 pl-5">Numar Nopti Cazare</span>
                                <span class="col ml-lg-3 mr-lg-5 pl-5">Pret/Noapte</span>
                                <span class="col ml-lg-3 mr-lg-5 pl-5">Nume Pachet</span>
                            </div>

                            @foreach($info as $row)
                                <form action="/edit/PachetRezervare/save" method="POST" class="tr">
                                    @csrf
                                    <span class="td"><input  id="pachetid" name="PachetID" value="{{$row->PachetID}}"></span>

                                    @foreach($info1 as $ex)
                                        @if($ex->UnitateID == $row->UnitateID)
                                            <span class="td"><input  id="unitateid" name="UnitateID" value="{{$ex->NumeUnitate}}"></span>
                                        @endif
                                    @endforeach


                                    <span class="td"><input id="transport" name="Transport" value="{{$row->Transport}}"></span>
                                    <span class="td"><input id="numarpersoane" name="NumarPersoane" value="{{$row->NumarPersoane}}"></span>
                                    <span class="td"><input id="numarnopticazare" name="NumarNoptiCazare" value="{{$row->NumarNoptiCazare}}"></span>
                                    <span class="td"><input id="pretnoapte" name="PretNoapte" value="{{$row->PretNoapte}}">
                                        <span class="td"><input  id="numepachet" name="NumePachet" value="{{$row->NumePachet}}"></span><button type="submit" class="btn btn-primary ml-2">Save</button><button type="submit" formaction="/edit/PachetRezervare/delete"  class="btn btn-danger ml-2">Delete</button></span>
                                </form>
                            @endforeach
                                <a type="button" class="btn btn-secondary btn-lg" href="/edit/PachetRezervare/add">Add new row</a>
                        @endif
                    </div>

                </div>
{{--                </form>--}}
    </div>
@endsection
