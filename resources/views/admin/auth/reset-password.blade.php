@section('title', 'admin reset Password Page')
<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
@include('admin.partials.authHead')

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->


                        @include('admin.partials.authLogo')
                        <!-- /Logo -->
                        <h4 class="mb-2">Reset Password? 🔒</h4>

                        <!-- Session Status -->

                        <form id="formAuthentication" class="mb-3" method="POST"
                            action="{{ route('password.store') }}">
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">


                            {{-- email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $request->email }}" placeholder="Enter your email" autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            </div>

                            {{-- password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            {{-- password confirmation --}}
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                            </div>




                            <button class="btn btn-primary d-grid w-100">Reset Password</button>
                        </form>


                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    @include('admin.partials.authScripts')
</body>

</html>
