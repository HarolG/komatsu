$(document).ready(function () {
    traer_lista()

    function traer_lista() {
        $.ajax({
            type: "GET",
            url: "../php/lista_maquina.php",
            success: function (response) {
                const tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(maquina => {
                    template += `
                        <tr maquinaId="${maquina.id}">
                            <td>${maquina.id}</td>
                            <td>${maquina.modelo_maquina}</td>
                            <td>${maquina.nom_tipo}</td>
                            <td>${maquina.potencia_neta}</td>
                            <td>${maquina.capacidad}</td>
                            <td>
                                <button class="maquina-update btn btn-success">
                                Editar 
                                </button>
                                <button class="maquina-delete btn btn-danger">
                                Eliminar 
                                </button>
                            </td>
                        </tr>
                      `
                });
                $('#maquinas').html(template);
            }
        });
    }

    $(document).on('click', '.maquina-delete', (e) => {
        if (confirm('¿Estás seguro de eliminar?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('maquinaId');
            $.post('../php/maquina-delete.php', {
                id
            }, (response) => {
                alert(response)
                traer_lista()
            });
        }
    });

    $(document).on('click', '.maquina-update', (e) => {
        if (confirm('¿Estás seguro de editar?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('maquinaId');

            $.get("../php/maquina_por_id.php", {id},
                function (response) {
                    const tasks = JSON.parse(response);
                    tasks.forEach(maquina => {
                        $('#modelo_update').val(`${maquina.modelo_maquina}`)
                        $('#potencia_update').val(`${maquina.potencia_neta}`)
                        $('#capacidad_update').val(`${maquina.capacidad}`)
                    });
                }
            );

            $("#contenedor_editar").css("display", "block");

            $('#form_update').submit(function (e) { 
                e.preventDefault();
                const postData = {
                    modelo: $('#modelo_update').val(),
                    tipo_maquina_update: $('#tipo_maquina_update').val(),
                    potencia: $('#potencia_update').val(),
                    capacidad: $('#capacidad_update').val(),
                    id: id
                }
        
                $.post("../php/maquina-update.php", postData,
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

    $('#form_insert').submit(function (e) { 
        e.preventDefault();
        const postData = {
            modelo: $('#modelo').val(),
            tipo_maquina: $('#tipo_maquina').val(),
            potencia: $('#potencia').val(),
            capacidad: $('#capacidad').val(),
            id_serie: $('#id_serie').val()
        }

        $.post("../php/maquina-insert.php", postData,
            function (response) {
                if(response == "Elemento insertado correctamente") {
                    traer_lista();
                    $('#form_insert').trigger('reset');
                } 
                alert(response)
            }
        );
    });
});