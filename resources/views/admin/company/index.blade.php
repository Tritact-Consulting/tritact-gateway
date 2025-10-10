@extends('layouts.admin-app')
@section('title', 'Company List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Company List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Company</li>
                        <li class="breadcrumb-item active" aria-current="page">Company list</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-6">
            <form method="get" action="{{ route('company.index') }}" class="company-form">
                <div class="input-group">
                    <input type="search" id="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search" value="{{ app('request')->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon3">
                            <i class="icon-Search"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>
                </div>
                <div id="suggestion-box" class="list-group position-absolute" style="z-index: 1000;"></div>
            </form>
        </div>
    </div>
</div>
<!-- /.content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs mb-3 company-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ $filter == 'all' ? 'active' : '' }}" href="{{ route('company.index', ['filter' => 'all', 'search' => request('search')]) }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $filter == 'our' ? 'active' : '' }}" href="{{ route('company.index', ['filter' => 'our', 'search' => request('search')]) }}">Our Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $filter == 'consultant' ? 'active' : '' }}" href="{{ route('company.index', ['filter' => 'consultant', 'search' => request('search')]) }}">Consultant Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $filter == 'partner' ? 'active' : '' }}" href="{{ route('company.index', ['filter' => 'partner', 'search' => request('search')]) }}">Partner Companies</a>
                </li>
            </ul>
        </div>
        @foreach($data as $key => $value)
        <div class="col-xxxl-4 col-xl-4 col-lg-6 col-12">
            @php
                $bgColor = '';
                if (isset($value->company->partner)) {
                    $bgColor = '#d5e5f4'; // Partner colour
                } elseif (isset($value->company->consultant)) {
                    $bgColor = '#ffeab6'; // Consultant colour
                }
            @endphp
            <div class="box food-box">
                <div class="box-body text-center" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
                    <div class="menu-item">
                        @if($value->company != null)
                        <img src="{{ asset($value->company->logo) }}" class="img-fluid w-p75" alt="">
                        @endif
                    </div>
                    <div class="menu-details text-center">
                        <h4 class="mt-20 mb-10">
                            @if($value->company->company_id) {{ $value->company->prefix_company_id }}{{ $value->company->company_id }} - @endif {{ $value->name }}
                        </h4>
                        <p class="mb-5">{{ $value->email }}</p>
                        @if($value->company->partner)
                        <p style="border-top: 1px solid #f1eff5;padding-bottom: 0;margin-bottom: 10px;padding-top: 4px;border-bottom: 1px solid #f1eff5;"><strong>Partner : </strong>{{ $value->company->partner->company_name }}</p>
                        @endif
                        @if($value->company->consultant)
                        <p style="border-top: 1px solid #f1eff5;padding-bottom: 0;margin-bottom: 5px;padding-top: 4px;"><strong>Consultant : </strong>{{ $value->company->consultant->name }}</p>
                        @endif
                        @foreach($value->tags as $tag)
                        <span class="badge badge-info mb-10">{{ $tag->name }}</span>
                        @endforeach
                        <hr style="margin-top: 4px;">
                        @foreach($value->categories as $category)
                        <span class="badge badge-info mb-10">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    <div class="act-btn d-flex justify-content-between">
                        @can('edit company')
                        <div class="text-center mx-5">
                            <a href="{{ route('company.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                            <small class="d-block">Edit</small>
                        </div>
                        @endcan
                        @can('delete company')
                        <div class="text-center mx-5">
                            <form action="{{ route('company.destroy',$value->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5"><i class="fa fa-trash"></i></button>
                                <small class="d-block">Delete</small>
                            </form>
                        </div>
                        @endcan
                        @can('assign company user')
                        <div class="text-center mx-5">
							<a href="{{ route('company.user', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-info-light btn-xs mb-5"><i class="fa fa-users"></i></a>
							<small class="d-block">Users</small>
						</div>
                        @endcan
                        @can('login company')
						<div class="text-center mx-5">
                            <a href="{{ route('company.dashboard', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-success-light btn-xs mb-5"><i class="fa fa-lock"></i></a>
                            <small class="d-block">Login</small>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@push('script')
<script>
$(document).ready(function(){
    $("#search").keyup(function(){
        let query = $(this).val();

        if(query.length > 1){
            $.ajax({
                url: "{{ route('company.autocomplete') }}",
                type: "GET",
                data: { query: query },
                success: function(data){
                    $("#suggestion-box").empty().show();

                    if(data.length > 0){
                        $.each(data, function(index, company){
                            $("#suggestion-box").append(
                                `<a href="#" class="list-group-item list-group-item-action suggestion-item" data-name="${company.name}">${company.name}</a>`
                            );
                        });
                    }
                }
            });
        } else {
            $("#suggestion-box").empty().hide();
        }
    });

    // On click fill the input and submit form
    $(document).on("click", ".suggestion-item", function(e){
        e.preventDefault();
        let name = $(this).data("name");
        $("#search").val(name);  // fill input
        $("#suggestion-box").empty().hide();
        $(".company-form").submit();
    });
});
</script>
@endpush