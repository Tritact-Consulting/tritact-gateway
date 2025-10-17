<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document"> {{-- made wider for more columns --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Previous Certifications — 
                    <span class="font-weight-bold">{{ $latest->user->name }}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Certification Type</th>
                            <th>Certification Body</th>
                            <th>Audit Type</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
                            <th>Next Audit Date</th>
                            <th>Certification No.</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($olderRecords as $record)
                        <tr>
                            <td>{{ $record->certificate->name ?? '-' }}</td>
                            <td>{{ $record->body?->name ?? '-' }}</td>
                            <td>{{ $record->certification_name ?? '-' }}</td>
                            <td>{{ $record->issue_date ?? '-' }}</td>
                            <td>{{ $record->expire_date ?? '-' }}</td>
                            <td>{{ $record->next_audit_due_date ?? '-' }}</td>
                            <td>{{ $record->certification_number ?? '-' }}</td>
                            <td>{{ $record->assignedUser?->name ?? 'N/A' }}</td>
                            <td>
                                @if($record->status_badge)
                                    <span class="{{ $record->status_badge['class'] }}">
                                        {{ $record->status_badge['label'] }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    @can('edit assign certification')
                                    <a href="{{ route('company.certification.edit', $record->id) }}"
                                       class="mr-1 btn btn-circle btn-danger-light btn-xs" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('delete assign certification')
                                    <form action="{{ route('company.certification.destroy', $record->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-circle btn-primary-light btn-xs show_confirm"
                                                data-heading="certification"
                                                title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
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
