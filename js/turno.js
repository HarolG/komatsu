$(document).ready(function () {
    $('#form_insert').submit(function (e) { 
        e.preventDefault();
        const postData = {
            documento: $('#documento').val(),
            maquina_disp: $('#maquina_disp').val()
        }

        $.post("../php/generar_turno.php", postData,
            function (response) {
                const tasks = JSON.parse(response);
                tasks.forEach(turno => {
                    if(turno.respuesta == "Correcto") {
                        $("#form_turno").css("display", "none");
                        $("#form_turno_fin").css("display", "block");
                        $("#alerta_turno_exito").css("display", "block");
                        $("#alerta_turno_error").css("display", "none");

                        $('#form_insert_fin').submit(function (e) { 
                            e.preventDefault();
                            const postData = {
                                id_turno: turno.id_turno,
                                documento: $('#documento').val(),
                                maquina_disp: $('#maquina_disp').val()
                            }
                    
                            $.post("../php/finalizar_turno.php", postData,
                                function (response) {
                                    alert(response)
                                }
                            );
                        });

                    } 
                });
            }
        );
    });
});