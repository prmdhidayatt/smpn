<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates') }}/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page"
    style="background:url({{ asset('templates') }}/dist/img/blurlogo.png)
no-repeat center center fixed; background-size: cover;
 -webkit-background-size: cover;
 -moz-background-size: cover; -o-background-size: cover;">
    <button type="button" class="btn btn-success" onclick="toggleFullScreen()" id="fullscreen-btn"
        style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <i class="fas fa-expand"></i>
    </button>
    <style>
        body {
            background: url('{{ asset('templates') }}/dist/img/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-box {
            width: 360px;
            margin: 7% auto;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            color: white;
            transition: 0.3s;
        }

        .card-header,
        .card-body {
            background: transparent;
        }

        .form-control,
        .custom-select {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: 0.3s;
        }

        .custom-select {
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .form-control:hover,
        .form-control:focus,
        .custom-select:hover,
        .custom-select:focus {
            background-color: rgba(255, 255, 255, 0.6);
            color: black;
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        @keyframes jedagJedug {
    0%, 100% {
        transform: scale(1);
        text-shadow: 0 0 5px #00c0ef;
    }
    25% {
        transform: scale(1.1);
        text-shadow: 0 0 15px #00c0ef;
    }
    50% {
        transform: scale(0.95);
        text-shadow: 0 0 10px #00c0ef;
    }
    75% {
        transform: scale(1.05);
        text-shadow: 0 0 20px #00c0ef;
    }
}

.jedagjedug {
    animation: jedagJedug 1s infinite ease-in-out;
    display: inline-block;
}



.watermark {
    animation: fadeInBottom 1s ease-in-out;
}

    </style>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="text-center mt-3">
                <img src="{{ asset('templates') }}/dist/img/remove.png" width="110px">
            </div>
            <div class="card-header text-center">
                <h1 class="text-white" style="font-size: 28px; margin: 0; white-space: nowrap;">
                    <strong>SMP NEGERI 1 KREJENGAN</strong>
                </h1>
            </div>
            
            
            <div class="card-body">
                <p class="login-box-msg">Login Untuk Memulai Sesi Anda</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Nama Pengguna">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Masukkan kata Sandi">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="input-group mb-3">
                        <select name="role_user" class="custom-select">
                            <option value="">Pilih Peran Pengguna</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div> --}}
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                    </div>

                    <!-- Watermark di dalam login box -->
<!-- Watermark di dalam login box dengan animasi -->
<!-- Watermark di dalam login box dengan efek jedag jedug -->
<div class="text-center mt-4" style="color: white; font-size: 14px; opacity: 0.9;">
    <span class="jedagjedug" style="font-style: italic;">
        &#x2728; Created by <strong style="color: #00c0ef;">ZeroDerik</strong> &#x2728;
    </span>
</div>


                </form>
            </div>
        </div>
    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('templates') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templates') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('templates') }}/dist/js/adminlte.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('templates') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('templates') }}/plugins/toastr/toastr.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function () {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            @if (Session::get('sukses'))
                toastr.success('{{ Session::get('sukses') }}')
            @elseif (Session::get('gagal'))
                toastr.error('{{ Session::get('gagal') }}')
            @elseif (Session::get('info'))
                toastr.warning('{{ Session::get('info') }}')
            @endif
        });
    </script>
    <script>
        function toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }
    </script>

</body>

</html>
