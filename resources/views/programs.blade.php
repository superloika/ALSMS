@extends('layouts.mpa')

@section('content')
    <v-container class="d-flex justify-center mt-4">
        <p class="text-h4 primary--text">Learning Programs Offered</p>
    </v-container>
    <v-container class="d-flex justify-center">
        <v-row>
            @foreach ($programs as $p)
                <v-col cols="12" md="4">
                    <v-card outlined>
                        <v-card-title class="primary--text">{{ $p->title }}</v-card-title>
                        <v-card-text>
                            {{ $p->description_short }}
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary"
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
