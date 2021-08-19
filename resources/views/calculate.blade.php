@extends('layouts.app')

@section('page_title')Головна сторінка@endsection

        
@include('inc.main_menu')

@section('content')

<div class="col-8 form_package_box">
<form action="{{ route('add_new_package') }}" method="post" id="form_new_package">
                @csrf
               
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city_recipient">Місто отримувача:</label>
                        <select class="form-control" id="city_recipient" name="city_recipient">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="point_recipient">Відділення отримувача:</label>
                        <select class="form-control" id="point_recipient" name="point_recipient">
                    
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="pacckage_width">Ширина(см)</label>
                        <input type="number" class="form-control" id="pacckage_width" name="pacckage_width" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="pacckage_length">Довжина(см)</label>
                        <input type="number" class="form-control" id="pacckage_length" name="pacckage_length" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="pacckage_heigth">Висота(см)</label>
                        <input type="number" class="form-control" id="pacckage_heigth" name="pacckage_heigth" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="pacckage_weight">Вага(кг)</label>
                        <input type="number" class="form-control" id="pacckage_weight" name="pacckage_weight" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="package_category">Категорія посилки:</label>
                        <select class="form-control" id="package_category" name="package_category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pacckage_cost">Оціночна вартість(грн)</label>
                        <input type="number" class="form-control" id="pacckage_cost" name="pacckage_cost" placeholder="">
                    </div>
                </div>
                <button class="btn btn-primary" type="button" id="calculate_cost" disabled>Розрахувати вартість</button>
                <div class="form-group col-md-4 pay_sum_block">
                    <p><label for="pay_sum">До сплати (грн):</label></p>
                    <p><input type="number" class="form-control" id="pay_sum" name="pay_sum"></p>
                </div>
            </form>

        </div>
    </div>
        @endsection