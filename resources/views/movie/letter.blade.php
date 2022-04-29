
@extends('master')

@section('content-top')
    @include('template.category-word')
    @include('template.movie.letter', ['letter' => $letter_list])
@endsection

