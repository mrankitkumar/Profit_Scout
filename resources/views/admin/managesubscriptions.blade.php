@extends('admin.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url('css/managesubscription.css') }}" />
@section('content')

<div class="container-fluid p-1">
  @livewire('ManageSubscription');
</div>






@endsection