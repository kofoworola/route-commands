<html>
<head>
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic+Coding" rel="stylesheet">
    <style>
        body, html {
            background-color: black;
        }

        .console {
            font-family: 'Nanum Gothic Coding', monospace;
            background-color: black;
            padding: 20px 10px;
        }

        p {
            margin: 5px 0;
        }

        .command {
            display: flex;
        }

        .command, .output {
            color: white;
            width: 100%;
        }

        .directory {
            font-weight: bold;
            color: #42df00;
        }

        .console input {
            background-color: transparent;
            border: none;
            caret-color: white;
            /*color: white;*/
            width: 90%;
        }

        .console input:active, input:focus {
            outline: none;
            background-color: transparent;
            border: none;
        }
    </style>
</head>
<body>
<div class="console">
    <div class="command">
        <div class="directory">users{{ '@'.config('app.name') }}:~</div>
        <div class="output">$ {{ $command }}</div>
    </div>
    @if(!$authenticated)
        <div class="command">
            <div>{{ config('commands.authentication')['display'] }}:</div>
            <form method="post">
                {{ csrf_field() }}
                <div class="output"><input type="password" name="password"/></div>
            </form>
        </div>
    @endif
    @foreach($lines as $line)
        {!! $line !!}
    @endforeach
    <br>
    @if($authenticated)
        <div class="command">
            Command run
        </div>
    @endif
</div>
</body>
</html>