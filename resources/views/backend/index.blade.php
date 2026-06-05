@extends('backend.layouts.app')
@section('content')
    <div class="content">

        <div class="row">
           <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{$investments}}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Investments</dd>
                        </dl>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="{{route('finance.investment.index')}}">
                            <span>View all Investments</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{$ponds}}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Ponds</dd>
                        </dl>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="{{route('pond.index')}}">
                            <span>View all Ponds</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{$fish_purchase}}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Fish Purchase</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{$feed}}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Feed Cost</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{$fish_sale}}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Fish Sale</dd>
                        </dl>
                    </div>
                </div>
            </div>

           
            <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{$total_expenses}}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Expense</dd>
                        </dl>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="javascript:void(0)">
                            <span>View all Expense</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{$total_income}}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Income</dd>
                        </dl>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="javascript:void(0)">
                            <span>View all Income</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{$total_income - $total_expenses}}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Profit</dd>
                        </dl>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="javascript:void(0)">
                            <span>View all Profit</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            
            <div class="col-sm-6 col-xxl-4 mb-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{ $investments - $total_expenses + $total_income }}</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Cash In Hand</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
