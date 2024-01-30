{{-- admin.employers.blade.php --}}
@extends('layout.main')

@section('title', 'Jobseeker')

@section('content')
<div class="row">
    <div class="col-6">
        <h1>Job Seekers</h1>
    </div>
    <div class="col-6 text-end">
        <a href="{{ route('create_seeker') }}" class="btn btn-outline-primary">Add Job Seekers</a>
    </div>
</div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('partials.alerts')
                    @if($jobseekers && count($jobseekers) > 0)
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobseekers as $jobseeker)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jobseeker->name }}</td>
                                        <td>{{ $jobseeker->email }}</td>
                                        <td>
                                            <a href="{{ route('showseeker', ['id' => $jobseeker->id]) }}" class="btn btn-primary">Show</a>
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
