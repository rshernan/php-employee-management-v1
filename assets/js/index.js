
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