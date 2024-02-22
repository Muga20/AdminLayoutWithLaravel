
<!-- Main Content -->
<main id="rlr-main" class="">
    <div class="">
        <section class="rlr-section rlr-section__mt ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <div class="rlr-authforms">
                            <div class="rlr-authforms__header">

                                <h2>Create an account</h2>
                                <p>Helps to access all features of the site.</p>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="rlr-authforms__form">
                                    <div class="rlr-authforms__inputgroup"><label
                                            class="rlr-form-label rlr-form-label--light required"> Name </label> <input
                                            type="text" name="name" autocomplete="off"
                                            class="form-control form-control--light" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="rlr-authforms__inputgroup"><label
                                            class="rlr-form-label rlr-form-label--light required"> Email </label> <input
                                            type="email" name="email" autocomplete="off"
                                            class="form-control form-control--light" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="rlr-authforms__inputgroup">
                                        <label class="rlr-form-label rlr-form-label--light required"> Password </label>
                                        <input type="password" autocomplete="off" name="password"
                                            class="form-control form-control--light" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        <p class="help-text">Must be 8 characters or more.</p>
                                    </div>

                                    <div class="rlr-authforms__inputgroup">
                                        <label class="rlr-form-label rlr-form-label--light required"> Confirm Password
                                        </label>
                                        <input type="password" autocomplete="off" name="password_confirmation"
                                            class="form-control form-control--light" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        <p class="help-text"></p>
                                    </div>

                                    <button type="submit"
                                        class="btn rlr-button rlr-button--fullwidth rlr-button--primary">Sign
                                        in</button>

                                </div>
                            </form>
                            <div class="rlr-authforms__notes">
                                <p>Already have an account? <a href="account-pages--login">Log in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<!-- Footer -->


<!-- Scripts -->
<script src="./vendors/navx/js/navigation.min.js" defer></script>
<script src="./js/main.js" defer></script>
</body>

</html>
