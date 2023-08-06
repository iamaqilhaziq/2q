@extends('layouts.app')

@section('content')

<div class="content-header mb-3 bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h4 class="mb-0 text-dark font-weight-bold">Edit Company</h4>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if ($errors->createlog->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->createlog->first() }}
                <a type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
        @endif
        <div class="row pt-3">
            <div class="col-12">
                <div class="card shadow border-0">
                    <form action="{{ route('companies.update', ['company'=>$company->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="tab-content" id="create-menu-tab-content">
                                <div class="tab-pane fade show active" id="create-company-main" role="tabpanel" aria-labelledby="create-company-main-tab">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="company_name" class="col-form-label">Company Name</label>
                                                <input type="text" name="company_name" id="company_name" value="{{ $company->name }}" class="form-control">
                                                @if($errors->has('company_name'))
                                                <div class="error text-danger">{{ $errors->first('company_name') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="company_image" class="col-form-label">Company Logo</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input browse-image" id="company_image" name="company_image">
                                                        <label class="custom-file-label browse-image-label" for="company_image" aria-describedby="company_image">Choose file</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('company_image'))
                                                <div class="error text-danger">{{ $errors->first('company_image') }}</div>
                                                @endif
                                                <small class="font-weight-bold"><span class="text-red">*</span> must be png, jpg or jpeg, not more than 2mb.</small>
                                                <br>
                                                @if($company->logo)
                                                <div class="d-none d-md-block">
                                                    <img src="{{ $company->logo }}" alt="image" class="mt-3 img-thumbnail border rounded-0 p-1 preview-image w-50" style="height: 300px;">
                                                </div>
                                                <div class="d-md-none">
                                                    <img src="{{ $company->logo }}" alt="image" class="mt-3 img-thumbnail border rounded-0 p-1 preview-image w-100" style="height: 200px;">
                                                </div>
                                                @else
                                                <div class="d-none d-md-block">
                                                    <img src="{{ asset('assets/no_preview.png') }}" alt="image" class="mt-3 img-thumbnail border rounded-0 p-1 preview-image w-50" style="height: 300px;">
                                                </div>
                                                <div class="d-md-none">
                                                    <img src="{{ asset('assets/no_preview.png') }}" alt="image" class="mt-3 img-thumbnail border rounded-0 p-1 preview-image w-100" style="height: 200px;">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="company_email" class="col-form-label">Company Email</label>
                                                <input type="text" name="company_email" id="company_email" value="{{ $company->email }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="company_name" class="col-form-label">Company Website</label>
                                                <input type="text" name="company_website" id="company_website" value="{{ $company->website }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent text-right">
                            <button type="reset" class="btn btn-transparent mr-2" onclick="return window.location = '{{ route('companies.index') }}'"><i class="fa fa-times mr-2"></i>Back</button>
                            <button type="submit" class="btn btn-project-primary ml-2"><i class="fa fa-paper-plane mr-2"></i>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection