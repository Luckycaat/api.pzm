<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/pokemon-solid" rel="stylesheet">
    <script src="https://kit.fontawesome.com/558e9038b0.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/jpg" href="/favicon.ico" />

    <!-- Styles -->
    @vite(['resources/css/app.css'])

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Rotas JS -->
    <script type="text/javascript">
        @props(['parametersJs' => []]);
        const parametersJs = {{ Illuminate\Support\Js::from($parametersJs) }};
    </script>

</head>

<body class="antialiased">
    <x-main :collection="$collection" />
    <footer>
        @vite(['resources/js/app.js'])
    </footer>
</body>

</html>
