@extends('layouts.master')

@section('content')
<div class="container">
<router-view :user="{{ Auth::user() }}"></router-view>
</div>
@endsection
