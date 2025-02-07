<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <!-- <script src="{{asset("assets/js/core/jquery-3.7.1.min.js")}}"></script> -->
    <script type="module">
        $(document).ready(function() {
            toastr.success('Order successfully delivered!', 'Success', {
                positionClass: 'toast-top-right',
                closeButton: true,
                progressBar: true,
                timeOut: 5000,
                fadeOut: 1000
            });
        });
    </script>
</body>

</html>