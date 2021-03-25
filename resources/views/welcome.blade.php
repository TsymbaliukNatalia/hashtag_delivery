@extends('layouts.app')

@section('page_title')Головна сторінка@endsection

        
@include('inc.main_menu')

@section('content')

        <div class="container main_content">
            <div class="row">
                <div class="col-4 search_package_block">
                    <div>
                        <h2>Детальна інформація про вашу посилку:</h2>
                    </div>
                    <div>
                        <p>Дізнайтеся статус посилки та дату її прибуття</p>
                    </div>
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded search_package_input" placeholder="Введіть номер посилки" aria-label="Search" aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="col-1">

                </div>
                <div class="col-7 info_block">
                    <p class="baner_text"> Отримуйте посилки вчасно і за найнижчими цінами!</p>
                </div>
            </div>
        </div>
        @endsection