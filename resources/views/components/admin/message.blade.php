
{{--Success message  --}}
@if(session()->has('success'))

    <script>
        $(document).ready(function(){
            swal({
                title: "Success!",
                text: "{{session('success')}}",
                icon: "success",
            });
        })
    </script>
@endif

@if(session()->has('error'))
    <script>
        $(document).ready(function(){
            swal({
                title: "Error!",
                text: "{{session('error')}}",
                icon: "error",
            });  
        })
    </script>
@endif