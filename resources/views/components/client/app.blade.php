@props([
"script" => "",
"style"=>"",
"showLogin"=>true
])
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>
    {{$title}}
  </title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <!-- End Fonts -->

  <!-- Fonts and icons -->
  <script src="{{asset("assets/js/plugin/webfont/webfont.min.js")}}"></script>
  <script>
    WebFont.load({
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["/assets/css/fonts.min.css"]
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>


  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{asset("css/client/bootstrap/dist/css/bootstrap.min.css")}}">
  <link rel="stylesheet" href="{{asset("css/client/custom.css")}}" />
  <link rel="stylesheet" href="{{asset("css/client/animate.css")}}">
  <link rel="stylesheet" href="{{asset("css/client/fontStyle.css")}}">
  <link rel="stylesheet" href="{{asset("flatpicker/flatpicker.min.css")}}">
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

  {{$style}}
  <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
</head>

<body>
  <div style="position:relative;">
    <x-client.nav.nav :showLogin="$showLogin">

    </x-client.nav.nav>
    <div class="container-fluid p-0">
      {{$content}}
    </div>
    <footer class="text-light py-5 mt-5" style="background-color: #212529">
      <div class="container">
        <div class="row">
          <!-- About Us Section -->
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4">About Us</h5>
            <p>
              We are a leading coffee shop with a passion for serving quality coffee and snacks. Visit us to experience the best in town.
            </p>
            <p>
              <i class="fas fa-map-marker-alt me-2"></i> 123 Coffee Street, Myanmar
            </p>
          </div>

          <!-- Quick Links Section -->
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4">Quick Links</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-light">Home</a></li>
              <li><a href="#" class="text-light">Shop</a></li>
              <li><a href="#" class="text-light">About Us</a></li>
              <li><a href="#" class="text-light">Contact</a></li>
            </ul>
          </div>

          <!-- Social Media & Contact Section -->
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4">Follow Us</h5>
            <a href="#" class="text-light me-3 hvr-float-shadow">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-light me-3 hvr-float-shadow">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-light me-3 hvr-float-shadow">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-light me-3 hvr-float-shadow">
              <i class="fab fa-linkedin-in"></i>
            </a>

            <h5 class="text-uppercase mt-4">Contact Us</h5>
            <p><i class="fas fa-envelope me-2"></i> info@coffeeshop.com</p>
            <p><i class="fas fa-phone me-2"></i> +95 123-456-789</p>
          </div>
        </div>
        <hr class="my-4">
        <div class="row">
          <div class="col-md-12 text-center">
            <p>&copy; {{ date('Y') }} Coffee Shop. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>

  </div>

  <!--   Core JS Files   -->
  <script src="{{asset("assets/js/core/jquery-3.7.1.min.js")}}"></script>
  <script src="{{asset("assets/js/core/popper.min.js")}}"></script>
  <script src="{{asset("assets/js/core/bootstrap.min.js")}}"></script>

  <!-- jQuery Scrollbar -->
  <script src="{{asset("assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js")}}"></script>

  <script src="{{asset("assets/js/plugin/sweetalert/sweetalert.min.js")}}"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="{{asset("js/client/order.js")}}"></script>
  <script src="{{asset("flatpicker/flatpicker.min.js")}}"></script>

  <script type="text/javascript">
    function markAsRead(notificationId, redirectUrl) {
      fetch(`/notifications/${notificationId}/mark-as-read`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': "{{csrf_token()}}",
          'Accept': 'application/json',
        },
      }).then(() => {
        window.location.href = redirectUrl;
      });
    }

    function showToast(message, x, y) {
      Toastify({
        text: message,
        offset: {
          x, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
          y // vertical axis - can be a number or a string indicating unity. eg: '2em'
        },
        duration: 1500,
        class: "info",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
          background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function() {} // Callback after click
      }).showToast();
    }

    window.user_id = parseInt('{{auth()->user()?->id}}');
  </script>
  {{$script}}
</body>

</html>