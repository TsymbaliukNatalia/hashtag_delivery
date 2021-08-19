require("./bootstrap");

// присвоюємо токен для сторінки
// забезпечує можливість ajax-запитів до laravel
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// додаємо маски для вводу номерів телефону та номерів посилок
$(document).ready(function() {
    let phone_id = [
        'phone_sender',
        'phone_recipient',
        'phone',
        'phone_user',
        'phone_filter'
    ];
    let package_number_id = [
        'search_package',
        'search_package_user'
    ];
    phone_id.forEach(function(id) {
        Inputmask({ mask: "+380999999999" }).mask(`${id}`);
    });
    package_number_id.forEach(function(id) {
        Inputmask({ mask: "999999" }).mask(`${id}`);
    });
});

// при натисканні 'enter' в полі '#phone_sender' відправляємо запит для пошуку клієнта по номеру телефону
$("#phone_sender").keydown(function(e) {
    if (e.keyCode == 13) {
        let sender_phone = $("#phone_sender").val();
        ajaxGetInfoSender(sender_phone);
    }
});

// при натисканні 'enter' в полі '#phone_recipient' відправляємо запит для пошуку клієнта по номеру телефону
$("#phone_recipient").keydown(function(e) {
    if (e.keyCode == 13) {
        let recipient_phone = $("#phone_recipient").val();
        ajaxGetInfoRecipient(recipient_phone);
    }
});

// при зміні міста підтягуємо його відділення
$("#city_recipient").change(function(e) {
    let city = $("#city_recipient").val();
    ajaxGetCityPoints(city);
});

// підтягуємо міста з БД на сторінці "Відділення"
$("#city_list").change(function(e) {
    let city = $("#city_list").val();
    ajaxGetCityPointsList(city);
});

// підтягуємо міста з БД для фільтрів
$("#city_filter").change(function(e) {
    let city = $("#city_filter").val();
    ajaxGetCityPointsList(city, true);
});

// при зміні міста підтягуємо відділення для вибраного міста
$("#city_user").change(function(e) {
    let city = $("#city_user").val();
    ajaxGetCityPointsList(city);
});

// при натисканні кнопки "Оформити посилку" відправляємо запит на створення нової посилки
$("#add_new_package").click(function(e) {
    $("#form_new_package").submit();
});

//підтягуємо інформацію про посилку по номеру на головній сторінці
$("#search_package").keydown(function(e) {
    if (e.keyCode == 13) {
        let package_number = $("#search_package").val();
        ajaxGetInfoPackage(package_number);
    }
});

//підтягуємо інформацію про посилку по номеру в кабінеті користувача
$("#search-addon").click(function(e) {
    let package_number = $("#search_package").val();
    if (package_number.length == 6) {
        ajaxGetInfoPackage(package_number);
    }
});

// при завантаженні сторінки підтягуємо відділення для вибраного міста
$(function() {
    $("#city_recipient").trigger("change");
    $("#city_list").trigger("change");
});

// масив полів, заповненість яких потрібно перевіряти при розрахунку вартості доставки
let validateCostFields = [
    "#pacckage_width",
    "#pacckage_length",
    "#pacckage_heigth",
    "#pacckage_weight",
    "#pacckage_cost",
];

// для кожного поля присвоюємо функцію валідації
validateCostFields.forEach(function(field) {
    validateCalculateCostFields(field);
});

// викликаємо функцію розрахунку вартості посилки для незареєстрованого користувача
$("#calculate_cost").click(function(e) {
    ajaxCalculateCostPackage();
});

// дії для кабінету користувача
if ($("#home_menu")) {
    //знаходимо посилки по замовчуванню
    let is_active = $("#customSwitches").prop("checked") ? 1 : 0;
    let individual = "receiver";
    $(document).ready(function() {
        if ($("package_table")) {
            ajaxGetUserPackages(individual);
        }
        ajaxPackageCount("sender", is_active);
        ajaxPackageCount("receiver", is_active);
    });

    //  знаходимо посилки відповідно до статусу активності
    $("#customSwitches").change(function(e) {
        is_active = $("#customSwitches").prop("checked") ? 1 : 0;
        ajaxGetUserPackages(individual, is_active);
        ajaxPackageCount("sender", is_active);
        ajaxPackageCount("receiver", is_active);
    });

    //вибір вихідних посилок
    $("#sent").click(function() {
        individual = "sender";
        toggleActivePackages(individual, is_active);
        $(".individual").text("ПІБ отримувача");
        $(".individual-phone").text("Телефон отримувача");
    });

    //вибір вхідних посилок
    $("#incoming").click(function() {
        individual = "receiver";
        toggleActivePackages(individual);
        $(".individual").text("ПІБ відправника");
        $(".individual-phone").text("Телефон відправника");
    });

    // отримуємо список міст для фільтру
    if ($("#filterModal")) {
        ajaxGetCities();
    }

    // застосовуємо вибрані фільтри
    $("#use_filter").click(function() {
        let filter_params = {};
        $("#filter_form")
            .find("input, select, date")
            .each(function() {
                filter_params[this.name] = $(this).val();
            });
        ajaxGetUserPackages(individual, (is_active = 0), filter_params);
    });

    // отримуємо інформацію про користувача в модалці
    $("#user-settings-button").click(function() {
        ajaxGetInfoUser();
    });

    // зберігаємо зміни даних про користувача
    $("#change_info").click(function() {
        let form = $("#change_user_info_form");
        ajaxChangeUserInfo(form);
    });

    // пошук даних про посилку за номером в кабінеті користувача
    $("#search_package_user").keydown(function(e) {
        if (e.keyCode == 13) {
            let package_number = $("#search_package_user").val();
            ajaxGetInfoAboutPackage(package_number);
            $("#package_on_info_button").trigger("click");
        }
    });
}

