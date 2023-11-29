<?php
    require '../recursos/documento/vendor/autoload.php';
    use Dompdf\Dompdf;

    if (isset($_POST['numeroReporte'])) {
        $logo = "../recursos/logo.png";
        $logo64 = "data:image/png;base64," . base64_encode(file_get_contents($logo));

        if ($_POST['numeroReporte'] == 1) {
            // Obtener los datos de la base de datos
            $conn = new mysqli('localhost', 'root', '', 'bdprueba');

            if ($conn->connect_errno) {
                echo "Falló la conexión a MySQL: " . $conn->connect_error;
                exit();
            }

            // Consulta para obtener el número de registros en la tabla usuario
            $sqlUsuario = "SELECT COUNT(*) as totalUsuarios FROM usuario";
            $resultUsuario = $conn->query($sqlUsuario);
            $rowUsuario = $resultUsuario->fetch_assoc();
            $totalUsuarios = $rowUsuario['totalUsuarios']-1;

            // Consulta para obtener el número de registros en la tabla propietario
            $sqlPropietario = "SELECT COUNT(*) as totalPropietarios FROM propietario";
            $resultPropietario = $conn->query($sqlPropietario);
            $rowPropietario = $resultPropietario->fetch_assoc();
            $totalPropietarios = $rowPropietario['totalPropietarios'];

            // Consulta para obtener el número de registros en la tabla profesional
            $sqlProfesional = "SELECT COUNT(*) as totalProfesionales FROM profesional";
            $resultProfesional = $conn->query($sqlProfesional);
            $rowProfesional = $resultProfesional->fetch_assoc();
            $totalProfesionales = $rowProfesional['totalProfesionales'];

            // Consulta para obtener el número de registros en la tabla experto
            $sqlExperto = "SELECT COUNT(*) as totalExpertos FROM experto";
            $resultExperto = $conn->query($sqlExperto);
            $rowExperto = $resultExperto->fetch_assoc();
            $totalExpertos = $rowExperto['totalExpertos'];

            // Consulta SQL para obtener nombre, apellido, correo y tabla de cada usuario
            $sql = "SELECT u.correoUsuario as correo, p.nomPropietario as nombre, p.apePropietario as apellido, 'propietario' as tipo FROM propietario p INNER JOIN usuario u ON p.idUsuario = u.idUsuario
            UNION
            SELECT u.correoUsuario as correo, pr.nomProfesional as nombre, pr.apeProfesional as apellido, 'profesional' as tipo FROM profesional pr INNER JOIN usuario u ON pr.idUsuario = u.idUsuario
            UNION
            SELECT u.correoUsuario as correo, e.nomExperto as nombre, e.apeExperto as apellido, 'experto' as tipo FROM experto e INNER JOIN usuario u ON e.idUsuario = u.idUsuario";
            $resultUsuarios = $conn->query($sql);

            // Crear la tabla con los datos obtenidos
            $table = '<table>
            <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Correo Electronico</th>
                <th>Tipo de Usuario</th>
            </tr>
            </thead>
            <tbody>';
                while ($row = $resultUsuarios->fetch_assoc()) {
                    $nombreCompleto = $row['nombre'] . ' ' . $row['apellido'];
                    $correo = $row['correo'];
                    $tipo = $row['tipo'];

                    $table .= '<tr>
                        <td>' . $nombreCompleto . '</td>
                        <td>' . $correo . '</td>
                        <td>' . $tipo . '</td>
                    </tr>';
                }
            $table .= '</tbody></table>';

            // Cerrar la conexión a la base de datos
            $conn->close();

            // Crear el contenido HTML del reporte con la tabla generada
            $html = '
                <!DOCTYPE html>
                <html>
                    <head>
                        <style>
                            body {
                                font-size: 12pt;
                            }

                            /* Estilos para la cabecera */
                            .logo {
                                text-align: center;
                            }
                            .imagen {
                                width: 100px;
                            }
                            .info {
                                text-align: left;
                                line-height: 35%;
                            }

                            /* Estilos para la tabla */
                            table {
                                width: 100%;
                                border-collapse: collapse;
                            }
                            th, td {
                                text-align: left;
                                padding: 8px;
                            }
                            tr:nth-child(even){
                                background-color: #f2f2f2;
                            }
                            th {
                                background-color: #eb842c;
                                color: white;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="logo">
                            <img class="imagen" src="'.$logo64.'" alt="Logotipo">
                        </div>
                        <div class="info">
                            <p>Fecha de creación: ' . date('d-m-Y') . '</p>
                            <h3>Reporte de usuarios</h3>
                        </div>

                        <p><b>Cantidad de usuarios:</b></p>
                        <ul>
                            <li>Propietarios: ' . $totalPropietarios . '</li>
                            <li>Profesionales: ' . $totalProfesionales . '</li>
                            <li>Expertos: ' . $totalExpertos . '</li>
                            <li>Total: ' . $totalUsuarios . '</li>
                        </ul>

                        <p><b>Tabla de usuarios en el sistema:</b></p>
                        ' . $table . '
                    </body>
                </html>
            ';

            // Crear el objeto Dompdf
            $dompdf = new Dompdf();

            // Cargar el contenido HTML en DOMPDF
            $dompdf->loadHtml($html);

            // Opcional: Establecer opciones de configuración
            $dompdf->setPaper('letter', 'portrait'); // Establecer el tamaño del papel y orientación (portrait o landscape)

            // Renderizar el PDF
            $dompdf->render();

            // Generar el PDF y guardarlo en el servidor
            $dompdf->stream('reporteUsuarios_'.date('d-m-Y').'.pdf', array('Attachment' => 0));                  
        }
        if ($_POST['numeroReporte'] == 2) {
            function obtenerNombreMes($numeroMes) {
                $meses = [
                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                ];
                return $meses[$numeroMes];
            }

            // Obtener los datos de la base de datos
            $conn = new mysqli('localhost', 'root', '', 'bdprueba');

            if ($conn->connect_errno) {
                echo "Falló la conexión a MySQL: " . $conn->connect_error;
                exit();
            }

            // Consulta SQL para obtener la información de la tabla mascota
            $sql = "SELECT nomMascota, especie, fechaRegistroMascota, estatus FROM mascota";
            $resultado = $conn->query($sql);

            $datos_por_mes = array();

            // Iterar a través de los resultados y organizar los datos por mes
            while ($row = $resultado->fetch_assoc()) {
                $fecha = new DateTime($row['fechaRegistroMascota']);
                $mes = $fecha->format('n');
                $datos_por_mes[$mes][] = $row;
            }

            // Cerrar la conexión a la base de datos
            $conn->close();

            // Crear el contenido HTML del reporte con la tabla generada
            $html = '
            <!DOCTYPE html>
            <html>
                <head>
                    <style>
                        body {
                            font-size: 12pt;
                        }

                        /* Estilos para la cabecera */
                        .logo {
                            text-align: center;
                        }
                        .imagen {
                            width: 100px;
                        }
                        .info {
                            text-align: left;
                            line-height: 35%;
                        }

                        /* Estilos para la tabla */
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            text-align: left;
                            padding: 8px;
                        }
                        tr:nth-child(even){
                            background-color: #f2f2f2;
                        }
                        th {
                            background-color: #eb842c;
                            color: white;
                        }
                    </style>
                </head>
                <body>
                    <div class="logo">
                        <img class="imagen" src="'.$logo64.'" alt="Logotipo">
                    </div>
                    <div class="info">
                        <p>Fecha de creación: ' . date('d-m-Y') . '</p>
                        <h3>Reporte de mascotas</h3>
                    </div>
                    <p><b>Registros de mascotas por mes:</b></p>';

                    foreach ($datos_por_mes as $mes => $mascotas) {
                        $html .= '<h4>' . obtenerNombreMes($mes) . '</h4>';
                        $html .= '<table>
                            <tr>
                                <th>Nombre</th>
                                <th>Especie</th>
                                <th>Fecha de Registro</th>
                                <th>Estatus</th>
                            </tr>';

                        foreach ($mascotas as $mascota) {
                            $html .= '<tr>
                                <td>' . $mascota['nomMascota'] . '</td>
                                <td>' . $mascota['especie'] . '</td>
                                <td>' . $mascota['fechaRegistroMascota'] . '</td>
                                <td>' . $mascota['estatus'] . '</td>
                            </tr>';
                        }

                        $html .= '</table>';
                    }
            $html .= '</body></html>';

            // Crear el objeto Dompdf
            $dompdf = new Dompdf();

            // Cargar el contenido HTML en DOMPDF
            $dompdf->loadHtml($html);

            // Opcional: Establecer opciones de configuración
            $dompdf->setPaper('letter', 'portrait'); // Establecer el tamaño del papel y orientación (portrait o landscape)

            // Renderizar el PDF
            $dompdf->render();

            // Generar el PDF y guardarlo en el servidor
            $dompdf->stream('reporteMascotas_'.date('d-m-Y').'.pdf', array('Attachment' => 0));     
        }
        if ($_POST['numeroReporte'] == 3) {
            function obtenerNombreMes($numero_mes) {
                $meses = array(
                    1 => 'Enero',
                    2 => 'Febrero',
                    3 => 'Marzo',
                    4 => 'Abril',
                    5 => 'Mayo',
                    6 => 'Junio',
                    7 => 'Julio',
                    8 => 'Agosto',
                    9 => 'Septiembre',
                    10 => 'Octubre',
                    11 => 'Noviembre',
                    12 => 'Diciembre'
                );
            
                return $meses[$numero_mes];
            }

            // Obtener los datos de la base de datos
            $conn = new mysqli('localhost', 'root', '', 'bdprueba');

            if ($conn->connect_errno) {
                echo "Falló la conexión a MySQL: " . $conn->connect_error;
                exit();
            }

            // Obtener los datos de la base de datos
            $sql = "SELECT mascota.nomMascota, mascota.especie, adopcion.nomPersona, adopcion.correoPersona, mascota.fechaRegistroMascota
            FROM mascota
            INNER JOIN adopcion ON mascota.idMascota = adopcion.idMascota
            ORDER BY mascota.fechaRegistroMascota";

            $resultado = $conn->query($sql);

            // Organizar los datos por mes
            $registros_por_mes = [];

            while ($fila = $resultado->fetch_assoc()) {
                $mes = date('n', strtotime($fila['fechaRegistroMascota']));
                $registros_por_mes[$mes][] = $fila;
            }

            // Cerrar la conexión a la base de datos
            $conn->close();

            // Crear el contenido HTML del reporte con la tabla generada
            $html = '
            <!DOCTYPE html>
            <html>
                <head>
                    <style>
                        body {
                            font-size: 12pt;
                        }

                        /* Estilos para la cabecera */
                        .logo {
                            text-align: center;
                        }
                        .imagen {
                            width: 100px;
                        }
                        .info {
                            text-align: left;
                            line-height: 35%;
                        }

                        /* Estilos para la tabla */
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            text-align: left;
                            padding: 8px;
                        }
                        tr:nth-child(even){
                            background-color: #f2f2f2;
                        }
                        th {
                            background-color: #eb842c;
                            color: white;
                        }
                    </style>
                </head>
                <body>
                    <div class="logo">
                        <img class="imagen" src="'.$logo64.'" alt="Logotipo">
                    </div>
                    <div class="info">
                        <p>Fecha de creación: ' . date('d-m-Y') . '</p>
                        <h3>Reporte de adopciones</h3>
                    </div>

                    <p><b>Registros de adopciones por mes de registro:</b></p>';

                    foreach ($registros_por_mes as $mes => $registros) {
                        $html .= '<h4>' . obtenerNombreMes($mes) . '</h4>';
                        $html .= '<table>
                            <tr>
                                <th>Mascota</th>
                                <th>Especie</th>
                                <th>Candidato</th>
                                <th>Correo</th>
                            </tr>';

                        foreach ($registros as $registro) {
                            $html .= '<tr>
                                <td>' . $registro['nomMascota'] . '</td>
                                <td>' . $registro['especie'] . '</td>
                                <td>' . $registro['nomPersona'] . '</td>
                                <td>' . $registro['correoPersona'] . '</td>
                            </tr>';
                        }

                        $html .= '</table>';
                        $html .= '<p>Cantidad de adopciones: ' . count($registros) . '</p>';
                    }
            $html .= '</body></html>';

            // Crear el objeto Dompdf
            $dompdf = new Dompdf();

            // Cargar el contenido HTML en DOMPDF
            $dompdf->loadHtml($html);

            // Opcional: Establecer opciones de configuración
            $dompdf->setPaper('letter', 'portrait'); // Establecer el tamaño del papel y orientación (portrait o landscape)

            // Renderizar el PDF
            $dompdf->render();

            // Generar el PDF y guardarlo en el servidor
            $dompdf->stream('reporteAdopciones_'.date('d-m-Y').'.pdf', array('Attachment' => 0));
        }
    }
?>