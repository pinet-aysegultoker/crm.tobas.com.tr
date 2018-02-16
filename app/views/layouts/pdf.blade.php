<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ base_path('public/assets/css/icons.min.css') }}" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ base_path('public/assets/css/pdf.min.css') }}" crossorigin="anonymous" />
    <style>
        body {
            font-size: 10px;
            color: #2B2B2B;
            page-break-inside: avoid;
        }
        .pdf-border {
            border: 1px solid #2B2B2B;
        }
        .pdf-title {
            padding-top: 16px;
        }
        .pdf-table {
            margin: 0;
        }
        .padding-zero {
            padding: 0;
        }
        .pdf-content {
            margin-top: 16px;
            margin-bottom: 8px;
        }
        .pdf-footer {
            margin-top: 64px;
            height: 50px;
        }.margin-top-5 {
             margin-top: 5px;
         }
        .margin-top-10 {
            margin-top: 10px;
        }
        .margin-top-20 {
            margin-top: 20px;
        }
        .padding-top-5 {
             padding-top: 5px;
         }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
