$(document).ready(function () {
    traer_lista()

    function traer_lista() {
        $.ajax({
            type: "GET",
            url: "../php/crear_trabajador.php",
            success: function (response) {
                const tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(trabajador => {
                    template += `
                        <tr trabId="${trabajador.documento}">
                            <td>${trabajador.nombre}</td>
                            <td>${trabajador.apellido}</td>
                            <td>${trabajador.correo}</td>
                            <td>${trabajador.telefono}</td>
                            <td>${trabajador.direccion}</td>
                            <td>
                                <button class="trabajador-update btn btn-success">
                                Editar 
                                </button>
                                <button class="trabajador-delete btn btn-danger">
                                Eliminar 
                                </button>
                            </td>
                        </tr>
                      `
                });
                $('#trab').html(template);
            }
        });
    }

    $(document).on('click', '.trabajador-delete', (e) => {
        if (confirm('¿Estás seguro de eliminar?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('trabId');
            $.post('../php/trabajador-delete.php', {
                id
            }, (response) => {
                alert(response)
                trab_lista()
            });
        }
    });

    $(document).on('click', '.trabajador-update', (e) => {
        if (confirm('¿Estás seguro de editar?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('trabId');

            $.get("../php/trabajador-actualizar.php", {id},
                function (response) {
                    const tasks = JSON.parse(response);
                    tasks.forEach(trabajador => {
                        $('#correo_update').val(`${trabajador.correo}`)
                        $('#telefono_update').val(`${trabajador.telefono}`)
                        $('#direccion_update').val(`${trabajador.direccion}`)
                    });
                }
            );

            $("#contenedor_editar").css("display", "block");

            $('#form_update').submit(function (e) { 
                e.preventDefault();
                const postData = {
                    correo: $('#correo_update').val(),
                    telefono: $('#telefono_update').val(),
                    potencia: $('#direccion_update').val(),
                    id: id
                }
        
                $.post("../php/trabajador-update.php", postData,
                    function (response) {
                        if(response == "Elemento editado correctamente") {
                            traer_lista();
                            $('#form_update').trigger('reset');
                            $("#contenedor_editar").css("display", "none");
                        } 
                        alert(response)
                    }
                );
            });
        }
    });

    $('#btn_close_update').click(function (e) {
        $('#form_update').trigger('reset');
        $("#contenedor_editar").css("display", "none");
    });

    $('#form_tra').submit(function (e) { 
        e.preventDefault();
        const postData = {
            modelo: $('#modelo').val(),
            tipo_maquina: $('#tipo_maquina').val(),
            potencia: $('#potencia').val(),
            capacidad: $('#capacidad').val(),
            id_serie: $('#id_serie').val()
        }

        $.post("../php/crear_trabajador.php", postData,
            function (response) {
                if(response == "Trabajador insertado correctamente") {
                    trab_lista();
                    $('#form_tra').trigger('reset');
                } 
                alert(response)
            }
        );
    });
});
