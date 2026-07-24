<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f3f4f6;
            padding: 40px 0;
        }

        .email-content {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
        }

        .header {
            background-color: #2563eb;
            padding: 24px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 24px;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .body-content {
            padding: 32px 24px;
            text-align: center;
        }

        .body-content p {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.5;
            margin-top: 0;
            margin-bottom: 24px;
        }

        .token-container {
            margin: 10px 0 32px;
            display: inline-block;
            background-color: #f8fafc;
            padding: 16px 24px;
            border-radius: 8px;
            border: 1px dashed #cbd5e1;
        }

        .token-text {
            font-size: 36px;
            font-weight: 800;
            color: #2563eb;
            letter-spacing: 16px;
            margin-right: -16px;
            text-align: center;
        }

        .footer {
            background-color: #f9fafb;
            padding: 24px;
            text-align: center;
            border-top: 1px solid #f3f4f6;
        }

        .footer p {
            color: #9ca3af;
            font-size: 13px;
            margin: 0;
            line-height: 1.4;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="header">
                <h1>Recuperação de Senha</h1>
            </div>
            <div class="body-content">
                <p>Olá! Recebemos uma solicitação para redefinir a senha da sua conta.</p>
                <p>Use o código de segurança abaixo no site para continuar o processo:</p>
                
                <div class="token-container">
                    <div class="token-text">{{ $token }}</div>
                </div>
                <p style="font-size: 13px; color: #64748b; margin-top: -15px; margin-bottom: 30px;">(Dê um clique duplo para copiar o código acima)</p>
            </div>
            <div class="footer">
                <p>Caso você não tenha solicitado isso, apenas ignore este email. Sua conta continuará segura.</p>
            </div>
        </div>
    </div>
</body>
</html>