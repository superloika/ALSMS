@extends('layouts.mpa')

@section('content')
<v-container>
    <v-row>
        <v-col md="8">
            <v-container class="mt-4">
                <p class="text-h4 primary--text">{{ $program->title }}</p>
                <small class="accent--text">{{ $program->description_short }}</small>
            </v-container>
            <v-container class="">
                <p>
                    {{ $program->description_long }}
                </p>
            </v-container>
            @auth
                @if (auth()->user()->user_type=='student')
                    <v-container>
                        <v-btn rounded color="primary" href="/student/classes">Enroll Now</v-btn>
                    </v-container>
                @endif
            @endauth
            @guest
                <v-container>
                    <v-btn rounded color="primary" href="/student/classes">Enroll Now</v-btn>
                </v-container>
            @endguest
        </v-col>
        <v-col md="4">

        </v-col>
    </v-row>
</v-container>
@endsection
