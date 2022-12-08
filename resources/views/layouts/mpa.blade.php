<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="token" id="token" value="{{ csrf_token() }}">

    {{-- <meta name="auth-user" content="{{ auth()->user() }}"> --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        window.AuthUser = {!! json_encode(auth()->user()) !!};
        window.CsrfToken = "{!! csrf_token() !!}";
    </script>

    <script src="{{ mix('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/xlsx/xlsx.core.min.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('js/xlsx/shim.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/xlsx/xlsx.full.min.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('js/xlsx/xlsx.mini.min.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- EXTRAS --}}
    <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet">

    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet"> --}}

    <style>

    </style>
</head>
<body>
    <div id="app">
        <v-app>
            <v-app-bar class="elevation-0" app color="primary">
                {{-- <v-toolbar-title>{{ config('app.name') }}</v-toolbar-title> --}}
                <a href="/">
                    <v-img
                        contain
                        max-width="150"
                        lazy-src="/img/alsms_banner_sm.png"
                        src="/img/alsms_banner_sm.png"
                        class="mr-2"
                    ></v-img>
                </a>
                <v-spacer></v-spacer>
                <div class="mr-8">
                    {{-- <v-btn color="transparent" depressed dense rounded
                        href="/"
                        class="text-subtitle-1 font-weight-bold blue--text"
                    >Home</v-btn> --}}
                    <v-btn color="transparent" depressed dark
                        href="/"
                        class="text-subtitle-2 font-weight-bold"
                    >Home</v-btn>
                    <v-btn color="transparent" depressed dark
                        href="/announcements"
                        class="text-subtitle-2 font-weight-bold"
                    >Announcements</v-btn>
                    <v-btn color="transparent" depressed dark
                        href="/about"
                        class="text-subtitle-2 font-weight-bold"
                    >About</v-btn>
                </div>

                <div class="mr-4">
                    @auth
                        <v-btn class="ml-2" color="primary lighten-1" small depressed
                            href="/{{ Auth::user()->user_type }}/dashboard"
                            title="Go to Dashboard"
                        >
                            {{ Auth::user()->name }}
                        </v-btn>
                    @endauth

                    @guest()
                        <v-btn class="ml-2" small depressed color="primary lighten-1" href="/login">
                            Login
                        </v-btn>
                        <v-btn class="ml-2" small depressed color="primary lighten-1" href="/register">
                            Register
                        </v-btn>
                    @endguest
                </div>

                {{-- <template v-slot:extension>
                    <v-tabs align-center>
                        <v-tab>Tab 1</v-tab>

                        <v-tab>Tab 2</v-tab>

                        <v-tab>Tab 3</v-tab>
                    </v-tabs>
                </template> --}}
            </v-app-bar>

            <v-main>
                <v-container fluid class="pa-0">
                    @yield('content')
                </v-container>

                <v-footer color="primary" class="py-12" paddless dark>
                    <v-row justify="center" no-gutters>
                        <v-col class="text-center py-4">
                            Copyright (C) 2022
                        </v-col>
                    </v-row>
                </v-footer>
            </v-main>
        </v-app>
    </div>
</body>
</html>
