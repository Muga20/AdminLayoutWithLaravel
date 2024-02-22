<!DOCTYPE html>
<html lang="en">
@include('user.include.header')

<body>

    <div class="container-scroller">
        @include('user.layouts.nav')
        @include('user.layouts.skin')
        @include('user.layouts.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Edit Personal Details </h4>


                                @if (Session::has('profile_updated'))
                                    <div class="alert alert-success">
                                        {{ Session::get('profile_updated') }}
                                    </div>
                                @endif

                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                                <form class="forms-sample" method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')

                                    <div class="form-group">
                                        <label for="exampleInputName1"> Names </label>
                                        <input type="text" class="form-control" id="exampleInputName1"
                                            placeholder="Enter Your New Names" name="name"
                                            value="{{ old('name') }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1">Email </label>
                                        <input type="email" class="form-control" id="exampleInputName1"
                                            placeholder="Enter Your New Email" name="email"
                                            value="{{ old('email') }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                            <div>
                                                <p class="text-sm mt-2 text-gray-800">
                                                    {{ __('Your email address is unverified.') }}

                                                    <button form="send-verification"
                                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        {{ __('Click here to re-send the verification email.') }}
                                                    </button>
                                                </p>

                                                @if (session('status') === 'verification-link-sent')
                                                    <p class="mt-2 font-medium text-sm text-green-600">
                                                        {{ __('A new verification link has been sent to your email address.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif

                                    </div>

                                    <div class="form-group">

                                        <label>Add or Update Profile Picture </label>

                                        <div class="input-group col-xs-12">
                                            <input type="file" class="form-control file-upload-info" name="image"
                                                id="exampleFormControlFile1" value="">

                                        </div>


                                    </div>
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}
                                        </div>
                                    @enderror

                                    @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                    @endif

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Change Password </h4>


                                @if (Session::has('password_updated'))
                                    <div class="alert alert-success">
                                        {{ Session::get('password_updated') }}
                                    </div>
                                @endif


                                <form class="forms-sample" method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')

                                    <div class="form-group">
                                        <label for="exampleInputName1"> Old Password </label>
                                        <input type="password" class="form-control" id="exampleInputName1"
                                            placeholder="****" name="current_password">

                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1"> New Password </label>
                                        <input type="password" class="form-control" id="exampleInputName1"
                                            placeholder="****" name="password">

                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1"> Confirm New Password </label>
                                        <input type="password" class="form-control" id="exampleInputName1"
                                            placeholder="****" name="password_confirmation">

                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>


                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>

                                    @if (session('status') === 'password-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>




    </div>



    </div>

    @include('user.include.scripts')

</body>

</html>
