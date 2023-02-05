<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset("assets/css/adminlte.min.css") }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
        <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}">
        <link rel="stylesheet" href="{{ asset("assets/css/select2.min.css") }}">
        @if(request()->routeIs(["departments", "employees"]))
            <link rel="stylesheet" href="{{ asset("assets/css/dataTables.bootstrap4.min.css") }}">
        @endif

        <title>@yield("title") - {{ config("app.name") }}</title>
    </head>
    <body class="flex-column justify-content-center sidebar-mini layout-fixed">
        @yield("content")

        <script src="{{ asset("assets/js/jquery.slim.min.js") }}"></script>
        <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
        <script src="{{ asset("assets/js/adminlte.min.js") }}"></script>
        <script src="{{ asset("assets/js/bs-custom-file-input.min.js") }}"></script>
        <script src="{{ asset("assets/js/select2.full.min.js") }}"></script>
        <script src="{{ asset("assets/js/jquery.inputmask.min.js") }}"></script>

        @if(request()->routeIs(["departments", "employees"]))
            <script src="{{ asset("assets/js/jquery.dataTables.min.js") }}"></script>
            <script src="{{ asset("assets/js/dataTables.bootstrap4.min.js") }}"></script>
            <script>
                $("#data-table").DataTable({
                    responsive: true,
                    lengthChange: false,
                    autoWidth: true,
                    pageLength: 10
                })
            </script>
        @endif
        <script>
            $(function () {
                bsCustomFileInput.init();
            });

            $(".select2").select2()
            $("[data-mask]").inputmask()
        </script>
    </body>
</html>
