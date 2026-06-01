@extends('backend.layouts.app')
@section('title', 'Add  Investment')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/magnific-popup/magnific-popup.css">
@endpush
@section('content')

    <div class="row">
        <div class="col-xl-6 order-xl-0 m-auto">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        {{ __('messages.add_expense') }}
                    </h3>
                    <a href="{{ route('finance.expense.index') }}" class="btn btn-alt-primary btn-sm"> <i class="fas fa-arrow-left"></i> Back </a>
                </div>
                <div class="block-content">
                    <form action="{{ route('finance.expense.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="purpose" class="form-label">Purpose <small class="text-danger">*</small></label>
                           <select id="purpose" name="purpose" class="form-control">
                                <option value="">Select Purpose</option>
                                @foreach ($purposes as $purpose)
                                    <option value="{{ $purpose->id }}"
                                        {{ old('purpose') == $purpose->id ? 'selected' : '' }}>
                                        {{ $purpose->purpose }}</option>
                                @endforeach
                            </select>
                            @error('purpose')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pond" class="form-label">Pond</label>
                           <select id="pond" name="pond" class="form-control">
                                <option value="">Select Pond</option>
                                @foreach ($ponds as $pond)
                                    <option value="{{ $pond->id }}"
                                        {{ old('pond') == $pond->id ? 'selected' : '' }}>
                                        {{ $pond->name }}</option>
                                @endforeach
                            </select>
                            @error('pond')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount <small class="text-danger">*</small></label>
                            <input type="number" id="amount" name="amount" class="form-control"
                                value="{{ old('amount') }}" placeholder="Enter Amount">
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Payment Date <small class="text-danger">*</small></label>
                            <input type="date" id="transaction_date" name="transaction_date" class="form-control" 
                                value="{{ old('transaction_date') ?? now()->format('Y-m-d') }}" placeholder="Enter Date">
                            @error('transaction_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
