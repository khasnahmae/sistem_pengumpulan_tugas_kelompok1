<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.M.T</title>
    <!-- Bootstrap CSS -->
    <!-- Include SweetAlert2 CSS and JS (replace with the correct file paths) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Optional: Add your own CSS styles here -->
    <style>
        body {
            background-color: hsl(0, 0%, 96%);
        }
    </style>
</head>


<body>
    <!-- Jumbotron -->
    <div class="text-lg-start m-5 px-4 py-5 text-center" style="background-color: hsl(0, 0%, 96%)">
        @if(Session::has('error'))
        <div class="alert d-flex align-items-center justify-content-center" role="alert">
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        </div>
        @endif
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-lg-0 mb-5">
                    <h1 class="display-5 fw-bold ls-tight my-5">
                        Sistem Manajemen Tugas <br />
                        <span class="text-primary">Mahasiswa</span>
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        Selamat Datang di Website uuntuk manajemen tugas mahasiswa!
                    </p>
                </div>

                <div class="col-lg-6 mb-lg-0 mb-5">
                    <div class="card">
                        <div class="card-body px-md-5 py-5">
                            <form action="/login" method="post">
                                @csrf
                                <h3 class>Login</h3>
                                <!-- Email input -->
                                <div class="form-outline mb-4 mt-4">
                                    <label class="form-label" for="form3Example3">Email address</label>
                                    <input type="email" name="email" id="form3Example3" class="form-control" />
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <input type="password" name="password" id="form3Example4" class="form-control" />
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- Optional: Add your own JavaScript scripts here -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Jika pesan error dari server tersedia, tampilkan SweetAlert2
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ $errors->first() }}',
                });
            @endif
        });
    </script>
    
</body>

</html>
