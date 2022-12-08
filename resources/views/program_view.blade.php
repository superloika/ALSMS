@extends('layouts.mpa')

@section('content')
    <v-container class="mt-4">
        <p class="text-h5 primary--text">{{ $program->title }}</p>
        <p class="accent--text">{{ $program->description_short }}</p>
    </v-container>
    <v-container class="">
        <p>
            {{ $program->description_long }}
        </p>
    </v-container>
    @auth
        @if (auth()->user()->user_type=='student')
            <v-container>
                <v-btn rounded color="primary">Enroll Now</v-btn>
            </v-container>
        @endif
    @endauth
    @guest
        <v-container>
            <v-btn rounded color="primary">Enroll Now</v-btn>
        </v-container>
    @endguest
@endsection
