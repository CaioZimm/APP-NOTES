<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Esqueci a Senha</title>
    <style>
        body{
            font-family: Tahoma, sans-serif;
        }

        table{
            border: 0; 
            width: 100%; 
            max-width: 600px; 
            margin: 0 auto;
        }

        table td{
            background-color: #CBD5E1;
            border: 1px solid black; 
            padding: 10px 40px 20px;
            border-radius: 5px; 
            text-align: center; 
            box-shadow:#47463e 2px 1px 10px 0.5px;
        }

        span{
            display: inline-block; 
            font-size: 20px;
            font-weight: bold; 
            color: #ffffff; 
            width: 35px; 
            height: 40px; 
            background-color: #1E293B;
            border: 1px solid #000000; 
            border-radius: 5px; 
            margin: 0 8px; 
            align-content: center; 
            line-height: 42px;
        }
    </style>
</head>
<body class="m-[1vh]">
    <table>
        <tr>
            <td>
                <h2 style="font-size: 24px;"> Recuperação de Senha</h2>
                
                <p style="font-size: 16px;">Use o código abaixo no site para recuperar sua senha:</p>

                <div style="display: inline-flex;">
                    @foreach (str_split($token) as $numero)
                        <span> {{ $numero }} </span>
                    @endforeach
                </div>

                <p style="color: rgb(19, 19, 19);">Caso você não tenha solicitado isso, apenas ignore</p>
            </td>
        </tr>
    </table>
</body>
</html>