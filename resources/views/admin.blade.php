@extends('layouts.app')

@section('page_title')Робоче місце оператора@endsection

@include('inc.admin_menu')

@section('content')

        <div class="container main_content">
            <div class="row">
                <div class="col-8 form_package_box">
                    <form action="{{ route('pacckage_create_form') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone_sender">Телефон відправника</label>
                                <input type="phone" class="form-control" id="phone_sender" name="phone_sender" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="surname_sender">Прізвище відправника</label>
                                <input type="text" class="form-control" id="surname_sender" name="surname_sender" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name_sender">Ім`я відправника</label>
                                <input type="text" class="form-control" id="name_sender" name="name_sender" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middle_name_sender">По батькові відправника</label>
                                <input type="text" class="form-control" id="middle_name_sender" name="middle_name_sender" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone_recipient">Телефон отримувача</label>
                                <input type="phone" class="form-control" id="phone_recipient" name="phone_recipient" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-4">
                                <label for="surname_recipient">Прізвище отримувача</label>
                                <input type="phone" class="form-control" id="surname_recipient" name="surname_recipient" placeholder="">
                            </div>
                            <div class="form-group  col-md-4">
                                <label for="name_recipient">Ім`я отримувача</label>
                                <input type="phone" class="form-control" id="name_recipient" name="name_recipient" placeholder="">
                            </div>
                            <div class="form-group  col-md-4">
                                <label for="middle_name_recipient">По батькові отримувача</label>
                                <input type="phone" class="form-control" id="middle_name_recipient" name="middle_name_recipient" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city_recipient">Місто</label>
                                <select class="form-control" id="city_recipient" name="city_recipient">
                                    <option>Хмельницький</option>
                                    <option>Київ</option>
                                    <option>Львів</option>
                                    <option>Одеса</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="point_recipient">Відділення отримувача</label>
                                <select class="form-control" id="point_recipient" name="point_recipient">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="pacckage_width">Ширина(см)</label>
                                <input type="number" class="form-control" id="pacckage_width" name="pacckage_width" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pacckage_length">Довжина(см)</label>
                                <input type="number" class="form-control" id="pacckage_length" name="pacckage_length" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pacckage_heigth">Висота(см)</label>
                                <input type="number" class="form-control" id="pacckage_heigth" name="pacckage_heigth" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-md-6">
                                <label for="package_category">Категорія посилки</label>
                                <select class="form-control" id="package_category" name="package_category">
                                    <option>Побутові речі</option>
                                    <option>Скло</option>
                                    <option>Техніка</option>
                                    <option>Документи</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pacckage_cost">Оціночна вартість</label>
                                <input type="number" class="form-control" id="pacckage_cost" name="pacckage_cost" placeholder="">
                            </div>
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
                        <div class="form-group col-md-4">
                                <label for="pay_sum">До сплати:</label>
                                <p><input type="number" class="form-control" id="pay_sum" name="pay_sum" placeholder="">грн</p>
                        </div>
                        <div class="custom-control custom-checkbox form-group">
                            <input type="checkbox" class="custom-control-input" id="non-receipt_action" name="non-receipt_action" checked>
                            <label class="custom-control-label" for="non-receipt_action">В разі не отримання повернути відправнику:</label>
                        </div>
                        <button class="btn btn-primary" type="submit">Оформити посилку</button>
                    </form>

                </div>
            </div>
        </div>

@endsection
        