@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/managepayment.css') }}" />
@section('content')

<div class="container-fluid p-2">
    @livewire('ManagePayment');

</div>





@endsection