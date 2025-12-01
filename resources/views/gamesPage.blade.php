@include('navbar')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
    <div class="game">
        <img src="{{asset('images/thewitcher3.jpg')}}" alt="the witcher 3" width="300px" height="250px">

    </div>
    <div class="game">
        <img src="{{asset('images/cyberpunk.jpg')}}" alt="cyberpunk" width="300px" height="250px">
    </div>
    <div class="game">
        <img src="{{asset('images/starcraft.png')}}" alt="starcraft" width="300px" height="250px">
        
    </div>

</body>
</html>
