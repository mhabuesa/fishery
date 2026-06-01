@extends('backend.layouts.app')
@section('title', 'Expense List')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 m-auto mt-2">
                <div class="block block-rounded">
                    <div class="block-header block-header-default d-block">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="block-title">Expenses List</h3>
                            </div>
                            <div class="col-lg-6 text-center text-lg-end">
                                <div class="block-options space-x-1 md_mt-2 p-0">
                                    <a href="{{route('finance.expense.create')}}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add Expense</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full overflow-x-auto">
                        <div class="position-relative">
                            <table class="table table-bordered table-vcenter" id="pondTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('messages.sl') }}</th>
                                        <th>{{ __('messages.name') }}</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($expenses as $expense)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $expense->purpose->purpose }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td>{{ $expense->transaction_date }}</td>
                                            <td>
                                                <a href="{{ route('finance.expense.edit', $expense->id) }}" class="btn btn-sm btn-alt-primary"><i class="fa fa-edit"></i></a>
                                                <button data-id="{{ $expense->id }}" onclick="deleteExpense(this)" class="btn btn-sm btn-alt-danger"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

@endsection
@push('footer_scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets') }}/js/plugins/datatables/dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>


        <script>
        function deleteExpense(button) {
            const id = $(button).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This Expense will be deleted permanently.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f97316",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('finance.expense.destroy', ':id') }}";
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
                                showToast(data.message, "success");
                                $(button).closest('tr').remove();
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
