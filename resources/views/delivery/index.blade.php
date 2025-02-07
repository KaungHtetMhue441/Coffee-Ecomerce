<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="user-id" content="{{ auth()->id() }}">

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card shadow col-8">
                <div class="card-body">
                    <video id="preview"></video>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="qr_result" name="qr_code" readonly>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="module">
        Instascan.Camera.getCameras().then(cameras => {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert("No cameras found.");
            }
        }).catch(e => console.error(e));

        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        scanner.addListener('scan', function(content) {
            document.getElementById('qr_result').value = content;
            confirmDelivery(content);
        });

        function confirmDelivery(qrCode) {

            if (!qrCode) {
                alert("Please scan the QR code first.");
                return;
            }

            // Send the confirmation request to the server
            fetch("/confirm-delivery/" + qrCode, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}" // Add CSRF token for security
                    }
                })
                .then(response => response.json())
                .then(data => {
                    $(document).ready(function() {
                        toastr.success('Order successfully delivered!', 'Success', {
                            positionClass: 'toast-top-right',
                            closeButton: true,
                            progressBar: true,
                            timeOut: 5000,
                            fadeOut: 1000
                        });

                        setTimeout(function() {
                            window.href = ""
                        }, 3000)
                    });
                }) // Show server response
                .catch(error => {
                    toastr.error(error, 'Error', {
                        positionClass: 'toast-top-right',
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,
                        fadeOut: 1000
                    });
                });
        }
    </script>
</body>

</html>