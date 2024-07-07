<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link
    rel="shortcut icon"
    href="https://templates.iqonic.design/posdash/html/assets/images/favicon.ico"
    />
    <link rel="stylesheet" href="{{asset('assets/css/backend-plugin.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/backende209.css')}}" />
    <link
    rel="stylesheet"
    href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css" integrity="sha512-dC0G5HMA6hLr/E1TM623RN6qK+sL8sz5vB+Uc68J7cBon68bMfKcvbkg6OqlfGHo1nMmcCxO5AinnRTDhWbWsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
    rel="stylesheet"
    href="{{asset('assets/vendor/remixicon/fonts/remixicon.css')}}"
    />
</head>
<body>
    <div class="wrapper">
        @yield('content')
    </div>

    <!-- Backend Bundle JavaScript -->
    <script src="{{asset('assets/js/backend-bundle.min.js')}}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{asset('assets/js/table-treeview.js')}}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{asset('assets/js/customizer.js')}}"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="{{asset('assets/js/chart-custom.js')}}"></script>

    <!-- app JavaScript -->
    <script src="{{asset('assets/js/app.js')}}"></script>
</body>
</html>