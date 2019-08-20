@extends('layouts.app')

@section('content')
<div class="container">
    <messages :user="{{auth()->user()}}"></messages>
</div>
@endsection
