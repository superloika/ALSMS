@extends('layouts.mpa')

@section('content')
<v-container>
    <v-row>
        <v-col md="8">
            <v-container>
                <v-img
                    height="300px"
                    width="720"
                    src="/storage/attachments/cp/{{ $program->id }}/{{ $program->cover_photo }}"
                >
                </v-img>
            </v-container>
            <v-container class="mt-4">
                <p class="text-h4 primary--text">{{ $program->title }}</p>
                <small class="accent--text">{{ $program->description_short }}</small>
            </v-container>
            <v-container class="">
                <p>
                    {!! nl2br($program->description_long) !!}
                </p>
            </v-container>
            {{-- @auth
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
            @endguest --}}
            @auth
            {{-- storage/attachments/programs/6 --}}
                @php
                    $attachments = json_decode($program->attachments)
                @endphp
                @if (count($attachments)>0)
                    <v-container>
                        <div class="text-overline">
                            Attachments
                        </div>
                        @foreach ($attachments as $a)
                            <a href="/storage/attachments/programs/{{ $program->id }}/{{ $a }}" target="_blank">
                                {{ $a }}
                            </a>
                        @endforeach
                    </v-container>
                @endif
            @endauth
        </v-col>
        <v-col md="4">

        </v-col>
    </v-row>
</v-container>
@endsection
