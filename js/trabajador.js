$(document).ready(function () { 
    trab_lista()

    function trab_lista() {
        $.ajax({
            type: "GET",
            url: "../php/turno_trabajo.php",
            success: function (response) {
                const trab = JSON.parse(response);
                let trabplant = '';
                trab.forEach(trabajador => {
                    trabplant += `
                        <tr trabajadorId="${trabajador.documento}">
                            <td>${trabajador.documento}</td>
                            <td>${trabajador.id_turno_trabajador}</td>
                            <td>${trabajador.hora_inicio}</td>
                            <td>${trabajador.hora_fin}</td>
                            <td>${trabajador.hora_total}</td>
                            <td>
                                <button class="trabajador-finish btn btn-outline-danger">
                                Terminar Turno 
                                </button>
                            </td>
                        </tr>
                      `
                });
                $('#trabajador').html(template);
            }
        });
    }
    
});
