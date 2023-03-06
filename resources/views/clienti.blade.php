@extends('layouts.app')
{{--afisarea interogarilor legate de clienti si de pachetele de cazare--}}
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center"><h2>Lista clienti cu pachete de cazare</h2></div><br>
        <form class = "form-inline" action="/Clienti/search" method="POST">
            @csrf
            <input class = "form-control mr-sm-2" type="search" placeholder="Nume" name="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form><br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume</th>
                <th scope="col">Prenume</th>
                <th scope="col">Telefon</th>
                <th scope="col">Data sosire</th>
                <th scope="col">Nume pachet cazare</th>
                <th scope="col">Unitate Cazare</th>
            </tr>
            </thead>
            @foreach($result as $row)
                <tr>
                    <th scope="row">{{$row->Nume}}</th>
                    <td scope="row">{{$row->Prenume}}</td>
                    <td scope="row">{{$row->Telefon}}</td>
                    <td scope="row">{{$row->DataSosire}}</td>
                    <td scope="row">{{$row->NumePachet}}</td>
                    <td scope="row">{{$row->NumeUnitate}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="d-flex justify-content-center"><h2>Lista clienti/camere</h2></div><br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume</th>
                <th scope="col">Prenume</th>
                <th scope="col">Telefon</th>
                <th scope="col">Numar Persoane</th>
                <th scope="col">Numar Camera</th>
                <th scope="col">Etaj</th>
                <th scope="col">Tip camera</th>
            </tr>
            </thead>
            @foreach($info as $row)
                <tr>
                    <th scope="row">{{$row->Nume}}</th>
                    <td scope="row">{{$row->Prenume}}</td>
                    <td scope="row">{{$row->Telefon}}</td>
                    <td scope="row">{{$row->NumarPersoane}}</td>
                    <td scope="row">{{$row->NumarCamera}}</td>
                    <td scope="row">{{$row->Etaj}}</td>
                    <td scope="row">{{$row->NumeTipCamere}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
