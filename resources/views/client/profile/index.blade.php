<x-client.app>
    <x-slot name="style">
        <style>
            a {
                text-decoration: none;
            }

            .active {
                border-bottom: 2px solid white !important;
                color: gray !important;
            }

            .nav a {
                border-bottom: 2px solid transparent;
                transition: border-bottom 0.3s ease;
                /* Adjust the timing and easing as needed */
            }

            .profile {
                height: 550px;
            }

            .profile * {
                color: white !important;
            }

            .nav a:hover {
                border-bottom: 2px solid white;
            }

            .sidebar .nav-link {
                color: #333;
                padding: 15px;
                font-size: 16px;
                border-radius: 5px;
            }

            .sidebar .nav-link:hover,
            .sidebar .nav-link.active {
                background-color: #007bff;
                color: white;
            }

            .profile-pic {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
                margin-bottom: 10px;
            }
        </style>
    </x-slot>
    <x-slot name="title">
        Profile
    </x-slot>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> -->

    <x-slot name="content">
        <div class="container-fluid">
            <div class="row d-flex flex-row-reverse pt-5">
                <!-- Sidebar -->
                <x-client.profile.sidebar pageName="orders"></x-client.profile.sidebar>
                <!-- Main Content -->
                <main class="col-md-7 col-lg-9 content">
                    <div class="card p-3">
                        <div class="card-body">
                            <x-client.profile.orders :orders="$orders" :type="$status">

                            </x-client.profile.orders>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div
            class="modal fade"
            id="profileModal"
            tabindex="-1"
            aria-labelledby="profileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profileModalLabel">
                            Edit Profile
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-client.profile.edit :user="$user">

                        </x-client.profile.edit>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="script">
        <script>
            $(document).ready(function() {
                // Sidebar navigation
                $(".custom_nav_link").click(function(e) {
                    e.preventDefault();
                    $(".nav-link").removeClass("active");
                    $(this).addClass("active");

                    let tab = $(this).data("tab");
                    $(".tab-content").addClass("d-none");
                    $("#" + tab).removeClass("d-none");
                });

                // Open edit profile modal
                $("#editProfile").click(function() {
                    $("#profileModal").modal("show");
                });

                // Save changes
                $("#profileForm").submit(function(event) {
                    event.preventDefault();

                    let newName = $("#profileName").val();
                    let newEmail = $("#profileEmail").val();
                    let newPic = $("#profilePic").val();

                    $("#userName").text(newName);
                    $("#userEmail").html(
                        '<i class="fas fa-envelope"></i> ' + newEmail
                    );
                    $("#profileImage").attr("src", newPic);

                    $("#profileModal").modal("hide");
                });
            });


            //For Order Page
            $(document).ready(function() {
                $('#orderStatus').on('change', function() {
                    window.location.href = $(this).val();
                });
            });

            flatpickr("#from_datepicker", {
                enableTime: false, // Set to true if you want to include time selection
                dateFormat: "Y-m-d",
                // Customize the date format as needed
                defaultDate: "{{request()->get('from')}}"
            });
            flatpickr("#to_datepicker", {
                enableTime: false, // Set to true if you want to include time selection
                dateFormat: "Y-m-d", // Customize the date format as needed
                defaultDate: "{{request()->get('to')}}"
            });
        </script>
    </x-slot>
</x-client.app>