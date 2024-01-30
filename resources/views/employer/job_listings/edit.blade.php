@extends('layout.employer_main')

@section('title', 'Edit Listing')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Edit Listing</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('show', $listing) }}" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="{{ route('editlisting', $listing) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" id="company_name" name="company_name"
                                        class="form-control @error('company_name') is-invalid @enderror"
                                        value="{{ old('company_name') ?? $listing->company_name }}"
                                        placeholder="Company name!">
                                    @error('company_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="job_category" class="form-label">Job Category</label>
                                    <input type="text" id="job_category" name="job_category"
                                        class="form-control @error('job_category') is-invalid @enderror"
                                        value="{{ old('job_category') ?? $listing->job_category }}"
                                        placeholder="Enter Job Category!">
                                    @error('job_category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="text" id="salary" name="salary"
                                        class="form-control @error('salary') is-invalid @enderror"
                                        value="{{ old('salary') ?? $listing->salary }}" placeholder="Salary Range!">
                                    @error('salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="vacancies_available" class="form-label">Vacancies Available!</label>
                                    <input type="text" id="vacancies_available" name="vacancies_available"
                                        class="form-control @error('vacancies_available') is-invalid @enderror"
                                        value="{{ old('vacancies_available') ?? $listing->vacancies_available }}"
                                        placeholder="Vacancies Available!">
                                    @error('vacancies_available')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') ?? $listing->email }}" placeholder="Email!">
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
                                        value="{{ old('contact_no') ?? $listing->contact_no }}" placeholder="Contact No!">
                                    @error('contact_no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" id="facebook" name="facebook"
                                        class="form-control @error('facebook') is-invalid @enderror"
                                        value="{{ old('facebook') ?? $listing->facebook }}" placeholder="Facebook!">
                                    @error('facebook')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" id="instagram" name="instagram"
                                        class="form-control @error('instagram') is-invalid @enderror"
                                        value="{{ old('instagram') ?? $listing->instagram }}" placeholder="Instagram!">
                                    @error('instagram')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="youtube" class="form-label">Youtube</label>
                                    <input type="text" id="youtube" name="youtube"
                                        class="form-control @error('youtube') is-invalid @enderror"
                                        value="{{ old('youtube') ?? $listing->youtube }}" placeholder="Youtube!">
                                    @error('youtube')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input type="file" id="picture" name="picture"
                                    class="form-control @error('picture') is-invalid @enderror"
                                    value="{{ old('picture') ?? $listing->picture }}" placeholder="Picture!">
                                @error('picture')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>


                    <form action="{{ route('editadddesc', $listing) }}" method="post">
                        @csrf
                        {{-- @method("PATCH") --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Address!"></textarea>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" rows="2"
                                            class="form-control @error('description') is-invalid @enderror" placeholder="Description!"></textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @include('partials.modals')

@endsection
