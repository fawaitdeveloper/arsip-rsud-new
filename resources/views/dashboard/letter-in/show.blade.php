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
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        @error('job_position_id')
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @enderror
        @include('dashboard.letter-in.components.top')
        {{-- @include('dashboard.letter-in.components.middle') --}}
        @include('dashboard.letter-in.components.bottom')
    </div>
@endsection
@push('customjs')
    <script>
        $(document).ready(function() {
            // $(".select2").select2()
        })
    </script>
@endpush
