@extends('layouts.mpa')

@section('content')

    {{-- @auth
    <v-container fluid class="d-flex justify-center">
        <p class="primary--text text-h6">
            Welcome {{ Auth::user()->name }}
        </p>
    </v-container>
    @endauth --}}

    <div fluid class="d-flex justify-center p-0 primary">
        <v-img
            contain
            width="100%"
            lazy-src="img/hpbg_1.jpg"
            src="img/hpbg_1.jpg"
        ></v-img>
    </div>

    <v-sheet cols="12" class="d-flex justify-center primary pt-8 pb-4">
        <p class="text-h2 white--text px-12 py-6" style="border:5px solid #fff">Learning Programs</p>
    </v-sheet>
    <v-container fluid class="d-flex justify-center  pa-8 pb-12">
        <v-row>

            @foreach ($programs as $p)
                <v-col cols="12" md="4">
                    <v-card>
                        {{-- <v-img
                            height="200px"
                            lazy-src="img/study.png"
                            src="img/study.png"
                        >
                        </v-img> --}}
                        <v-img
                            height="200px"
                            width="600"
                            src="/storage/attachments/cp/{{ $p->id }}/{{ $p->cover_photo }}"
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
