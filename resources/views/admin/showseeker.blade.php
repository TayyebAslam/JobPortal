@extends('layout.main')

@section('title', 'Seeker Details')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Details</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('jobseeker') }}" class="btn btn-primary">Back to Listings</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div id="picture-section">
                            @if ($jobseeker->picture)
                                <img src="{{ asset('template/img/jobseekerphotos/' . $jobseeker->picture) }}"
                                    alt="Jobseeker Picture" class="img-fluid rounded-circle mb-2" width="200" height="200" />
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $jobseeker->name }}"
                                    alt="Placeholder picture" class="img-fluid rounded-circle mb-2" width="200" height="200" />
                            @endif
                        </div>
                        <h5 class="card-title"></h5>
                        <p class="card-text"><strong>Name:</strong> {{ $jobseeker->name }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ $jobseeker->email }}</p>

                        <div>
                            <a href="{{ route('editseeker', $jobseeker->id) }}" class="btn btn-primary">Edit</a>

                            <form action="{{ route('deleteseeker', $jobseeker->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this jobseeker?')">Delete</button>
                            </form>
                        </div>
                        <!-- Add other details as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
