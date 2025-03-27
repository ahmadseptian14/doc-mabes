<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Inventory Doc Mabes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/admin/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["/admin/assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="/admin/assets/css/demo.css" />
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body>
    @inertia

    <!--   Core JS Files   -->
    <script src="/admin/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="/admin/assets/js/core/popper.min.js"></script>
    <script src="/admin/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="/admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="/admin/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="/admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="/admin/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="/admin/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    {{-- <script src="/admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> --}}

    <!-- jQuery Vector Maps -->
    <script src="/admin/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="/admin/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="/admin/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="/admin/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="/admin/assets/js/setting-demo.js"></script>
    <script src="/admin/assets/js/demo.js"></script>
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#177dff",
         fillColor: "rgba(23, 125, 255, 0.14)",
       });

       $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#f3545d",
         fillColor: "rgba(243, 84, 93, .14)",
       });

       $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
         type: "line",
         height: "70",
         width: "100%",
         lineWidth: "2",
         lineColor: "#ffa534",
         fillColor: "rgba(255, 165, 52, .14)",
       });
    </script>
</body>

</html>
