@extends('admin.layouts.master')

@section('content')
    <div class="body-wrapper">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        <p>This is Ratnadeep admin dashboard.</p>
    </div>
@endsection
