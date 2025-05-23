@extends('layouts.admin-app')
@section('title', 'Dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-building mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $company_count }}</h2>
                            <p class="text-fade mb-0">Companies</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-tags mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $tag_count }}</h2>
                            <p class="text-fade mb-0">Tags</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-users mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $user_count }}</h2>
                            <p class="text-fade mb-0">Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-th-list mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $document_count }}</h2>
                            <p class="text-fade mb-0">Documents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-book mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $guide_count }}</h2>
                            <p class="text-fade mb-0">Guides</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-bar-chart mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $cert_body_count }}</h2>
                            <p class="text-fade mb-0">Cert. Body</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-user mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $auditor_count }}</h2>
                            <p class="text-fade mb-0">Auditors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-share mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $assign_certification_count }}</h2>
                            <p class="text-fade mb-0">Assign Cert.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
			<div class="box">
			    <div class="box-body">
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no datatables-expire" id="example1">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Certification</th>
                                    <th>Certification Name</th>
                                    <th>Auditor</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auditor_expire as $key => $value)
                                <tr class="{{ $value->getRemainingDays() }}">
                                    <td>{{ $value->user->name }}</td>
                                    <td>{{ $value->certificate->name }}</td>
                                    <td>{{ $value->certification_name }}</td>
                                    <td>{{ $value->auditor->name }}</td>
                                    <td>{{ $value->expire_date }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('company.certification.edit', $value->id) }}" class="mr-1 waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('company.certification.destroy', $value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm" data-heading="certification"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@push('script')
<script>
    if($('.datatables-expire').length != 0){
        $('.datatables-expire').DataTable({
            order: [[5, 'asc']]
        });
    }
</script>
@endpush