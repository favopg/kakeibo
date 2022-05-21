<!doctype html>
<head>
 <meta charset="utf-8">
 <meta name = "viewport" content="width=device-width, initial-scale=1">
 <title>家計簿アプリ</title>
 <link href="{{ asset('/css/kakeibo.css').'?'.time() }}" rel="stylesheet">
</head>
<body>
 @yield('content')
 <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
</body>
</html>
