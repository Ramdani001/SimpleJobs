<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ 'images/logo.png' }}">
    <title>SimpleJobs</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ 'bootstrap/css/bootstrap.css' }}">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="{{ 'fontawesome/css/all.css' }}">

    <style>

        * {
            padding: 0;
            margin: 0;
        }

        a{
            text-decoration: none;
        }

        body{
            background-color: #e8eff9;
        }

        form{
            padding: 50px 10px;
            border-radius: 10px;
            background-color: white;
        }

        @media (min-width: 777px) {
            form{
                width: 20%;
            }
        }

        @media screen and (max-width: 776px) {
            form{
                width: 90%;
            }
        }
    </style>

</head>
<body>
       <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100vh;">
        <form class="shadow" action="{{ '/ceklogin' }}" method="POST">
            @csrf

            <div class="d-flex justify-content-center">
                <img src="{{ 'images/logo.png' }}" alt="">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="d-flex">
                    <input type="password" class="form-control" id="password" name="password">
                    <button type="button" id="openPass" style="background-color: white; border: none;">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <button type="button" class="d-none" id="closePass" style="background-color: white; border: none;">
                        <i class="fa-solid fa-eye-low-vision"></i>
                    </button>
                </div>
            </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            <div class="mt-2">
                Don't have an account? <a href="{{ '/register' }}" style="color: #b0992f;"> Create</a>
            </div>
        </form>
       </div>


    {{-- Script --}}

    {{-- Bootstrap --}}
    <script src="{{ 'bootstrap/js/bootstrap.js' }}"></script>

    {{-- Fontawesome --}}
    <script src="{{ 'fontawesome/js/all.js' }}"></script>

    <script>

        var openPass = document.getElementById('openPass');
        var closePass = document.getElementById('closePass');
        var password = document.getElementById('password');

        openPass.addEventListener('click', function() {
            openPass.classList.add('d-none');
            closePass.classList.remove('d-none');

            password.type = "text";

        });

        closePass.addEventListener('click', function() {
            openPass.classList.remove('d-none');
            closePass.classList.add('d-none');

            password.type = "password";
        });


    </script>

</body>
</html>