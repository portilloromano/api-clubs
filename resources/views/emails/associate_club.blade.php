<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratación</title>
</head>

<body>
<p>Estimado <strong>{{$data['entity']['name'] . ' ' . $data['entity']['surname']}}</strong> su contratación con el Club
    <strong>{{$data['club']['name']}}</strong> ha sido procesada.</p>
<ul style="list-style-type:none;">
    <li>Cargo: {{strtoupper($data['entity']['type']) == 'PLAYER' ? 'Jugador' : 'Entrenador'}}</li>
    <li>Salario: {{$data['entity']['salary']}}</li>
</ul>
<p>Saludos cordiales.</p>
</body>

</html>
