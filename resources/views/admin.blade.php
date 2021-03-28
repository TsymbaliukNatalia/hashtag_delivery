@extends('layouts.app')

@section('page_title')Робоче місце оператора@endsection

@include('inc.admin_menu')

@section('content')

@if($res)
    <div class="alert alert-success">
        <p>Посилку успішно додано!</p>
    </div>
@else
    <div class="alert alert-danger">
        <p>Помилка! Посилку не додано!</p>
    </div>
@endif


@endsection