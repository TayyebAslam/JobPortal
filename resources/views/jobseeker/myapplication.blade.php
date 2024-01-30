@extends('layout.seeker_main')

@section('title', 'My Application')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3">My Application</h1>
            <div class="card">
                <div class="card-body">
                    @if ($resumes && count($resumes) > 0)
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($resumes as $resume)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $resume->name }}</td>
                                        <td>{{ $resume->email }}</td>
                                        <td>{{ $resume->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info mb-0">No records found!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
