@extends('layout.main')

@section('title', 'Applications')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">APPLICATIONS</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('partials.alerts')

                    @if ($resume && count($resume) > 0)
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Resume</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($resume as $singleResume)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $singleResume->name }}</td>
                                        <td>{{ $singleResume->email }}</td>
                                        <td>{{ $singleResume->contact_no }}</td>
                                        <td>
                                            <a href="{{ asset('template/img/resume/' . $singleResume->pdf) }}" target="_blank">Open PDF</a>
                                        </td>
                                        <td>
                                            <div class="p-3
                                                @if ($singleResume->status == 'accepted') text-success
                                                @elseif($singleResume->status == 'pending') text-primary
                                                @elseif($singleResume->status == 'rejected') text-danger
                                                @else text-secondary @endif">
                                                {{ $singleResume->status }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($singleResume->status == 'pending')
                                                <form method="post" action="{{ route('accept.resumeadmin', $singleResume->id) }}" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-success">Accept</button>
                                                </form>

                                                <form method="post" action="{{ route('reject.resumeadmin', $singleResume->id) }}" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info mb-0">No record found!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals')

@endsection
