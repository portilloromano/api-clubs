<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratación</title>
</head>

<body>
<p>Estimado <strong>{{$data['entity']['name'] . ' ' . $data['entity']['surname']}}</strong> su contratación
    como {{strtoupper($data['entity']['type']) == 'PLAYER' ? 'Jugador' : 'Entrenador'}} con el Club
    <strong>{{$data['club']['name']}}</strong> ha finalizado.</p>
<p>Le deseamos mucha suerte en su futuro profesional.</p>
</body>

</html>
