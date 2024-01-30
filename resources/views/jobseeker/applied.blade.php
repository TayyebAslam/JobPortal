@extends('layout.seeker_main')

@section('title', 'Apply Job')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Apply Job</h1>
        </div>
        <div class="col-6 text-end">
            <a href="" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="{{ route('store_application',['listing' => $listing->id]          ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Enter name!">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="Enter Email!">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="contact_no" class="form-label">Contact No.</label>
                                    <input type="text" id="contact_no" name="contact_no"
                                        class="form-control @error('contact_no') is-invalid @enderror"
                                        value="{{ old('contact_no') }}" placeholder="Contact No!">
                                    @error('contact_no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="pdf" class="form-label">Upload Resume</label>
                                    <input type="file" id="pdf" name="pdf"
                                        class="form-control @error('pdf') is-invalid @enderror"
                                        value="{{ old('pdf') }}" placeholder="pdf!">
                                    @error('pdf')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Another Details</label>
                                    <textarea name="address" id="address" rows="2"
                                        class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Address!"></textarea>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <input type="submit" value="Add" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals')

@endsection
