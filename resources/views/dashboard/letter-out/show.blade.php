@extends('dashboard.layouts.main')
@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        @include('dashboard.letter-out.components.top')
        {{-- @include('dashboard.letter-out.components.middle') --}}
        @include('dashboard.letter-out.components.bottom')
    </div>
@endsection
