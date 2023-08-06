@extends('layouts.app', ['title'=> trans_choice('modules.company', 2)])

@section('content')

<div class="content-header mb-3 bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h4 class="mb-0 text-dark font-weight-bold">Company</h4>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row pt-3">
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <div class="row mb-3">
                        <div class="col">
                            <a role="button" href="{{ route('companies.export') }}" class="btn btn-success">
                                <i class="fa fa-file-excel-o mr-2"></i>
                                {{ trans('labels.export') }}
                            </a>
                            @include('components.tbl_buttons', [
                            'create' => [
                            'route' => route('companies.create'),
                            'label' => trans_choice('modules.company', 1)
                            ]
                            ])
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection