@extends('adminlte::page')

@section('title', 'Dashboard')
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
<script src="cart/js/taildwind.js"></script>

{{-- @section('content_header')
    <h1>Dashboard</h1>
@stop --}}

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop