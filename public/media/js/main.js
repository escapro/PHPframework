
$(document).on('click', '.edit', function () {
    var taskId = $(this).attr('task-id');
    var taskText = $(this).parent().find('.tText').text();
    $('#taskEditModal .modal-title').html("Изменить задачу №" + taskId);
    $('#taskEditModal').attr('task-id', taskId);
    $('#editBtn').attr('task-id', taskId);
    $('#editText').val(taskText);
})

$(document).on('click', '#editBtn', function () {
    var data = {};
    var errorReport = [];

    data.id = $(this).attr('task-id');
    data.text = $('#editText').val();
    if ($('#editStatus').is(":checked"))
    {
        data.status = 0;
    }else {
        data.status = 1;
    }
    
    if(data.text == '') {
        errorReport.push('Введите новый текст задачи');
    }

    if(errorReport.length > 0) {
        alert(errorReport[0]);
    }else {
        sentData(data, 'editTask', function (response) {
            alert(response);
            if(response == "Задача успешно изменена") {
                location.reload();
            }   
        });
    }
})

$(document).on('click', '#addTaskBtn', function () {
    sentNewTaskData();
})

$(document).on('click', '#authBtn', function () {
    authorize();
})

$(document).on('click', '#logoutBtn', function () {
    logout();
})

$(document).on('change', '#sortBy', function() {
    sort();
})

$(document).on('change', '#sortType', function() {
    sort();
})

$(document).on('click', '.page-link', function () {
    event.preventDefault();
    sort('page', this);
})

function sort(type, obj) {

    var page = $('.content').attr('page');
    if(type == 'page') {
        page = $(obj).attr('page');
    }
    var sortBy = $('#sortBy').val();
    var sortType = $('#sortType').val();

    var newUrl = "?page=" + page + "&sortBy=" + sortBy + "&sortType=" + sortType;

    window.location.href = newUrl;
}

function logout() {
    $.ajax({
        type: "GET",
        url: 'logout',
        success: function (response) {
            location.reload();
        }
    });
}

function authorize() {
    var data = {};
    var errorReport = [];

    data.login = $('#authUsername').val();
    data.password = $('#authPassword').val();

    if(data.login == '') {
        errorReport.push('Укажите ваш логин');
    }else if(data.password == '') {
        errorReport.push('Введите пароль');
    }

    if(errorReport.length > 0) {
        alert(errorReport[0]);
    }else {
        sentData(data, 'login', function (response) { 
            if(response == "") {
                location.reload();
            }else {
                alert(response);
            }
        });
    }
}

function sentNewTaskData() {
    var data = {};
    var errorReport = [];

    data.username = $('#username').val();
    data.email = $('#email').val();
    data.text = $('#text').val();

    if(data.username == '') {
        errorReport.push('Укажите имя пользователя');
    }else if(data.email == '') {
        errorReport.push('Введите email');
    }else if(!validateEmail(data.email)) {
        errorReport.push('Неправильный формат Email');
    }else if(data.text == '') {
        errorReport.push('Введите текст задачи');
    }

    if(errorReport.length > 0) {
        alert(errorReport[0]);
    }else {

        sentData(data, 'addTask', function (response) {      
            alert(response);
            if(response == "Задача успешно добавлена") {
                location.reload();
            }
        });
        
    }
}

function sentData(data, url, callback) {
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "html",
        success: function (response) {
            callback(response)
        }
    });
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(String(email).toLowerCase());
}