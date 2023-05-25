@extends('layouts.master')

@section('page_title', 'My Dashboard')

@section('content')

{{-- Call dashboard page from pages/admin/dashboard --}}
@include('pages.admin.dashboard')


@endsection
