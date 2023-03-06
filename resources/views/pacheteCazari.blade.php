@extends('layouts.app')

@section('content')
    <div class="container">
        <form class = "form-inline" action="/Cazare+Pachete/search" method="POST">
            @csrf
            <input class = "form-control mr-sm-2" type="search" placeholder="Nume" name="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume Pachet</th>
                <th scope="col">Pret/Noapte</th>
                <th scope="col">Unitate Cazare</th>
                <th scope="col">Adresa</th>
            </tr>
            </thead>
            @foreach($result as $row)
                <tr>
                    <th scope="row">{{$row->NumePachet}}</th>
                    <td scope="row">{{$row->PretNoapte}}</td>
                    <td scope="row">{{$row->NumeUnitate}}</td>
                    <td scope="row">{{$row->Adresa}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
