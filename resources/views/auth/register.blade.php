<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}


    {{-- EXTRAS --}}
    {{-- <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet"> --}}
</head>
<body>

    <v-app id="app">
        <v-main class="yellow">
            <v-container fluid class="fluid fill-height">
                <v-layout align-center justify-center>
                    <v-sheet>
                        <div class="d-flex py-4 justify-center px-16">
                            <a href="/">
                                <v-img
                                    contain
                                    max-width="150"
                                    lazy-src="img/alsms_banner_sm.png"
                                    src="img/alsms_banner_sm.png"
                                    class="mr-2"
                                ></v-img>
                            </a>
                        </div>
                        <v-card max-width="400" min-width="300" elevation="1" tile class="elevation-0">
                            {{-- <v-card-title>
                                <span class="text-subtitle-1">Register</span>
                            </v-card-title> --}}

                            <v-card-text>
                                <form method="POST" action="">
                                    {{-- <input type="hidden" name="_token" :value="CsrfToken"> --}}
                                    @csrf


                                    @error('name')
                                        <span class="error--text text-caption">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <v-text-field id="name" type="text"
                                        class="@error('name') error--text @enderror"
                                        name="name" value="{{ old('name') }}"
                                        required autocomplete="name"
                                        label="Name"
                                        placeholder="Name"
                                        solo
                                        rounded
                                    ></v-text-field>


                                    @error('username')
                                        <span class="error--text text-caption">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <v-text-field id="username" type="text"
                                        class="@error('username') error--text @enderror"
                                        name="username" value="{{ old('username') }}" required autocomplete="username"
                                        solo
                                        rounded
                                        label="Username"
                                        placeholder="Username"
                                    ></v-text-field>


                                    @error('email')
                                        <span class="error--text text-caption">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <v-text-field id="email" type="email"
                                        class="@error('email') error--text @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="email"
                                        label="Email"
                                        placeholder="Email"
                                        solo
                                        rounded
                                    ></v-text-field>


                                    @error('password')
                                        <span class="error--text text-caption">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <v-text-field id="password" type="password"
                                        class="@error('password') error--text @enderror"
                                        name="password" required autocomplete="new-password" solo
                                        label="Password"
                                        placeholder="Password"
                                        rounded
                                    >
                                    </v-text-field>


                                    <v-text-field id="password-confirm" type="password"
                                        class="form-control" name="password_confirmation"
                                        required autocomplete="new-password"
                                        solo
                                        label="Confirm password"
                                        placeholder="Confirm password"
                                        rounded
                                    >
                                    </v-text-field>

                                    {{-- <br> --}}
                                    <v-sheet class="float-right mb-6">
                                        <v-btn type="submit" color="primary" class=""
                                            rounded
                                        >
                                            Register
                                        </v-btn>
                                    </v-sheet>
                                </form>
                            </v-card-text>
                            <v-card-actions class="d-flex justify-center mt-12">
                                <a href="/login">Login to an Existing Account</a>
                            </v-card-actions>
                        </v-card>
                    </v-sheet>
                </v-layout>
            </v-container>
        </v-main>
    </v-app>
</body>
</html>
