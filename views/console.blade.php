<html>
    <head>
        <title>{{ config('app.name') }}</title>
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic+Coding" rel="stylesheet">
        <style>
            body,html{
                background-color: black;
            }
            .console{
                background-color: black;
                padding: 20px 10px;
            }
            p{
                font-family: 'Nanum Gothic Coding', monospace;
                margin: 5px 0;
            }
            .command,.output{
                color: white;
            }
            .directory{
                font-weight: bold;
                color: #42df00;
            }
            .tabbed{
                padding-left: 20px;
            }
        </style>
    </head>
    <body>
        <div class="console">
            <p class="command"><span class="directory">user{{ '@'.config('app.name') }}:~</span>$ {{ $command }}</p>
            @foreach($lines as $line)
                {!! $line !!}
            @endforeach
        </div>
    </body>
</html>