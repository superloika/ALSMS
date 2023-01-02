@extends('layouts.mpa')

@section('content')

    {{-- @auth
    <v-container fluid class="d-flex justify-center">
        <p class="primary--text text-h6">
            Welcome {{ Auth::user()->name }}
        </p>
    </v-container>
    @endauth --}}

    <v-container fluid class="d-flex justify-center py-8 primary">
        <v-img
            contain
            max-width="300"
            min-width="200"
            lazy-src="img/alsms-logo.png"
            src="img/alsms-logo.png"
        ></v-img>
    </v-container>

    <v-container fluid class="d-flex justify-center primary lighten-5 pa-8">
        <v-row>
            <v-col cols="12" class="d-flex justify-center">
                <p class="text-h4 primary--text">Learning Programs Offered</p>
            </v-col>
            @foreach ($programs as $p)
                <v-col cols="12" md="4">
                    <v-card>
                        <v-card-title class="primary--text">{{ $p->title }}</v-card-title>
                        <v-card-text>
                            {{ $p->description_short }}
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" text
                                href="{{ route('programs.view',$p->slug) }}"
                            >
                                Learn More
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            @endforeach
        </v-row>
    </v-container>
@endsection
