
function disabledFormSubmit () {
    'use strict';
    window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {   // Add condition for empty input
                event.preventDefault();
                event.stopPropagation();
                $(".alert").fadeIn();
                $(".show").fadeOut(); //hide if there is php error msg before
                }
                //form.classList.add('was-validated'); Bootstrat specific validation
            }, false);
        });
    }, false);
};
disabledFormSubmit();

function hideErrorMsg () {
    $(this).parent().fadeOut();
}

$(".close").on('click', hideErrorMsg);

function addEmployee(e){
    e.preventDefault();
    let data = {};
    $.ajax({
        url: "http://localhost/php-employee-management-v1/src/library/employeeController.php",
        type: "POST",
        data: data,
        dataType: "json"
    }).done(function(response){
        console.log(response);
        console.log("usuario agregado");
    }).fail(function(status) {
        console.log(status);
    });
}

function updateEmployee(e){
    e.preventDefault();
    let data = {};
    $(".employee__form").serializeArray().forEach(function(element){
        let pairValue = {[element.name] : element.value}
        Object.assign(data,pairValue);
    });
    $.ajax({
        url: "http://localhost/php-employee-management-v1/src/library/employeeController.php",
        type: "PUT",
        data: data,
        dataType: "json"
    }).done(function(response){
        console.log(response);
        console.log("usuario agregado");
    }).fail(function(status) {
        console.log(status);
    });
}

function deleteEmployee(employeeId){
    let data = {};
    if(employeeId!=null){
        Object.assign(data, {"id":employeeId});
    }
    $.ajax({
        url: "http://localhost/php-employee-management-v1/src/library/employeeController.php",
        type: "DELETE",
        data: data,
        dataType: "json"
    }).done(function(response){
        console.log(response);
        console.log("usuario agregado");
    }).fail(function(status) {
        console.log(status);
    });
}

function getEmployee(employeeId){
    let data = {};
    if(employeeId!=null){
        Object.assign(data, {"id":employeeId});
    }
    $.ajax({
        url: "http://localhost/php-employee-management-v1/src/library/employeeController.php",
        type: "GET",
        data: data,
        dataType: "json"
    }).done(function(response){
        console.log(response);
        console.log("usuario agregado");
    }).fail(function(status) {
        console.log(status);
    });
}



$(".employee__form").on('submit', function(){
    
});