@extends('template')
@section('content')
    <div id="app">
        <agenda-component  :user={{Auth::user()}} > </agenda-component>

    </div>

@endsection
