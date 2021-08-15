require('./bootstrap');


// присвоюємо токен для сторінки
// забезпечує можливість ajax-запитів до laravel
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// додаємо маски для вводу номерів телефону
$(document).ready(function(){
    Inputmask({"mask": "+380999999999"}).mask('#phone_sender');
    Inputmask({"mask": "+380999999999"}).mask('#phone_recipient');
    Inputmask({"mask": "+380999999999"}).mask('#phone');
    Inputmask({"mask": "999999"}).mask('#search_package');
});

// при натисканні 'enter' в полі '#phone_sender' відправляємо запит для пошуку клієнта по номеру телефону
$('#phone_sender').keydown(function(e){
    if (e.keyCode == 13) {
        let sender_phone = $('#phone_sender').val();
        ajaxGetInfoSender(sender_phone);   
    }
});

// при натисканні 'enter' в полі '#phone_recipient' відправляємо запит для пошуку клієнта по номеру телефону
$('#phone_recipient').keydown(function(e){
    if (e.keyCode == 13) {
        let recipient_phone = $('#phone_recipient').val();
        ajaxGetInfoRecipient(recipient_phone);   
    }
});


// при зміні міста підтягуємо його відділення
$('#city_recipient').change(function(e){
    let city = $('#city_recipient').val();
    ajaxGetCityPoints(city);
    
});

// підтягуємо міста з БД на сторінці "Відділення"
$('#city_list').change(function(e){
    let city = $('#city_list').val();
    ajaxGetCityPointsList(city);
    
});

// при натисканні кнопки "Оформити посилку" відправляємо запит на створення нової посилки
$('#add_new_package').click(function(e){
    $('#form_new_package').submit();
});

$('#search_package').keydown(function(e){
    if (e.keyCode == 13) {
        let package_number = $('#search_package').val();
        ajaxGetInfoPackage(package_number);   
    }
});
$('#search-addon').click(function(e){
    let package_number = $('#search_package').val();
    if(package_number.length == 6){
        ajaxGetInfoPackage(package_number);
    }   
});



$(function(){
    $("#city_recipient").trigger("change");
    $("#city_list").trigger("change");
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

$(document).ready(function (){
    if($('package_table')){
        ajaxGetUserPackages('receiver');
    }
    ajaxGetIncomingPackageCount('sender');
 });

 $('#customSwitches').change(function(e){
    let is_active = $('#customSwitches').prop('checked') ? 1 : 0;
    ajaxGetUserPackages('receiver', is_active);
    ajaxGetIncomingPackageCount('sender', is_active);
});
 

function ajaxGetInfoSender(sender_phone){
    $.ajax({
        type: "POST",
        url: 'sender_info',
        data: { phone_sender : sender_phone},
        // beforeSend: function (request){
        //     return request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        // },
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

// дістаємо відділення відповідно до вибраного міста для сторінки з новою посилкою
function ajaxGetCityPoints(city){
    $.ajax({
        type: "POST",
        url: 'get_points',
        data: { city : city},
        success: function (data) {
            console.log(data, city);
            $('#point_recipient').empty();
            data.forEach(function(point){
                $('#point_recipient').append("<option value="+ point['id'] + ">"+ point['name'] + ' - '+ point['adress'] +"</option>");
            });
        },
        error: function (data, textStatus, errorThrown) {
           
        },
    });
}

// дістаємо відділення відповідно до вибраного міста для пункту меню "Відділення"
function ajaxGetCityPointsList(city){
    $.ajax({
        type: "POST",
        url: 'get_points',
        data: { city : city},
        success: function (data) {
            $('.points_list').empty();
            data.forEach(function(point){
                $('.points_list').append("<li>"+ point['name'] + ' - '+ point['adress'] +"</li>");
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
           
        },
    });

}

function ajaxGetInfoPackage(package_number){
    $.ajax({
        type: "POST",
        url: 'get_package_info_number',
        data: { number : package_number},
        success: function (data) {
            $('#info_about_package').empty();
            $('#info_about_package').append("<p>Статус посилки - "+ data['status'] +"</p>");
            $('#info_about_package').append("<p>Орієнтовна дата прибуття - "+ data['date'] +"</p>");
        },
        error: function (data, textStatus, errorThrown) {
            $('#info_about_package').empty();
            $('#info_about_package').append("<p>Посилку не знайдено! Перевірте будь ласка правильність введеного номеру посилки!</p>");
        },
    });
}

// дістаємо всі посилки даного користувача по заданим критеріям
function ajaxGetUserPackages(individual, is_active = 0){
    $.ajax({
        type: "POST",
        url: "get_packages_for_user",
        data: {
            individual: individual,
            is_active : is_active
        },
        success: function (data) {
            $('.package_table tbody').empty();
            if($('.package_table') && data.length > 0){
                for(let i = 0; i < data.length; i++){
                    let price = data[i]['payment'] == 0 ? 0 : data[i]['price'];
                
                    let newRow = $("<tr></tr>")
                    .append(`<td>${data[i]['package_number']}</td>`)
                    .append(`<td>${data[i]['sender_surname']} ${data[i]['sender_name']} ${data[i]['sender_middle_name']}</td>`)
                    .append(`<td>${data[i]['sender_phone']}</td>`)
                    .append(`<td>${data[i]['city_to']}, ${data[i]['adress_to']}</td>`)
                    .append(`<td>${data[i]['weight']} кг </td>`)
                    .append(`<td>${data[i]['category']}</td>`)
                    .append(`<td>${data[i]['created_at']}</td>`)
                    .append(`<td>${price} грн</td>`)
                    .append(`<td>${data[i]['status']}</td>`)
                
                     $('.package_table tbody').append(newRow); 
                }
            }
        },
        error: function (data, textStatus, errorThrown) {
           
        },
    });
}

function ajaxGetIncomingPackageCount(individual, is_active = 0){
    $.ajax({
        type: "POST",
        url: 'get_packages_count',
        data: {
            individual: individual,
            is_active : is_active
        },
        success: function (data) {
           if(individual == 'sender'){
            $('#incoming_count').text(data);
           } else if (individual == 'receiver'){
            $('#sent_count').text(data);
           }
        },
        error: function (data, textStatus, errorThrown) {
            
        },
    });
}


