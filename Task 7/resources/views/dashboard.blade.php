@extends('layouts.app')

@section('content')
<div class="bg-white shadow-sm rounded p-4">
    <h2 class="fw-bold fs-4 text-dark mb-3">
        {{ __('Dashboard') }}
    </h2>
    <p class="text-dark mb-0">
        {{ __("You're logged in!") }}
    </p>
</div>
@endsection
