@extends('backend.layouts.app')
@section('title', 'Partner Show')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/magnific-popup/magnific-popup.css">
@endpush
@section('content')

    <div class="row">
        <div class="col-xl-8 order-xl-0 m-auto">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        {{ __('messages.add_pond') }}
                    </h3>
                    <a href="{{ route('pond.index') }}" class="btn btn-alt-primary btn-sm"> <i
                            class="fas fa-arrow-left "></i> Back </a>
                </div>
                <div class="block-content">
                    <form action="{{ route('pond.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" placeholder="Enter Pond Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" name="location" class="form-control"
                                value="{{ old('location') }}" placeholder="Enter Location">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" id="size" name="size" class="form-control"
                                value="{{ old('size') }}" placeholder="Enter Size">
                            @error('size')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lease_amount" class="form-label">Lease Amount</label>
                            <input type="text" id="lease_amount" name="lease_amount" class="form-control"
                                value="{{ old('lease_amount') }}" placeholder="Enter Lease Amount">
                            @error('lease_amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea id="note" name="note" class="form-control" rows="3" placeholder="Enter Note">{{ old('note') }}</textarea>
                            @error('note')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-5 mb-3 text-end">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer_scripts')
    <script src="{{ asset('assets') }}/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script>
        One.helpersOnLoad(['jq-magnific-popup']);

        $(document).on('click', '.toggle-password', function() {

            let input = $('#password');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }

        });
    </script>
@endpush
