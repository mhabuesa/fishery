@extends('backend.layouts.app')
@section('title', 'Edit Investment')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/magnific-popup/magnific-popup.css">
@endpush
@section('content')

    <div class="row">
        <div class="col-xl-6 order-xl-0 m-auto">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        {{ __('messages.edit_investment') }}
                    </h3>
                    <a href="{{ route('finance.investment.index') }}" class="btn btn-alt-primary btn-sm"> <i class="fas fa-arrow-left"></i> Back </a>
                </div>
                <div class="block-content">
                    <form action="{{ route('finance.investment.update', $investment->id) }}" method="POST">
                        @csrf
                         <div class="mb-3">
                            <label for="partner" class="form-label">Partner<small class="text-danger">*</small></label>
                           <select id="partner" name="partner" class="form-control">
                                <option value="">Select Partner</option>
                                @foreach ($partners as $partner)
                                    <option value="{{ $partner->id }}"
                                        {{ old('partner', $investment->partner_id) == $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}</option>
                                @endforeach
                            </select>
                            @error('partner')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                       
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" id="amount" name="amount" class="form-control"
                                value="{{ old('amount', $investment->amount) }}" placeholder="Enter Amount">
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Payment Date</label>
                            <input type="date" id="transaction_date" name="transaction_date" class="form-control" 
                                value="{{ old('transaction_date', $investment->transaction_date) ?? now()->format('Y-m-d') }}" placeholder="Enter Date">
                            @error('transaction_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea id="note" name="note" class="form-control" rows="3" placeholder="Enter Note">{{ old('note', $investment->note) }}</textarea>
                            @error('note')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-5 mb-3 text-end">
                            <button class="btn btn-primary">Update</button>
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