// отримуємо інформацію про відправника для створення посилки
function ajaxGetInfoSender(sender_phone) {
    $.ajax({
        type: "POST",
        url: "sender_info",
        data: { phone_sender: sender_phone },
        success: function(data) {
            $(".alert-danger").remove();
            $(".sender_info_box").css("display", "flex");
            if (data["surname"]) {
                $("#surname_sender").val(data["surname"]);
            }
            if (data["name"]) {
                $("#name_sender").val(data["name"]);
            }
            if (data["middle_name"]) {
                $("#middle_name_sender").val(data["middle_name"]);
            }
        },
        error: function(data, textStatus, errorThrown) {
            let resporse = data.responseJSON;
            let errors = resporse["errors"]["phone_sender"];
            let $errorsDiv = $(
                '<div class="alert alert-danger"><ul></ul></div>'
            );
            $errorsDiv.prependTo($("#create_package_box"));

            errors.forEach(function(element) {
                $(".alert-danger").append("<li>" + element + "</li>");
            });
        },
    });
}

// отримуємо інформацію про отримувача для створення посилки
function ajaxGetInfoRecipient(recipient_phone) {
    $.ajax({
        type: "POST",
        url: "recipient_info",
        data: { phone_recipient: recipient_phone },
        success: function(data) {
            $(".alert-danger").remove();
            $(".recipient_info_box").css("display", "flex");
            if (data["surname"]) {
                $("#surname_recipient").val(data["surname"]);
            }
            if (data["name"]) {
                $("#name_recipient").val(data["name"]);
            }
            if (data["middle_name"]) {
                $("#middle_name_recipient").val(data["middle_name"]);
            }
        },
        error: function(data, textStatus, errorThrown) {
            let resporse = data.responseJSON;
            let errors = resporse["errors"]["phone_recipient"];
            let $errorsDiv = $(
                '<div class="alert alert-danger"><ul></ul></div>'
            );
            $errorsDiv.prependTo($("#create_package_box"));

            errors.forEach(function(element) {
                $(".alert-danger").append("<li>" + element + "</li>");
            });
        },
    });
}

// дістаємо відділення відповідно до вибраного міста для сторінки з новою посилкою
function ajaxGetCityPoints(city) {
    $.ajax({
        type: "POST",
        url: "get_points",
        data: { city: city },
        success: function(data) {
            $("#point_recipient").empty();
            data.forEach(function(point) {
                $("#point_recipient").append(
                    "<option value=" +
                    point["id"] +
                    ">" +
                    point["name"] +
                    " - " +
                    point["adress"] +
                    "</option>"
                );
            });
        },
        error: function(data, textStatus, errorThrown) {},
    });
}

// дістаємо відділення відповідно до вибраного міста для пункту меню "Відділення"
function ajaxGetCityPointsList(city, filter = false) {
    $.ajax({
        type: "POST",
        url: "get_points",
        data: { city: city },
        success: function(data) {
            $(".points_list").empty();
            if (filter) {
                $(".points_list").append(
                    "<option selected>Виберіть відділення</option>"
                );
            }
            data.forEach(function(point) {
                $(".points_list").append(
                    '<option value="' +
                    point["id"] +
                    '">' +
                    point["name"] +
                    " - " +
                    point["adress"] +
                    "</option>"
                );
            });
        },
        error: function(data, textStatus, errorThrown) {},
    });
}

