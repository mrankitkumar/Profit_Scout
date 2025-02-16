@extends('user.master')
@section('title', 'test')
<link rel="stylesheet" href="{{ url("css/subscription.css")}}" />
@section('content')

<div class="content-header">
  @livewire('UserSubscription');
</div>


@endsection