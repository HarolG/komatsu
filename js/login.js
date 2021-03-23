$(document).ready(function () {

    $('#login_form').submit(function (e) { 
        e.preventDefault();
        const postData = {
            documento: $('#documento').val(),
            clave: $('#clave').val()
        };
        $.post("php/login.php", postData,
            function (response) {
                if(response == "Admin") {
                    $(location).attr('href','private/admin.php');
                } else if(response == "Trabajador"){
                    $(location).attr('href','private/trabajador.php');
                } else {
                    alert(response)
                }
            }
        );
    });
});