// функція перевіряє чи заповнені всі поля для розрахунку вартості доставки
// і вмикає або вимикає кнопку розрахунку доставки
function validateCalculateCostFields(field) {
    $(field).change(function(e) {
        if (
            $("#pacckage_width").val() != "" &&
            $("#pacckage_length").val() != "" &&
            $("#pacckage_heigth").val() != "" &&
            $("#pacckage_weight").val() != "" &&
            $("#pacckage_cost").val() != ""
        ) {
            $("#calculate_cost").prop("disabled", false);
        } else {
            $("#calculate_cost").prop("disabled", true);
        }
    });
}

// розраховуємо вартість посилки
function ajaxCalculateCostPackage() {
    let width = +$("#pacckage_width").val();
    let length = +$("#pacckage_length").val();
    let heigth = +$("#pacckage_heigth").val();
    let weight = +$("#pacckage_weight").val();
    let cost = +$("#pacckage_cost").val();
    $.ajax({
        type: "POST",
        url: "calculate_package_cost",
        data: {
            width: width,
            length: length,
            heigth: heigth,
            weight: weight,
            cost: cost,
        },
        success: function(data) {
            $(".pay_sum_block").css("display", "block");
            $("#pay_sum").val(data);
        },
        error: function(data, textStatus, errorThrown) {},
    });
}

// отримуємо дані про статус посилки і орієнтовну дату прибуття
function ajaxGetInfoPackage(package_number) {
    $.ajax({
        type: "POST",
        url: "get_package_info_number",
        data: { number: package_number },
        success: function(data) {
            $("#info_about_package").empty();
            $("#info_about_package").append(
                "<p>Статус посилки - " + data["status"] + "</p>"
            );
            $("#info_about_package").append(
                "<p>Орієнтовна дата прибуття - " + data["date"] + "</p>"
            );
        },
        error: function(data, textStatus, errorThrown) {
            $("#info_about_package").empty();
            $("#info_about_package").append(
                "<p>Посилку не знайдено! Перевірте будь ласка правильність введеного номеру посилки!</p>"
            );
        },
    });
}

// дістаємо всі посилки даного користувача по заданим критеріям
function ajaxGetUserPackages(individual, is_active = 0, filter_params = []) {
    $.ajax({
        type: "POST",
        url: "get_packages_for_user",
        data: {
            individual: individual,
            is_active: is_active,
            filter_params: filter_params,
        },
        success: function(data) {
            $(".package_table tbody").empty();
            if ($(".package_table") && data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    let price = data[i]["payment"] == 0 ? 0 : data[i]["price"];

                    let newRow = $("<tr></tr>")
                        .append(`<td>${data[i]["package_number"]}</td>`)
                        .append(
                            `<td>${data[i]["sender_surname"]} ${data[i]["sender_name"]} ${data[i]["sender_middle_name"]}</td>`
                        )
                        .append(`<td>${data[i]["sender_phone"]}</td>`)
                        .append(
                            `<td>${data[i]["city_to"]}, ${data[i]["adress_to"]}</td>`
                        )
                        .append(`<td>${data[i]["weight"]} кг </td>`)
                        .append(`<td>${data[i]["category"]}</td>`)
                        .append(`<td>${data[i]["created_at"]}</td>`)
                        .append(`<td class="price">${price} грн</td>`)
                        .append(`<td>${data[i]["status"]}</td>`);

                    $(".package_table tbody").append(newRow);
                }
            }
        },
        error: function(data, textStatus, errorThrown) {},
    });
}

//кількість посилок
function ajaxPackageCount(individual, is_active = 0) {
    $.ajax({
        type: "POST",
        url: "get_packages_count",
        data: {
            individual: individual,
            is_active: is_active,
        },
        success: function(data) {
            if (individual == "sender") {
                $("#sent_count").text(data);
            } else if (individual == "receiver") {
                $("#incoming_count").text(data);
            }
        },
        error: function(data, textStatus, errorThrown) {},
    });
}

// перемикаємо тип посилок
function toggleActivePackages(individual, is_active) {
    $("#incoming").toggleClass("no_active_text");
    $("#sent").toggleClass("no_active_text");
    ajaxGetUserPackages(individual, is_active);
}

