@extends('layouts.app')

@section('page_title')Головна сторінка@endsection

        
@include('inc.main_menu')

@section('content')

<div class="col-8 form_package_box">
            <form action="" method="post" id="form_new_package">
                @csrf
                   
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city_list">Виберіть місто:</label>
                        <select class="form-control" id="city_list" name="city_list">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <select class="form-control col-md-6 points_list">
                        
                    </select>
                </div>
                
            </form>

        </div>
    </div>
        @endsection