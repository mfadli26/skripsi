<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pusat Peminjaman Arsip</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="/css/app.css" rel="stylesheet">
    <!-- Styles -->

    <style>
        .btn-hover:hover {
            color: red !important;
        }

        .btn-hover {
            transition: color 0.2s linear;
        }

        .link-active {
            color: rgb(103, 195, 199) !important;
        }

        .outer {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(0deg,
                    rgba(103, 195, 199, 1) 6%,
                    rgba(28, 180, 187, 1) 17%,
                    rgba(40, 142, 146, 1) 63%);
            transition: 0.5s;
            margin-inline: 2.5%;
        }

        .outer.active {
            background: #288d91;
        }

        .box {
            position: relative;
            width: 1100px;
            height: 500px;
            margin: 20px;
            /* background:#ff0; */
        }

        .blueBg {
            position: absolute;
            top: 40px;
            width: 95%;
            height: 420px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0, 2);
            box-shadow: 0 5px 45px rgba(0, 0, 0, 0.15);
        }

        .blueBg .box {
            position: relative;
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .blueBg .box h2 {
            color: #fff;
            font-size: 1.2em;
            font-size: 500;
            margin-bottom: 10px;
        }

        .blueBg .box button {
            cursor: pointer;
            padding: 10px 20px;
            background: #fff;
            color: #333;
            font-size: 16px;
            font-weight: 500;
            border: none;
        }

        .formBx {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            background: #fff;
            z-index: 1000;
            display: flex;
            justify-content: center;
            /* align-items:center; */
            box-shadow: 0 5px 45px rgba(0, 0, 0, 0.25);
            transition: 0.5s ease-in-out;
            overflow: hidden;
            border-radius: 15px;
        }

        .formBx.active {
            left: 50%;
        }

        .formBx .form {
            position: absolute;
            left: 0;
            width: 100%;
            padding: 50px;
            transition: 0.5s;
        }

        .formBx .signinForm {
            transition-delay: 0.25s;
        }

        .formBx.active .signinForm {
            left: -100%;
            transition-delay: 0s;
        }

        .formBx .signupForm {
            left: 100%;
        }

        .formBx.active .signupForm {
            left: 0%;
        }

        .formBx .form form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .formBx .form form h3 {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .formBx .form form input {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            outline: none;
            font-size: 16px;
            border: 3px solid #288d91;
        }

        .formBx .form form .forgot {
            color: #333;
        }

        .box .signup h2 {
            color: whitesmoke;
            font-weight: 900;
        }

        @media (max-width: 991px) {
            .box {
                max-width: 400px;
                height: 650px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .box .blueBg {
                top: 0;
                height: 100%;
            }

            .formBx {
                width: 100%;
                height: 500px;
                top: 0;
                box-shadow: none;
            }

            .formBx {
                width: 100%;
                height: 500px;
                top: 0;
                box-shadow: none;
            }

            .blueBg .box {
                position: absolute;
                width: 100%;
                height: 150px;
                bottom: 0;
            }

            .box.signin {
                top: 0;
            }

            .formBx.active {
                left: 0;
                top: 150px;
            }
        }

        .signupForm {
            height: 100%;
            background-color: #32a1fa;
            background-size: cover;
        }

        .signinForm {
            height: 100%;
            background: #32a1fa;
        }

        .signinForm p {
            color: white;
        }

        .signinForm .icon-contact {
            color: #2dcbd1;
        }

        .signinForm span {
            color: white;
            margin-left: 15px;
            font-size: 0.8em;
        }

        .signinForm .context-contact {
            color: whitesmoke;
        }

        .signinForm .icon-contact a {
            padding: 10px;
            background: whitesmoke;
            border-radius: 50%;
        }

        .signinForm .circle {
            position: absolute;
            bottom: -15%;
            right: -10%;
            height: 200px;
            width: 200px;
            background: whitesmoke;
            border-radius: 50%;
        }

        .signinForm .circle-next {
            position: absolute;
            bottom: 10%;
            right: 10%;
            height: 100px;
            width: 100px;
            background: #289094;
            border-radius: 50%;
            opacity: 0.9;
        }

        .label-contact {
            color: white;
            font-size: 0.9em;
        }
    </style>

</head>

<body class="antialiased d-flex flex-column h-100">
    <main class="flex-shrink-0">
        @include('sweetalert::alert')
        @include('client.layout.header_arsip')
        @include('client.layout.breadcrumb_arsip')
        <div class="row container m-auto">
            <div class="outer my-5">
                <div class="Container mt-5 box">
                    <div class="blueBg">
                        <div class="box signin">
                            <h2>Mari Bangun Kab.Sarolangun Bersama.</h2>
                            <Button outline color="warning" class="signinBtn">
                                Kembali
                            </Button>
                        </div>
                        <div class="box signup">
                            <Button outline color="primary" class="signupBtn">
                                Get In Touch
                            </Button>
                        </div>
                    </div>
                    <div class="formBx">
                        <div class="form signinForm">
                            <p>Informasi Kontak</p>
                            <p class="context-contact">
                                Fill up them form and our Team will get back to you within
                                24 hours.
                            </p>
                            <p class="mt-5 icon-contact">
                                <a>
                                    <i class="bi bi-envelope-fill"></i>
                                </a>
                                <span> dispuparsar@mail.com</span>
                            </p>
                            <p class="mt-5 icon-contact">
                                <a>
                                    <i class="bi bi-telephone-fill"></i>
                                </a>
                                <span> +62819210XXX</span>
                            </p>
                            <p class="mt-5 icon-contact">
                                <a>
                                    <i class="bi bi-geo-alt-fill"></i>
                                </a>
                                <span>Jalan Soekarno Hatta No X, Bandung</span>
                            </p>
                            <div class="circle"></div>
                            <div class="circle-next"></div>
                        </div>

                        <div class="form signupForm">
                            <div class="container">
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <Label class="label-contact">Nama Depan</Label>
                                        <Input type="text" class="form-control" name="email" id="exampleEmail" placeholder="Enter your first name" />
                                    </div>
                                    <div class="col-md-6">
                                        <Label class="label-contact">Nama Belakang</Label>
                                        <Input type="text" class="form-control" name="password" id="examplePassword" placeholder="Enter your last name" />
                                    </div>
                                    <div class="col-md-6">
                                        <Label class="label-contact">Mail</Label>
                                        <Input type="email" class="form-control" name="password" id="examplePassword" placeholder="Enter your Email" />
                                    </div>
                                    <div class="col-md-6">
                                        <Label class="label-contact">Phone</Label>
                                        <Input type="text" class="form-control" name="password" id="examplePassword" placeholder="Enter your Phone" />
                                    </div>
                                    <div class="col-12">
                                        <Label class="label-contact">Message</Label>
                                        <textarea class="form-control" name="password" id="examplePassword" placeholder="Enter your message"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <Button class="text-white btn fs-4 btn-primary mt-1" style=" width: 100%; background-color : #5ab8c7;">
                                            Kirim Pesan
                                        </Button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('client.layout.footer_arsip')
    <script src="/js/app.js"></script>
</body>
<script>
    const signinBtn = document.querySelector(".signinBtn");
    const signupBtn = document.querySelector(".signupBtn");
    const formBx = document.querySelector(".formBx");
    const outer = document.querySelector(".outer");

    signupBtn.onclick = function() {
        formBx.classList.add("active");
        outer.classList.add("active");
    };

    signinBtn.onclick = function() {
        formBx.classList.remove("active");
        outer.classList.remove("active");
    };
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip1"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

</html>