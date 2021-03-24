$(document).ready(function () {
    lista_informe()
    function lista_informe(){
        $.get("../php/informe.php",
            function (response) {
                const tasks = JSON.parse(response)
                let template = '';
                let template2 = '';
                tasks.forEach(informe => {
                    template += `
                                    <tr id_turno = "${informe.id_turno}" recomendacion="${informe.reco_trabajador}">
                                        <td>${informe.documento}</td>
                                        <td>${informe.nombre} ${informe.apellido}</td>
                                        <td>${informe.hora_total} horas</td>
                                        <td class="reco">${informe.reco_trabajador}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm">Efectuar</button>
                                            <button class="btn btn-danger btn-sm">Aplazar</button>
                                        </td>
                                    </tr>
                                `
                    
                    template2 += `
                                    <tr id_turno = "${informe.id_turno}" recomendacion="${informe.reco_maquina}">
                                        <td>${informe.id_maquina}</td>
                                        <td>${informe.modelo_maquina}</td>
                                        <td>${informe.hora_total} horas</td>
                                        <td>${informe.reco_maquina}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm">Efectuar</button>
                                            <button class="btn btn-danger btn-sm">Aplazar</button>
                                        </td>
                                    </tr>
                                `
                });

                $('#tabla_trabajador').html(template);
                $('#tabla_maquina').html(template2);
            }
        );
    }

    $(document).on('click', '.btn-success', (e) => {
        if (confirm('¿Estás seguro de esto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('id_turno');
            const recomendacion = $(element).attr('recomendacion');

            const postData = {
                id_turno: id,
                recomendacion: recomendacion
            }
            $.post("../php/informe_success.php", postData,
                function (response) {
                    if(response == "Realizado correctamente") {
                        alert(response)
                        lista_informe()
                    } else {
                        alert(response)
                    }
                }
            );
        }
    });

    $(document).on('click', '.btn-danger', (e) => {
        if (confirm('¿Estás seguro de esto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('id_turno');
            const recomendacion = $(element).attr('recomendacion');

            const postData = {
                id_turno: id,
                recomendacion: recomendacion
            }
            $.post("../php/informe_aplazar.php", postData,
                function (response) {
                    if(response == "Aplazado correctamente") {
                        alert(response)
                        lista_informe()
                    } else {
                        alert(response)
                    }
                }
            );
        }
    });
});