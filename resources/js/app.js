require('./bootstrap');


// присвоюємо токен для сторінки
// забезпечує можливість ajax-запитів до laravel
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    Inputmask({"mask": "+380999999999"}).mask('#phone_sender');
    Inputmask({"mask": "+380999999999"}).mask('#phone_recipient');
});

$('#phone_sender').keydown(function(e){
    if (e.keyCode == 13) {
        let sender_phone = $('#phone_sender').val();
        ajaxGetInfoSender(sender_phone);   
    }
});
$('#phone_recipient').keydown(function(e){
    if (e.keyCode == 13) {
        let recipient_phone = $('#phone_recipient').val();
        ajaxGetInfoRecipient(recipient_phone);   
    }
});

$('#city_recipient').change(function(e){
    let city = $('#city_recipient').val();
    ajaxGetCityPoints(city);
    
});

$(function(){
    $("#city_recipient").trigger("change");
});

// масив полів, заповненість яких потрібно перевіряти при розрахунку вартості доставки
let validateCostFields = ['#pacckage_width', '#pacckage_length', '#pacckage_heigth', '#pacckage_weight', '#pacckage_cost'];

// для кожного поля присвоюємо функцію валідації
validateCostFields.forEach(function(field){
    validateCalculateCostFields(field);
});

$('#calculate_cost').click(function(e){
    ajaxCalculateCostPackage();
});


function ajaxGetInfoSender(sender_phone){
    $.ajax({
        type: "POST",
        url: 'sender_info',
        data: { phone_sender : sender_phone},
        success: function (data) {
            $('.alert-danger').remove();
            $('.sender_info_box').css('display','flex');
            if(data["surname"]){
                $('#surname_sender').val(data["surname"]);
            }
            if(data["name"]){
                $('#name_sender').val(data["name"]);
            }
            if(data["middle_name"]){
                $('#middle_name_sender').val(data["middle_name"]);
            }
        },
        error: function (data, textStatus, errorThrown) {
            let resporse = data.responseJSON;
            let errors = resporse['errors']['phone_sender'];
            let $errorsDiv = $( '<div class="alert alert-danger"><ul></ul></div>');
            $errorsDiv.prependTo($("#create_package_box"));

            errors.forEach(function(element){
                $('.alert-danger').append('<li>'+element+'</li>');
            });
        },
    });

}

function ajaxGetInfoRecipient(recipient_phone){
    $.ajax({
        type: "POST",
        url: 'recipient_info',
        data: { phone_recipient : recipient_phone},
        success: function (data) {
            $('.alert-danger').remove();
            $('.recipient_info_box').css('display','flex');
            if(data["surname"]){
                $('#surname_recipient').val(data["surname"]);
            }
            if(data["name"]){
                $('#name_recipient').val(data["name"]);
            }
            if(data["middle_name"]){
                $('#middle_name_recipient').val(data["middle_name"]);
            }
        },
        error: function (data, textStatus, errorThrown) {
            let resporse = data.responseJSON;
            let errors = resporse['errors']['phone_recipient'];
            let $errorsDiv = $( '<div class="alert alert-danger"><ul></ul></div>');
            $errorsDiv.prependTo($("#create_package_box"));

            errors.forEach(function(element){
                $('.alert-danger').append('<li>'+element+'</li>');
            });
        },
    });

}

// дістаємо відділення відповідно до вибраного міста
function ajaxGetCityPoints(city){
    $.ajax({
        type: "POST",
        url: 'get_points',
        data: { city : city},
        success: function (data) {
            $('#point_recipient').empty();
            data.forEach(function(point){
                $('#point_recipient').append("<option>"+ point['name'] + ' - '+ point['adress'] +"</option>");
            });
        },
        error: function (data, textStatus, errorThrown) {
           
        },
    });
}

// функція перевіряє чи заповнені всі поля для розрахунку вартості доставки
// і вмикає або вимикає кнопку розрахунку доставки
function validateCalculateCostFields(field){
    $(field).change(function(e){
        if($('#pacckage_width').val() != "" &&  $('#pacckage_length').val() != "" &&  $('#pacckage_heigth').val() != "" &&  $('#pacckage_weight').val() != "" &&  $('#pacckage_cost').val() != "" ){
            $('#calculate_cost').prop('disabled', false);
        } else{
            $('#calculate_cost').prop('disabled', true);
        }  
    });
}

function ajaxCalculateCostPackage(){
    let width = +($('#pacckage_width').val());
    let length = +($('#pacckage_length').val());
    let heigth = +($('#pacckage_heigth').val());
    let weight = +($('#pacckage_weight').val());
    let cost = +($('#pacckage_cost').val());
    $.ajax({
        type: "POST",
        url: 'calculate_package_cost',
        data: { width : width,
            length : length,
            heigth : heigth,
            weight : weight,
            cost : cost
        },
        success: function (data) {
            $('.pay_sum_block').css('display','block');
            $('#pay_sum').val(data);
        },
        error: function (data, textStatus, errorThrown) {
            // let resporse = data.responseJSON;
            // let errors = resporse['errors']['width'];
            // let $errorsDiv = $( '<div class="alert alert-danger"><ul></ul></div>');
            // $errorsDiv.prependTo($("#create_package_box"));

            // errors.forEach(function(element){
            //     $('.alert-danger').append('<li>'+element+'</li>');
            // });
        },
    });

}


