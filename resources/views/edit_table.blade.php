@extends('layouts.app')
{{--pagina pentru dropdown-ul din care se selecteaza tabela pentru edit--}}
@section('content')
    @if($userType == 'Admin')
    <div class="container">
        <div class="row">
            <div class = "btn-group">
                <button type = "button" class="btn btn-primary dropdown-toggle "data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tabele
                </button>
                <div class="dropdown-menu">
                    @for($table = 0; $table < 7; $table++)
                        <div class="container">
                        <a class = "btn btn-primary mb-3" href="/edit/{{$result[$table]}}" role="button">Edit {{$result[$table]}}</a>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
        @else
        <div class="container mt-5 ml-5"><h2>Nu ai acces la aceasta pagina!</h2></div>
    @endif
@endsection
