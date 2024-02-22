<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> WestHill </title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body class="bg-gray">
    <!-- signin-page-Start -->
    <div class="signin-page-area pd-top-120 pd-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7">
                    <form class="signin-inner" action="{{ route('login') }}"
                    method="POST"
                    >
                        @csrf
                        <div class="row">

                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="text" name="email" placeholder="Email">
                                </label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="password" name="password" placeholder="Password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </label>
                            </div>
                            <div class="col-12 mb-4">
                                <button type="submit" class="btn btn-base w-100">Sign In</button>
                            </div>
                            <div class="col-12">
                                {{-- <a href="#">Forgottem Your Password</a> --}}
{{--                                <a href="/register"><strong>Signup</strong></a>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/vendor.js"></script>
    <!-- main js  -->
    <script src="westhill/assets/js/main.js"></script>
</body>
</html>





{{-- <!-- Main Content -->
<main id="rlr-main" class="">
    <div class="">
        <section class="rlr-section rlr-section__mt rlr-account">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">

                         <form method="POST" class="rlr-authforms" action="{{ route('login') }}">
                            @csrf
                            <div class="rlr-authforms__header">
                                <h2>Log in </h2>
                                <p>Welcome back! Please enter login details.</p>
                            </div>
                            <div class="rlr-authforms__form">
                                <div class="rlr-authforms__inputgroup"><label
                                        class="rlr-form-label rlr-form-label--light required"> Email </label> <input
                                        type="email" name="email" autocomplete="off" class="form-control form-control--light" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="rlr-authforms__inputgroup"><label
                                        class="rlr-form-label rlr-form-label--light required"> Password </label> <input
                                        type="password" name="password" autocomplete="off" class="form-control form-control--light" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="rlr-authforms__forgotpassword">
                                    <div class="form-check-inline">
                                        <input class="form-check-input rlr-form-check-input" id="rlr-checkbox-1"
                                            type="checkbox" value="defaultValue" />
                                        <label
                                            class="rlr-form-label rlr-form-label--checkbox rlr-form-label--font-inherit rlr-form-label--bold"
                                            for="rlr-checkbox-1">Remember me on this device</label>
                                    </div>
                                    <a href="account-pages--forgot-password">Forgot password</a>
                                </div>
                                <button type="submit"
                                    class="btn mb-3 rlr-button rlr-button--fullwidth rlr-button--primary">Sign
                                    in</button>

                            </div>
                            <div class="rlr-authforms__notes">
                                <p>Don’t have an account? <a href="/register">Sign up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<!-- Footer --> --}}


