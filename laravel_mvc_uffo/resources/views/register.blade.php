<x-layout>
    @push('styles')
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }

            .b-example-divider {
                width: 100%;
                height: 3rem;
                background-color: rgba(0, 0, 0, .1);
                border: solid rgba(0, 0, 0, .15);
                border-width: 1px 0;
                box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
            }

            .b-example-vr {
                flex-shrink: 0;
                width: 1.5rem;
                height: 100vh;
            }

            .bi {
                vertical-align: -.125em;
                fill: currentColor;
            }

            .nav-scroller {
                position: relative;
                z-index: 2;
                height: 2.75rem;
                overflow-y: hidden;
            }

            .nav-scroller .nav {
                display: flex;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
                margin-top: -1px;
                overflow-x: auto;
                text-align: center;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }

            .btn-bd-primary {
                --bd-violet-bg: #712cf9;
                --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

                --bs-btn-font-weight: 600;
                --bs-btn-color: var(--bs-white);
                --bs-btn-bg: var(--bd-violet-bg);
                --bs-btn-border-color: var(--bd-violet-bg);
                --bs-btn-hover-color: var(--bs-white);
                --bs-btn-hover-bg: #6528e0;
                --bs-btn-hover-border-color: #6528e0;
                --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
                --bs-btn-active-color: var(--bs-btn-hover-color);
                --bs-btn-active-bg: #5a23c8;
                --bs-btn-active-border-color: #5a23c8;
            }

            .bd-mode-toggle {
                z-index: 1500;
            }

            .bd-mode-toggle .dropdown-menu .active .bi {
                display: block !important;
            }
        </style>
    @endpush
    <div class="container">
        <main class="py-5">
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-2" src="{{asset('img/main-logo.svg')}}" alt="" width="70" height="70">
                <h2>Register now</h2>
                <p class="lead">Register your restaurant to start receiving orders</p>
            </div>

            <div class="row g-5">
                <div class="col-md-12 col-lg-12">
                    <h4 class="mb-3">Main information</h4>
                    <x-form class="needs-validation" novalidate method="post" action="{{route('public.signup')}}">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="restaurantName" class="form-label">Restaurant Name</label>
                                <input type="text" class="form-control" id="restaurantName" placeholder="" name="name"
                                       required>
                                @error('name')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="restaurantDescription" class="form-label">Description</label>
                                <input type="text" class="form-control" id="restaurantDescription" placeholder=""
                                       value="" name="description"
                                       required>
                                @error('description')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="login" class="form-label">Login</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" id="login" placeholder="Login" required
                                           name="login">
                                    @error('login')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="" value=""
                                       name="password"
                                       required>
                                @error('password')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="passwordConfirmation" class="form-label">Password confirmation</label>
                                <input type="password" class="form-control" id="passwordConfirmation" placeholder=""
                                       value="" required name="password_confirmation">
                                @error('password_confirmation')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="Phone number" class="form-label">Phone number</label>
                                <input type="email" class="form-control" id="Phone number"
                                       placeholder="+1 (555) 222-3333" name="phone_number">
                                @error('phone_number')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St"
                                       required name="address">
                                @error('address')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="formFile" class="form-label">Restaurant logo</label>
                                <input class="form-control" type="file" id="formFile" name="photo">
                                @error('photo')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>

                        </div>

                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Register</button>
                    </x-form>
                </div>
            </div>
        </main>
    </div>
</x-layout>
