$(document).ready(function () {
    var todayDate = new Date().toISOString().slice(0,10);
    lista_mantenimiento()

    function lista_mantenimiento(){
        $.ajax({
            type: "POST",
            data: {todayDate},
            url: "../php/lista_mantenimiento.php",
            success: function (response) {
                const tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(mantenimiento => {
                    template += `
                        <tr mantenimientoId="${mantenimiento.id_mantenimiento}">
                            <td>${mantenimiento.id_maquina}</td>
                            <td>${mantenimiento.modelo_maquina}</td>
                            <td>${mantenimiento.nom_mantenimiento}</td>
                            <td>${mantenimiento.ultimo_mantenimiento}</td>
                            <td>${mantenimiento.fecha_max_mantenimiento}</td>
                            <td>${mantenimiento.observacion}</td>
                            <td class="btn btn-${mantenimiento.color}">${mantenimiento.alerta.days} días restantes</td>
                            <td>
                                <button class="mantenimiento-update btn btn-success">
                                Generar Mantenimiento 
                                </button>
                            </td>
                        </tr>
                      `
                });
                $('#mantenimiento').html(template);
            }
        });
    }

    $(document).on('click', '.mantenimiento-update', (e) => {
        if (confirm('¿Estás seguro de generar un mantenimiento?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('mantenimientoId');
            $("#contenedor_editar").css("display", "block");

            $('#form_mantenimiento').submit(function (e) { 
                e.preventDefault();
                const postData = {
                    select_modelo: $('#select_modelo').val(),
                    select_tipo: $('#select_tipo').val(),
                    observacion: $('#observacion').val(),
                    id_mante: id
                }

                $.post("../php/generar_mante.php", postData,
                    function (response) {
                        if(response == "Se ha generado correctamente el mantenimiento") {
                            lista_mantenimiento()
                            $('#form_mantenimiento').trigger('reset');
                            $("#contenedor_editar").css("display", "none");
                        }
                        alert(response)
                    }
                );
            });
        }
    });

    $('#btn_close_update').click(function (e) {
        $('#form_mantenimiento').trigger('reset');
        $("#contenedor_editar").css("display", "none");
    });
});