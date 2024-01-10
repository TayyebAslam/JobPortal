@extends('layout.employer_main')

@section('title', 'Listing Details')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-3">{{ $listing->company_name }} Details</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div id="picture-section">
                            @if ($listing->picture)
                                <img src="{{ asset('template/img/company_photos/' . $listing->picture) }}" alt="Placeholder picture"
                                    class="img-fluid rounded-circle mb-2" width="200" height="200" />
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $listing->company_name }}"
                                    alt="Placeholder picture" class="img-fluid rounded-circle mb-2" width="200" height="200" />
                            @endif
                        </div>
                    <h5 class="card-title">{{ $listing->company_name }}</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $listing->email }}</p>
                    <p class="card-text"><strong>Contact No.:</strong> {{ $listing->contact_no }}</p>
                    <p class="card-text"><strong>Vacancies:</strong> {{ $listing->vacancies_available }}</p>
                    <!-- Add other details as needed -->

                    <a href="{{ route('showlisting') }}" class="btn btn-primary">Back to Listings</a>
                </div>
            </div>
        </div>
    </div>
@endsection
