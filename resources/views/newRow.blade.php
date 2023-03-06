@extends('layouts.app')
{{--pagina pentru adaugarea unui noi rand in tabele in functie de url--}}
@section('content')
{{--camere--}}
    @if(request()->is('edit/Camere/add'))
        <form action="/edit/Camere/add/save" method="POST">
            @csrf
            <div class="form-group">
                <label>Etaj</label>
                <input name="Etaj">

            </div>
            <div class="form-group">
                <label >Numarul camerei</label>
                <input name="NumarCamera">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
{{--tipUnitate--}}
    @if(request()->is('edit/TipUnitate/add'))
        <form action="/edit/TipUnitate/add/save" method="POST">
            @csrf
            <div class="form-group">
                <label>Tip Unitate</label>
                <input name="NumeTip">

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
{{--UnitateCazare--}}
    @if(request()->is('edit/UnitateCazare/add'))
        <form action="/edit/UnitateCazare/add/save" method="POST">
            @csrf
            <div class="form-group">
                    <label>Tip unitate</label>
                    <select class="form-control col-sm-1" name="TipUnitate" id ="TipUnitate_id">
                        @foreach($info as $row)
                        <option>{{$row->NumeTip}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                <label>Nume Unitate</label>
                <input name="NumeUnitate">
            </div>
            <div class="form-group">
                <label>Adresa</label>
                <input name="Adresa">
            </div>
            <div class="form-group">
                <label>CodPostal</label>
                <input name="CodPostal">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
{{--Camere Unitate--}}
    @if(request()->is('edit/CamereUnitate/add'))
        <form action="/edit/CamereUnitate/add/save" method="POST">
            @csrf
            <div class="form-group">
                <label>Nume Unitate</label>
                <select class="form-control col-sm-1" name="UnitateID">
                    @foreach($infoCamereUnitateNume as $row)
                        <option>{{$row->NumeUnitate}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label>Numar camera</label>
                <select class="form-control col-sm-1" name="CameraID">
                    @foreach($infoCamereUnitateNumar as $row)
                        <option>{{$row->NumarCamera}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label>Nume Tip Camera</label>
                <input name="NumeTipCamere">

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
{{--Pachet Rezervare--}}
    @if(request()->is('edit/PachetRezervare/add'))
        <form action="/edit/PachetRezervare/add/save" method="POST">
            @csrf
            <div class="form-group">
                <label>Nume Unitate</label>
                <select class="form-control col-sm-1" name="NumeUnitate">
                    @foreach($infoNumeUnitate as $row)
                        <option>{{$row->NumeUnitate}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label>Transport</label>
                <input name="Transport">

            </div>
            <div class="form-group">
                <label>Numar persoane</label>
                <input name="NumarPersoane">

            </div>
            <div class="form-group">
                <label>Numar nopti cazare</label>
                <input name="NumarNoptiCazare">

            </div>

            <div class="form-group">
                <label>Pret/Noapte</label>
                <input name="PretNoapte">

            </div>

            <div class="form-group">
                <label>Nume Pachet </label>
                <input name="NumePachet">

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
{{--Rezervari--}}
    @if(request()->is('edit/Rezervari/add'))
        <form action="/edit/Rezervari/add/save" method="POST">
            @csrf
            <div class="form-group">

                <label>Nume Pachet</label>
                <select class="form-control col-sm-1" name="NumePachet">
                    @foreach($infoNumePachet as $row)
                        <option>{{$row->NumePachet}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label>Data Rezervare</label>
                <input name="DataRezervare">

            </div>
            <div class="form-group">
                <label>Data sosire</label>
                <input name="DataSosire">

            </div>
            <div class="form-group">
                <label>Data plecare</label>
                <input name="DataPlecare">

            </div>

            <div class="form-group">

                <label>Numar Camera</label>
                <select class="form-control col-sm-1" name="NumarCamera">
                    @foreach($infoNumarCamera as $row)
                        <option>{{$row->NumarCamera}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
{{--Clienti--}}
    @if(request()->is('edit/Clienti/add'))
        <form action="/edit/Clienti/add/save" method="POST">
            @csrf
            <div class="form-group">
                <label>Nume</label>
                <input name="Nume">

            </div>
            <div class="form-group">
                <label>Prenume</label>
                <input name="Prenume">

            </div>
            <div class="form-group">
                <label>Adresa</label>
                <input name="Adresa">

            </div>
            <div class="form-group">
                <label>Localitate</label>
                <input name="Localitate">

            </div>

            <div class="form-group">
                <label>Telefon</label>
                <input name="Telefon">

            </div>

            <div class="form-group">
                <label>Rezervare ID</label>
                <input name="RezervareID">

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
@endsection
