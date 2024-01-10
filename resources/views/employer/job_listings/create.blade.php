@extends('layout.employer_main')

@section('title', 'Add Listing')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-3">Add Listing</h1>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('showlisting')}}" class="btn btn-outline-primary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('partials.alerts')
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" id="company_name" name="company_name"
                                        class="form-control @error('company_name') is-invalid @enderror"
                                        value="{{ old('company_name') }}" placeholder="Company name!">
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
                                        value="{{ old('job_category') }}" placeholder="Enter Job Category!">
                                    @error('job_category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="vacancies_available" class="form-label">Vacancies Available!</label>
                                    <input type="text" id="vacancies_available" name="vacancies_available"
                                        class="form-control @error('vacancies_available') is-invalid @enderror"
                                        value="{{ old('vacancies_available') }}" placeholder="Vacancies Available!">
                                    @error('vacancies_available')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select id="category_id" name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Select a category!</option>

                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="Email!">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" id="mobile" name="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror"
                                        value="{{ old('mobile') }}" placeholder="Mobile!">
                                    @error('mobile')
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
                                        value="{{ old('facebook') }}" placeholder="Facebook!">
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
                                        value="{{ old('instagram') }}" placeholder="Instagram!">
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
                                        value="{{ old('youtube') }}" placeholder="Youtube!">
                                    @error('youtube')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" id="dob" name="dob"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        value="{{ old('dob') }}" placeholder="Date of Birth!">
                                    @error('dob')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Picture</label>
                                    <input type="file" id="picture" name="picture"
                                        class="form-control @error('picture') is-invalid @enderror"
                                        value="{{ old('picture') }}" placeholder="Picture!">
                                    @error('picture')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Address</label>
                                    <textarea name="address" id="address" rows="2" class="form-control @error('address') is-invalid @enderror"
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