// отримуємо інформацію про власника кабінету
function ajaxGetInfoUser() {
    $.ajax({
        type: "POST",
        url: "user_info",
        success: function(data) {
            if (data["user_info"]["phone"]) {
                $("#phone_user").val(data["user_info"]["phone"]);
            }
            if (data["user_info"]["surname"]) {
                $("#surname_user").val(data["user_info"]["surname"]);
            }
            if (data["user_info"]["name"]) {
                $("#name_user").val(data["user_info"]["name"]);
            }
            if (data["user_info"]["middle_name"]) {
                $("#middle_name_user").val(data["user_info"]["middle_name"]);
            }
            $("#city_user").empty();
            if (!data["user_info"]["point_default_id"] && !data["city_id"]) {
                $("#city_user").append(
                    "<option disabled selected>Виберiть місто</option>"
                );
                $("#point_user").append(
                    "<option disabled selected>Виберiть відділення</option>"
                );
            }
            data["points"].forEach(function(city) {
                $("#city_user").append(
                    '<option value="' +
                    city["id"] +
                    '">' +
                    city["name"] +
                    "</option>"
                );
            });
            if (data["city_id"]) {
                $(`#city_user option[value=${data["city_id"]}]`).prop(
                    "selected",
                    true
                );
                $("#city_user").trigger("change");
                setTimeout(function() {
                    $(
                        `#point_user option[value=${data["user_info"]["point_default_id"]}]`
                    ).prop("selected", true);
                }, 250);
            }
        },
        error: function(data, textStatus, errorThrown) {},
    });
}

// зберігаємо зміни в інформації про користувача
function ajaxChangeUserInfo(form) {
    $.ajax({
        type: "POST",
        url: "change_user",
        data: form.serialize(),
        success: function(data) {
            if (data["res"]) {
                $("#user_info_errors").remove();
                $("#cancel_change_info").trigger("click");
            }
        },
        error: function(data, textStatus, errorThrown) {
            let resporse = data.responseJSON;
            let errors = resporse["errors"];
            let $errorsDiv = $(
                '<div class="alert alert-danger" id="user_info_errors"><ul></ul></div>'
            );
            $errorsDiv.prependTo($("#user_info_modal_body"));
            $.each(errors, function(index, value) {
                $(".alert-danger").append("<li>" + value + "</li>");
            });
        },
    });
}

// виводимо ынформацыю по номеру посилки
function ajaxGetInfoAboutPackage(package_number) {
    $.ajax({
        type: "POST",
        url: "get_package_info_for_user",
        data: {
            package_number: package_number,
        },
        success: function(data) {
            $("#info_about_no_user_package").empty();
            $(".one_package_table tbody").empty();
            if (data["status"] == "no_package") {
                $("#info_about_no_user_package").show();
                $(".one_package_table").hide();
                $("#info_about_no_user_package").append(
                    "<p>Посилку не знайдено! Перевірте будь ласка правильність введеного номеру посилки!</p>"
                );
            }
            if (data["status"] == "short_info") {
                $("#info_about_no_user_package").show();
                $(".one_package_table").hide();
                $("#info_about_no_user_package").append(
                    "<p>Статус посилки - " +
                    data["short_info"]["status"] +
                    "</p>"
                );
                $("#info_about_no_user_package").append(
                    "<p>Орієнтовна дата прибуття - " +
                    data["short_info"]["date"] +
                    "</p>"
                );
            }
            if (data["status"] == "long_info") {
                $("#info_about_no_user_package").hide();
                $(".one_package_table").show();
                let price =
                    data["package"]["payment"] == 0 ?
                    0 :
                    data["package"]["price"];
                let newRow = $("<tr></tr>")
                    .append(`<td>${data["package"]["package_number"]}</td>`)
                    .append(
                        `<td>${data["package"]["sender_surname"]} ${data["package"]["sender_name"]} ${data["package"]["sender_middle_name"]}</td>`
                    )
                    .append(`<td>${data["package"]["sender_phone"]}</td>`)
                    .append(
                        `<td>${data["package"]["city_from"]}, ${data["package"]["adress_from"]}</td>`
                    )
                    .append(
                        `<td>${data["package"]["receiver_surname"]} ${data["package"]["receiver_name"]} ${data["package"]["receiver_middle_name"]}</td>`
                    )
                    .append(`<td>${data["package"]["receiver_phone"]}</td>`)
                    .append(
                        `<td>${data["package"]["city_to"]}, ${data["package"]["adress_to"]}</td>`
                    )
                    .append(`<td>${data["package"]["weight"]} кг </td>`)
                    .append(`<td>${data["package"]["category"]}</td>`)
                    .append(`<td>${data["package"]["created_at"]}</td>`)
                    .append(`<td class="price">${price} грн</td>`)
                    .append(`<td>${data["package"]["status"]}</td>`);

                $(".one_package_table tbody").append(newRow);
            }
        },
        error: function(data, textStatus, errorThrown) {},
    });
}

// отримуємо список міст для фільтру
function ajaxGetCities() {
    $.ajax({
        type: "POST",
        url: "get_cities",
        success: function(data) {
            data["cities"].forEach(function(city) {
                $("#city_filter").append(
                    "<option value=" +
                    city["id"] +
                    ">" +
                    city["name"] +
                    "</option>"
                );
            });
        },
        error: function(data, textStatus, errorThrown) {},
    });
}