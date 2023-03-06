@extends('layouts.app')
{{--pachetele de cazare in functie de fiecare unitate de cazare--}}
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nume Unitate</th>
                <th scope="col">Etaj</th>
                <th scope="col">Camera</th>
                <th scope="col">Tip Camera</th>
            </tr>
            </thead>
            @foreach($result as $row)
                <tr>
                    <th scope="row">{{$row->NumeUnitate}}</th>
                    <td scope="row">{{$row->Etaj}}</td>
                    <td scope="row">{{$row->NumarCamera}}</td>
                    <td scope="row">{{$row->NumeTipCamere}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
