@extends('layouts.app')

@section('content')
    <Dashboard :vistorias="{{  $vistorias }}"  ></Dashboard>
@endsection
