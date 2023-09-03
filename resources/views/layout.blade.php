<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Clinic')</title>
</head>

<body>
    <nav>
        <p>navbar</p>
    </nav>
    @section('sidebar')
        This is the master sidebar.
    @show


    <main>
        @yield('content')
    </main>
    <footer>
        <p>footer</p>
    </footer>
</body>

</html>
