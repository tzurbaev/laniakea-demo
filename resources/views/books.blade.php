@extends('layouts.app')

@section('heading', 'Books')

@section('page')
  <books-list :authors="{{ json_encode($authors) }}" :genres="{{ json_encode($genres) }}"></books-list>
@endsection
