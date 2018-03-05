<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
<div class="container">
    <div class="align-items-center event">
        <h1>CerteSE<img src="{{ asset('Logo.png') }}" id="logo"/></h1>
    </div>
    <h2>Detalles de la reserva</h2>
    <p><strong>Fecha de la reserva: </strong>{{ date_format(\App\Reserve::where('user_id', $user->id)->where('event_id', $event->id)->first()->created_at, 'H:i d-m-Y') }}</p>
    <p><strong>Plazas reservadas: </strong>{{ \App\Reserve::where('user_id', $user->id)->where('event_id', $event->id)->first()->units }}</p>
    <hr>

    <h2>Detalles del evento</h2>
    <p><strong>Evento reservado: </strong>{{ $event->name }}</p>
    <p><strong>Fecha del evento: </strong>{{ $event->date }}</p>
    <p><strong>Duración del evento: </strong>{{ $event->duration }}</p>
    <p><strong>Precio de la entrada al evento: </strong>{{ $event->cost }}</p>
    <p><strong>Edad minima del evento: </strong>{{ $event->agemin }}</p>
    <p><strong>Lugar del evento: </strong>{{ \App\Reserve::where('user_id', $user->id)->where('event_id', $event->id)->first()->place }}</p>
    <p><strong>Organizadores del evento: </strong>{{ $event->organizer }}</p>
    <hr>

    <h2>Detalles del usuario</h2>
    <p><strong>Nombre: </strong>{{ $user->name }} {{ $user->lastname }}</p>
    <p><strong>Nick: </strong>{{ $user->username }}</p>
    <p><strong>Email: </strong>{{ $user->email }}</p>
    <p><strong>Movil de contacto: </strong>{{ $user->mobile }}</p>
</div>
</body>
</html>