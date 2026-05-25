@extends('backend.layouts.app')
@section('title', 'Pond Details')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/magnific-popup/magnific-popup.css">
@endpush
@section('content')

    <div class="row">
        <div class="col-xl-6 order-xl-0 m-auto">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        Pond Details
                    </h3>
                    <div class="block-options">
                        <a href="{{ route('pond.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Pond Name:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Location:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->location ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Size:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->size ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Lease Amount:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->lease_amount ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Start Date:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->start_date ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">End Date:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->end_date ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Status:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">
                                <span class="badge {{ $pond->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $pond->status == '1' ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Note:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->note ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Created At:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->created_at->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Updated At:</label>
                        </div>
                        <div class="col-lg-8">
                            <p class="form-control-plaintext">{{ $pond->updated_at->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <a href="{{ route('pond.edit', $pond->id) }}" class="btn btn-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <button type="button" class="border-0 btn btn-sm" onclick="deletePond(this)"
                            data-id="{{ $pond->id }}" title="Delete"><i
                                class="fa fa-trash text-danger fa-xl"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer_scripts')
    <script>
        function deletePond(button) {
            const id = $(button).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This Pond Delete Permanently.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f97316",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('pond.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            if (data.success) {
                                window.location.href = '{{ route('pond.index') }}';
                            } else {
                                showToast(data.message, "error");
                            }
                        },
                        error: function(xhr) {
                            showToast("An error occurred: " + xhr.responseJSON.message, "error");
                        }
                    });
                }
            });
        }
    </script>
@endpush
