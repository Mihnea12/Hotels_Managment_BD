@extends('layouts.app')

{{--Afisarea interogarilor complexe in pagina--}}

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center"><h2>Lista cu unitatile care au apartamente disponibile</h2></div><br>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume unitate</th>
            </tr>
            </thead>
            @foreach($result as $row)
                <tr>
                    <th scope="row">{{$row->NumeUnitate}}</th>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="d-flex justify-content-center"><h2>Lista cu persoanele care nu au fost la hotel</h2></div><br>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume</th>
                <th scope="col">Prenume</th>
            </tr>
            </thead>
            @foreach($result1 as $row)
                <tr>
                    <th scope="row">{{$row->Nume}}</th>
                    <td scope="row">{{$row->Prenume}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <br>

    <div class="container">
        <div class="d-flex justify-content-center"><h2>Lista cu veniturile lunare pentru fiecare unitate </h2></div><br>
        <form class = "form-inline" action="/StatisticiUnitati/search" method="POST">
            @csrf
            <input class = "form-control mr-sm-2" type="search" placeholder="Luna" name="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume unitate</th>
                <th scope="col">Luna</th>
                <th scope="col">Castig lunar</th>
            </tr>
            </thead>
            @foreach($result2 as $row)
                <tr>
                    <th scope="row">{{$row->NumeUnitate}}</th>
                    <td scope="row">{{$row->Luna}}</td>
                    <td scope="row">{{$row->CastigLunar}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <br>

    <div class="container">
        <div class="d-flex justify-content-center"><h2>Unitatile de cazare care au cele mai multe camere pe un anumit etaj </h2></div><br>
        <form class = "form-inline" action="/StatisticiUnitati/search" method="POST">
            @csrf
            <input class = "form-control mr-sm-2" type="search" placeholder="Etaj" name="Search1">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume</th>
            </tr>
            </thead>
            @foreach($result3 as $row)
                <tr>
                    <th scope="row">{{$row->NumeUnitate}}</th>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <br>

    <div class="container">
        <div class="d-flex justify-content-center"><h2>Unitatile care au mai mult de 2 apartamente</h2></div><br>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume</th>
            </tr>
            </thead>
            @foreach($result4 as $row)
                <tr>
                    <th scope="row">{{$row->NumeUnitate}}</th>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <br>

@endsection
