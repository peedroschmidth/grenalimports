<html>
    <head>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <script src="jquery/jquery.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <title>SGEV - Grenal Imports</title>
        <meta name="csrf-token" content="{{csrf_token()}}">
        <style>
            body{
                padding: 20px;
            }
            .navbar{
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @if($current <> "login")
                @component('layouts.component_navbar', ["current" => $current])
                @endcomponent
            @endif
            <main role="main">
                @hasSection('body')
                    @yield('body')
                @endif
            </main>
        </div>
        <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    </body>
</html>