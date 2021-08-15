@extends('layouts.app')

@section('page_title')Робоче місце оператора@endsection

@include('inc.operator_menu')

@section('content')


<div class="container main_content" id="create_package_box">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-8 form_package_box">
            <form action="{{ route('add_new_package') }}" method="post" id="form_new_package">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone_sender">Телефон відправника:</label>
                        <input type="text" class="form-control" id="phone_sender" name="phone_sender" value="">
                    </div>
                </div>
                <div class="form-row sender_info_box">
                    <div class="form-group col-md-4">
                        <label for="surname_sender">Прізвище відправника:</label>
                        <input type="text" class="form-control" id="surname_sender" name="surname_sender" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name_sender">Ім`я відправника:</label>
                        <input type="text" class="form-control" id="name_sender" name="name_sender" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="middle_name_sender">По батькові відправника:</label>
                        <input type="text" class="form-control" id="middle_name_sender" name="middle_name_sender" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone_recipient">Телефон отримувача:</label>
                        <input type="text" class="form-control" id="phone_recipient" name="phone_recipient" placeholder="">
                    </div>
                </div>
                <div class="form-row recipient_info_box">
                    <div class="form-group  col-md-4">
                        <label for="surname_recipient">Прізвище отримувача:</label>
                        <input type="text" class="form-control" id="surname_recipient" name="surname_recipient" placeholder="">
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="name_recipient">Ім`я отримувача:</label>
                        <input type="text" class="form-control" id="name_recipient" name="name_recipient" placeholder="">
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="middle_name_recipient">По батькові отримувача:</label>
                        <input type="text" class="form-control" id="middle_name_recipient" name="middle_name_recipient" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city_recipient">Місто отримувача:</label>
                        <select class="form-control" id="city_recipient" name="city_recipient">
                        <option>1</option>
                            @foreach($cities as $city)
                                <option>{{ $city->name }}</option>
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
                <p>Платник:</p>
                <div class="custom-control custom-radio custom-control-inline form-group">
                    <input type="radio" id="payer_sender" name="payer" class="custom-control-input" value="payer_sender" checked>
                    <label class="custom-control-label" for="payer_sender">Відправник</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline form-group">
                    <input type="radio" id="payer_recipient" name="payer" class="custom-control-input" value="payer_recipient">
                    <label class="custom-control-label" for="payer_recipient">Отримувач</label>
                </div>
                <div class="custom-control custom-checkbox form-group">
                    <input type="checkbox" class="custom-control-input" id="non-receipt_action" name="non-receipt_action" checked>
                    <label class="custom-control-label" for="non-receipt_action">В разі не отримання повернути відправнику:</label>
                </div>
                <button class="btn btn-primary" type="button" id="add_new_package">Оформити посилку</button>
            </form>

        </div>
    </div>
</div>

@endsection