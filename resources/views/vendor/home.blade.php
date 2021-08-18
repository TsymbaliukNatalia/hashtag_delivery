@extends('layouts.app')

@section('page_title')Особистий кабінет@endsection

@include('inc.main_menu')

@section('content')

<div class="wrapper">
    <div id="home_menu" class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom float-right">

        </nav>
    </div>
</div>
<div class="container">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 justify-content-end home_menu">

        <nav class="my-2 my-md-0 mr-md-3">
            <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#userModal" id="user-settings-button">
                Настройки профілю
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                </svg>
            </a>
            <a class="btn btn-primary" href="/vendor/logout" role="button">
                Вийти
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                </svg>
            </a>
        </nav>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Інформація про мене</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="user_info_modal_body">
                    <form id="change_user_info_form">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone_user">Телефон:</label>
                                <input type="text" class="form-control" id="phone_user" name="phone_user" value="">
                            </div>
                        </div>
                        <div class="form-row user_info_box">
                            <div class="form-group col-md-4">
                                <label for="surname_user">Прізвищe:</label>
                                <input type="text" class="form-control" id="surname_user" name="surname_user" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name_user">Ім`я:</label>
                                <input type="text" class="form-control" id="name_user" name="name_user" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middle_name_user">По батькові:</label>
                                <input type="text" class="form-control" id="middle_name_user" name="middle_name_user" placeholder="">
                            </div>
                        </div>
                        <div>
                            <p>Відділення за замовчуванням для отримання посилок: </p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city_user">Місто:</label>
                                <select class="form-control" id="city_user" name="city_user">

                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="point_user">Відділення:</label>
                                <select class="form-control points_list" id="point_user" name="point_user">

                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_change_info">Вийти без збереження</button>
                    <button type="button" class="btn btn-primary" id="change_info">Зберегти зміни</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body" id="user_info_modal_body">
                    <form id="filter_form">
                        <div>
                            <p>Одержувач: </p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone_filter">Телефон:</label>
                                <input type="text" class="form-control" id="phone_filter" name="phone_filter" value="">
                            </div>
                        </div>
                        <div class="form-row user_info_box">
                            <div class="form-group col-md-4">
                                <label for="surname_filter">Прізвищe:</label>
                                <input type="text" class="form-control" id="surname_filter" name="surname_filter" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name_filter">Ім`я:</label>
                                <input type="text" class="form-control" id="name_filter" name="name_filter" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middle_name_filter">По батькові:</label>
                                <input type="text" class="form-control" id="middle_name_filter" name="middle_name_filter" placeholder="">
                            </div>
                        </div>
                        <div>
                            <p>Відділення: </p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city_filter">Місто:</label>
                                <select class="form-control" id="city_filter" name="city_filter">
                                    <option selected value="">Виберіть місто</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="point_filter">Відділення:</label>
                                <select class="form-control points_list" id="point_filter" name="point_filter">
                                    <option selected value="">Виберіть відділення</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <p>Дата: </p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="dates_filter_start">З:</label>
                                <input type="date" class="form-control" id="dates_filter_start" name="date_start" placeholder="">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="dates_filter_end">По:</label>
                                <input type="date" class="form-control" id="dates_filter_end" name="date_end" placeholder="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_change_info">Відмінити</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="use_filter">Застосувати фільтри</button>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary no-active" id="package_on_info_button" data-toggle="modal" data-target=".bd-package-info-modal-xl"></button>

    <div class="modal fade bd-package-info-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myExtraLargeModalLabel">Інформація про посилку</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="info_about_no_user_package" class="">
                </div>
                <div class="card-body one_package_table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Номер ЕН</th>
                                <th scope="col">ПІБ відправника</th>
                                <th scope="col">Телефон відправника</th>
                                <th scope="col">Адреса відправки</th>
                                <th scope="col">ПІБ отримувача</th>
                                <th scope="col">Телефон отримувача</th>
                                <th scope="col">Адреса доставки</th>
                                <th scope="col">Вага</th>
                                <th scope="col">Категорія посилки</th>
                                <th scope="col">Дата створення</th>
                                <th scope="col">До сплати</th>
                                <th scope="col">Статус</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="row justify-content-center home_content_box">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <p class="big_text" id="incoming">Вхідні (<span id="incoming_count">0</span>)</p>
                </div>
                <div class="col-md-2">
                    <p class="big_text no_active_text" id="sent">Вихідні (<span id="sent_count">0</span>)</p>
                </div>
            </div>
            <div class="row">
                <div class="custom-control custom-switch switch_active col-md-2">
                    <input type="checkbox" class="custom-control-input" id="customSwitches">
                    <label class="custom-control-label" for="customSwitches">Тільки активні</label>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <button class="btn btn-primary" data-toggle="modal" id="filters" data-target="#filterModal">Фільтри</button>
                </div>
                <div class="input-group rounded float-right col-md-3">
                    <input type="search" class="form-control rounded search_package_home_input" id="search_package_user" placeholder="Введіть номер посилки" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </span>
                </div>


                <div class="card-body package_table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Номер ЕН</th>
                                <th scope="col" class="individual">ПІБ відправника</th>
                                <th scope="col" class="individual-phone">Телефон відправника</th>
                                <th scope="col">Номер відділення та адреса доставки</th>
                                <th scope="col">Вага</th>
                                <th scope="col">Категорія посилки</th>
                                <th scope="col">Дата створення</th>
                                <th scope="col">До сплати</th>
                                <th scope="col">Статус</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection