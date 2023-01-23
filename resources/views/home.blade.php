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
            max-width="500"
            min-width="400"
            lazy-src="img/alsms-logo.png"
            src="img/alsms-logo.png"
        ></v-img>
    </v-container>

    <v-container fluid class="d-flex justify-center  pa-8 pb-12">
        <v-row>
            <v-col cols="12" class="d-flex justify-center">
                <p class="text-h4 primary--text">Learning Programs Offered</p>
            </v-col>
            @foreach ($programs as $p)
                <v-col cols="12" md="4">
                    <v-card>
                        <v-img
                            height="200px"
                            lazy-src="img/study.png"
                            src="img/study.png"
                        >
                        </v-img>

                        <v-card-title class="primary--text">
                            <a href="{{ route('programs.view',$p->slug) }}">
                                {{ $p->title }}
                            </a>
                        </v-card-title>
                        <v-card-text>
                            <v-container style="
                                white-space: nowrapx ;
                                word-break: normalx;
                                overflow: hidden ;
                                text-overflow: ellipsis;
                                max-height:60px;
                            ">
                                {{ $p->description_short }}
                            </v-container>
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
