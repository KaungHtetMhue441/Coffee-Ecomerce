@props([
  "script" => ""
])
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>
    {{$title}}
  </title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <!-- End Fonts -->

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{asset("css/client/bootstrap/dist/css/bootstrap.min.css")}}">
  <link rel="stylesheet" href="{{asset("css/client/custom.css")}}" />
  <link rel="stylesheet" href="{{asset("css/client/animate.css")}}">
  <link rel="stylesheet" href="{{asset("css/client/fontStyle.css")}}">

  <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
</head>

<body>
  <div style="position:relative;">
    <x-client.nav.nav>

    </x-client.nav.nav>
    <div class="container-fluid" style="padding:0px 80px;">
      {{$content}}

    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
  {{$script}}
</body>

</html>