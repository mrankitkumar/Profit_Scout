@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/manageReports.css') }}" />
@section('content')



<div class="container-fluid p-2">
    @livewire('AdminReports');
</div>
@endsection