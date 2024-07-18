@section('title', 'admin Register Page')

<!DOCTYPE html>


<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets-admin') }}/" data-template="vertical-menu-template-free">

@include('admin.partials.authHead')

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        @include('admin.partials.authLogo')

                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to admin Dashboard! 👋</h4>


                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('admin.register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">name</label>
                                <input type="text" class="form-control" id="name" :value="old('name')"
                                    name="name" placeholder="Enter your username" autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" :value="old('email')" class="form-control" id="email"
                                    name="email" placeholder="Enter your email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" autocomplete="new-password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password Confirmation</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            {{-- <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        I agree to
                                        <a href="javascript:void(0);">privacy policy & terms</a>
                                    </label>
                                </div>
                            </div> --}}

                            <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
                        </form>

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ route('admin.login') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->


    @include('admin.partials.authScripts')
</body>

</html>
