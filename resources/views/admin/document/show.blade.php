@extends('layouts.admin-app')
@section('title', 'Document - ' . $data->name)
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Document - {{ $data->name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Document</li>
                        <li class="breadcrumb-item active" aria-current="page">Document - {{ $data->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content" style="min-height: auto;">
    <div class="row">
        <div class="col-xxxl-4 col-12">
            <div class="box mb-0">
                <div class="box-body d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="mr-10 rounded-circle avatar avatar-xl b-2 border-primary" style="font-size: 15px;font-weight: bold;">
                            {{ pathinfo($data->file, PATHINFO_EXTENSION) }}
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $data->name }}</h4>
                            <span class="font-size-14 text-info">
                                @foreach($data->tags as $tag)
                                <span class="badge badge-info badge-sm">{{ $tag->name }}</span>
                                @endforeach
                            </span>
                        </div>
                    </div>
                    <div class="right-wrapper">
                        <a href="{{ asset($data->file) }}" download class="waves-effect waves-circle btn btn-circle btn-success-light btn-xs mb-5"><i class="fa fa-download"></i></a>
                        <br>
                        <a href="javascript:;" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5 get-file-var" data-id="{{ $data->id }}"><i class="fa fa-bar-chart-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main content -->
@endsection
@push('script')
@endpush