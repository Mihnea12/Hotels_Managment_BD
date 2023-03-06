@extends('layouts.app')

@section('content')
    <div class="container">
        <form class = "form-inline" action="/UnitatiCazare/search" method="POST">
            @csrf
            <input class = "form-control mr-sm-2" type="search" placeholder="TipUnitate" name="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume Unitate</th>
                <th scope="col">Adresa</th>
                <th scope="col">Tip Unitate</th>
            </tr>
            </thead>
            @foreach($result as $row)
                <tr>
                    <th scope="row">{{$row->NumeUnitate}}</th>
                    <td scope="row">{{$row->Adresa}}</td>
                    <td scope="row">{{$row->NumeTip}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
