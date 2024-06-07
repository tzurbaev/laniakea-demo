@extends('layouts.app')

@section('heading', $heading)

@section('page')
  <api-form :form="{{ $form }}"></api-form>
@endsection
