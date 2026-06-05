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

                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 30%;">Field</th>
                                <th class="text-center">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center" style="width: 30%;">Pond Name</th>
                                <td class="text-center">{{ $pond->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 30%;">Location</th>
                                <td class="text-center">{{ $pond->location ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 30%;">Size</th>
                                <td class="text-center">{{ $pond->size ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 30%;">Lease Amount</th>
                                <td class="text-center">{{ $pond->lease_amount ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 30%;">Start Date</th>
                                <td class="text-center">{{ $pond->start_date ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 30%;">End Date</th>
                                <td class="text-center">{{ $pond->end_date ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 30%;">Note</th>
                                <td class="text-center">{{ $pond->note ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 30%;">Created At</th>
                                <td class="text-center">{{ $pond->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mb-3">
                        <div class="col-xl-4 mb-4">
                            <div class="block block-rounded d-flex flex-column h-100 mb-0 border">
                                <div
                                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                                    <dl class="mb-0">
                                        <dt class="fs-3 fw-bold">{{ $income ?? 0 }}</dt>
                                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Income</dd>
                                    </dl>
                                    <div class="item item-rounded-lg bg-body-light">
                                        <i class="fa fa-plus fs-3 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-4">
                            <div class="block block-rounded d-flex flex-column h-100 mb-0 border">
                                <div
                                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                                    <dl class="mb-0">
                                        <dt class="fs-3 fw-bold">{{ $expense ?? 0 }}</dt>
                                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Expenses</dd>
                                    </dl>
                                    <div class="item item-rounded-lg bg-body-light">
                                        <i class="fa fa-minus fs-3 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-4">
                            <div class="block block-rounded d-flex flex-column h-100 mb-0 border">
                                <div
                                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                                    <dl class="mb-0">
                                        <dt class="fs-3 fw-bold">{{ $profit }}</dt>
                                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Balance</dd>
                                    </dl>
                                    <div class="item item-rounded-lg bg-body-light">
                                        <i class="fa fa-building-columns fs-3 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
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
