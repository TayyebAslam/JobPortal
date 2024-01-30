<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.adminprofile', [
            'admin' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $admin = User::find(Auth::id());

        if ($admin->update($request->all())) {
            return back()->with(['success' => 'Successfully updated!']);
        } else {
            return back()->with(['failure' => 'Failed to update!']);
        }
    }

    public function password(Request $request)
    {
        $admin = User::find(Auth::id());
        $request->validate([
            'password' => ['required', 'confirmed'],
            'current_password' => ['required'],
        ]);

        if (Hash::check($request->current_password, $admin->password)) {
            $data = [
                'password' => Hash::make($request->password),
            ];

            if ($admin->update($data)) {
                return back()->with(['success' => 'Password Successfully Updated!']);
            } else {
                return back()->with(['failure' => 'Failed to update password!']);
            }
        } else {
            return back()->withErrors(['current_password' => 'Current password does not match!']);
        }
    }

    public function picture(Request $request)
    {
        $admin = User::find(Auth::id());
        $request->validate([
            'picture' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'],
        ]);

        $old_picture_path = 'template/img/adminphotos/' . $admin->picture;

        if ($admin->picture && File::exists(public_path($old_picture_path))) {
            unlink(public_path($old_picture_path));
        }

        $new_file_name = "ACI-MAGICIANS" . microtime(true) . "." . $request->picture->getClientOriginalExtension();

        $data = [
            'picture' => $new_file_name,
        ];

        if ($request->picture->move(public_path('template/img/adminphotos/'), $new_file_name)) {
            if ($admin->update($data)) {
                return back()->with(['success' => 'Picture Successfully updated!']);
            } else {
                return back()->with(['failure' => 'Failed to update!']);
            }
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    public function employers()
    {
        $employers = User::where('type', 'employer')->get();
        return view('admin.employers', ['employers' => $employers]);
    }

    public function showemployers($id)
    {
        $employer = User::find($id);

        if ($employer && $employer->type === 'employer') {
            return view('admin.showemployers', ['employer' => $employer]);
        } else {
            return back()->with(['failure' => 'Employer not found!']);
        }
    }

    public function listings()
    {
        $listings = Listing::all();
        return view('admin.listings', ['listings' => $listings]);
    }

    public function showlistings($id)
    {
        $listing = Listing::find($id);

        if ($listing) {
            return view('admin.showlisting', ['listing' => $listing]);
        } else {
            return back()->with(['failure' => 'Listing not found!']);
        }
    }

    public function editjoblisting($id)
    {
        $listing = Listing::find($id);

        if ($listing) {
            return view('admin.editlisting', ['listing' => $listing]);
        } else {
            return back()->with(['failure' => 'Listing not found!']);
        }
    }

    public function updatelisting(Request $request, Listing $listing)
    {
        $request->validate([
            'company_name' => 'required|max:255',
            'job_category' => 'required|max:255',
            'salary' => 'required|max:255',
            'vacancies_available' => 'required|integer',
            'email' => 'required|email|max:255',
            'contact_no' => 'required|max:20',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'picture' => 'image|mimes:png,jpg,jpeg,webp|max:10240',
        ]);

        $data = [
            'company_name' => $request->company_name,
            'job_category' => $request->job_category,
            'salary' => $request->salary,
            'vacancies_available' => $request->vacancies_available,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ];

        if ($request->hasFile('picture')) {
            $request->validate([
                'picture' => 'image|mimes:png,jpg,jpeg,webp|max:10240',
            ]);

            $name = microtime(true) . $request->picture->hashName();
            $request->picture->move(public_path('template/img/company_photos'), $name);
            $data['picture'] = $name;
        }

        if ($listing->update($data)) {
            return back()->with(['success' => 'Successfully Updated!']);
        } else {
            return back()->with(['failure' => 'Failed to update!']);
        }
    }

    public function destroyajob(Listing $listing)
    {
        if ($listing->delete()) {
            return redirect()->route('listings')->with(['success' => 'Successfully deleted!']);
        } else {
            return redirect()->route('listings')->with(['failure' => 'Failed to delete!']);
        }
    }

    public function editemployer($id)
    {
        $employer = User::find($id);

        if ($employer && $employer->type === 'employer') {
            return view('admin.employeredit', ['employer' => $employer]);
        } else {
            return back()->with(['failure' => 'Employer not found!']);
        }
    }

    public function updateemployer(Request $request, $id)
    {
        $employer = User::find($id);

        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        // Add a check if the employer is found
        if (!$employer) {
            return back()->with(['failure' => 'Employer not found!']);
        }

        // If the password field is not empty, update the password
        // if (!empty($data['password'])) {
        //     $data['password'] = Hash::make($data['password']);
        // }

        if ($employer->update($data)) {
            return back()->with(['success' => 'Employer details updated successfully!']);
        } else {
            return back()->with(['failure' => 'Failed to update employer details!']);
        }
    }
    public function updateemployerpassword(Request $request, $id)
    {
        $employer = User::find($id);
        $request->validate([
            'password' => ['required'],
        ]);

        // if (Hash::check($request->password)) {
        $data = [
            'password' => Hash::make($request->password),
        ];

        if ($employer->update($data)) {
            return back()->with(['success' => 'Password Successfully Updated!']);
        } else {
            return back()->with(['failure' => 'Failed to update password!']);
        }
        // }
    }
    // public function emppicture(Request $request)
    // {
    //     $employer = User::find(Auth::id());
    //     $request->validate([
    //         'picture' => ['required', 'image'],
    //     ]);

    //     $old_picture_path = 'template/img/employerphotos/' . $employer->picture;

    //     if ($employer->picture && File::exists(public_path($old_picture_path))) {
    //         unlink(public_path($old_picture_path));
    //     }

    //     $new_file_name = "ACI-MAGICIANS" . microtime(true) . "." . $request->picture->getClientOriginalExtension();

    //     $data = [
    //         'picture' => $new_file_name,
    //     ];

    //     if ($request->picture->move(public_path('template/img/employerphotos/'), $new_file_name)) {
    //         if ($employer->update($data)) {
    //             return back()->with(['success' => 'Picture Successfully updated!']);
    //         } else {
    //             return back()->with(['failure' => 'Failed to update!']);
    //         }
    //     } else {
    //         return back()->with(['failure' => 'Magic has failed to spell!']);
    //     }
    // }

    public function emppicture(Request $request, $id)
    {
        $employer = User::find($id);

        $request->validate([
            'picture' => ['required', 'image'],
        ]);

        $old_picture_path = 'template/img/employerphotos/' . $employer->picture;


        // Check if a file is provided in the request
        if ($request->hasFile('picture')) {
            $old_picture_path = 'template/img/employerphotos/' . $employer->picture;

            if ($employer->picture && File::exists(public_path($old_picture_path))) {
                unlink(public_path($old_picture_path));
            }

            $new_file_name = "ACI-MAGICIANS" . microtime(true) . "." . $request->file('picture')->getClientOriginalExtension();

            $data = [
                'picture' => $new_file_name,
            ];

            if ($request->file('picture')->move(public_path('template/img/employerphotos/'), $new_file_name)) {
                if ($employer->update($data)) {
                    return back()->with(['success' => 'Picture Successfully updated!']);
                } else {
                    return back()->with(['failure' => 'Failed to update!']);
                }
            } else {
                return back()->with(['failure' => 'Failed to move the uploaded file!']);
            }
        } else {
            return back()->with(['failure' => 'No file provided for updating the picture!']);
        }
    }
    public function createlist()
    {
        $employers = User::where('type', 'employer')->get();

        return view('admin.createlisting', ['employers' => $employers,]);
    }
    public function storelist(Request $request)
    {
        $request->validate([
            'employer' => ['required', 'exists:users,id,type,employer'],
            'company_name' => ['required'],
            'job_category' => ['required'],
            'salary' => ['required'],
            'vacancies_available' => ['required'],
            'email' => ['required'],
            'picture' => ['image', 'mimes:png,jpg,jpeg,webp'],
            'contact_no' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
        ]);

        $employerId = $request->input('employer');

        if ($request->hasFile('picture')) {
            $name = microtime(true) . $request->picture->hashName();
            $request->picture->move(public_path('template/img/company_photos'), $name);
        } else {
            $name = null;
        }

        $data = [
            'company_name' => $request->company_name,
            'job_category' => $request->job_category,
            'salary' => $request->salary,
            'vacancies_available' => $request->vacancies_available,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'description' => $request->description,
            'address' => $request->address,
            'picture' => $name,
            'user_id' => $employerId,
        ];

        if (Listing::create($data)) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    public function editlist($id)
    {
        $listing = Listing::find($id);

        if ($listing) {
            return view('admin.employeredit', ['listing' => $listing]);
        } else {
            return back()->with(['failure' => 'Listing not found!']);
        }
    }
    public function delete($id)
    {
        $employer = User::find($id);

        if ($employer) {
            if ($employer->delete()) {
                return redirect()->route('employers')->with(['success' => 'Successfully deleted!']);
            } else {
                return redirect()->route('employers')->with(['failure' => 'Failed to delete!']);
            }
        } else {
            return redirect()->route('employers')->with(['failure' => 'Employer not found!']);
        }
    }
    public function jobseeker()
    {
        $jobseekers = User::where('type', 'job_seeker')->get();
        return view('admin.seeker', ['jobseekers' => $jobseekers]);
        // , ['job_seeker' => $jobseeker]
    }
    public function showseeker($id)
    {
        $jobseeker = User::find($id);

        if ($jobseeker && $jobseeker->type === 'job_seeker') {
            return view('admin.showseeker', ['jobseeker' => $jobseeker]);
        } else {
            return back()->with(['failure' => 'Seeker not found!']);
        }
    }
    public function editseeker($id)
    {
        $jobseeker = User::find($id);

        if ($jobseeker && $jobseeker->type === 'job_seeker') {
            return view('admin.editseeker', ['jobseeker' => $jobseeker]);
        } else {
            return back()->with(['failure' => 'jobseeker not found!']);
        }
    }
    public function updateseeker(Request $request, $id)
    {
        $jobseeker = User::find($id);

        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        // Add a check if the employer is found
        if (!$jobseeker) {
            return back()->with(['failure' => 'Jobseeker not found!']);
        }

        // If the password field is not empty, update the password
        // if (!empty($data['password'])) {
        //     $data['password'] = Hash::make($data['password']);
        // }

        if ($jobseeker->update($data)) {
            return back()->with(['success' => 'Jobseeker details updated successfully!']);
        } else {
            return back()->with(['failure' => 'Failed to update jobseeker details!']);
        }
    }
    public function updateseekerpassword(Request $request, $id)
    {
        $jobseeker = User::find($id);
        $request->validate([
            'password' => ['required'],
        ]);

        // if (Hash::check($request->password)) {
        $data = [
            'password' => Hash::make($request->password),
        ];

        if ($jobseeker->update($data)) {
            return back()->with(['success' => 'Password Successfully Updated!']);
        } else {
            return back()->with(['failure' => 'Failed to update password!']);
        }
        // }
    }
    public function seekerpicture(Request $request, $id)
    {
        $jobseeker = User::find($id);

        $request->validate([
            'picture' => ['required', 'image'],
        ]);

        $old_picture_path = 'template/img/jobseekerphotos/' . $jobseeker->picture;


        // Check if a file is provided in the request
        if ($request->hasFile('picture')) {
            $old_picture_path = 'template/img/jobseekerphotos/' . $jobseeker->picture;

            if ($jobseeker->picture && File::exists(public_path($old_picture_path))) {
                unlink(public_path($old_picture_path));
            }

            $new_file_name = "ACI-MAGICIANS" . microtime(true) . "." . $request->file('picture')->getClientOriginalExtension();

            $data = [
                'picture' => $new_file_name,
            ];

            if ($request->file('picture')->move(public_path('template/img/jobseekerphotos/'), $new_file_name)) {
                if ($jobseeker->update($data)) {
                    return back()->with(['success' => 'Picture Successfully updated!']);
                } else {
                    return back()->with(['failure' => 'Failed to update!']);
                }
            } else {
                return back()->with(['failure' => 'Failed to move the uploaded file!']);
            }
        } else {
            return back()->with(['failure' => 'No file provided for updating the picture!']);
        }
    }
    public function deleteseeker($id)
    {
        $jobseeker = User::find($id);

        if ($jobseeker) {
            if ($jobseeker->delete()) {
                return redirect()->route('jobseeker')->with(['success' => 'Successfully deleted!']);
            } else {
                return redirect()->route('jobseeker')->with(['failure' => 'Failed to delete!']);
            }
        } else {
            return redirect()->route('jobseeker')->with(['failure' => 'Jobseeker not found!']);
        }
    }
    public function appplication() {
        $resume = Resume::all();
        return view('admin.applicationshow', ['resume' => $resume]);
    }
    public function acceptresumeadmin(Request $request, $id)
    {
        $this->updateResumeStatus($id, 'accepted');
        return redirect()->back()->with('success', 'Resume accepted successfully');
    }

    public function rejectresumeadmin(Request $request, $id)
    {
        $this->updateResumeStatus($id, 'rejected');
        return redirect()->back()->with('success', 'Resume rejected successfully');
    }

    private function updateResumeStatus($id, $status)
    {
        $resume = Resume::find($id);
        if ($resume) {
            // Update the status in the database
            $resume->status = $status;
            $resume->save();
        }
    }
    public function edit($id)
    {
        $employer = User::find($id);

        if ($employer && $employer->type === 'employer') {
            return view('admin.editemployers', ['employer' => $employer]);
        } else {
            return back()->with(['failure' => 'Employer not found!']);
        }
    }

    public function updateemployeradmin(Request $request, $id)
    {
        $employer = User::find($id);
        $data =  $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        if ($employer->update($data)) {
            return back()->with(['success' => 'Successfully updated employer details!']);
        } else {
            return back()->with(['failure' => 'Failed to updateemployer details']);
        }
    }

    public function updatepictureadmin(Request $request, $id)
    {
        $employer = User::find($id);
        $request->validate([
            'picture' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'],
        ]);

        $old_picture_path = 'template/img/employerphotos/' . $employer->picture;

        if ($employer->picture && File::exists(public_path($old_picture_path))) {
            unlink(public_path($old_picture_path));
        }
        $new_file_name = "ACI-MAGICIANS" . microtime(true) . "." . $request->picture->getClientOriginalExtension();

        $data = [
            'picture' => $new_file_name,
        ];

        if ($request->picture->move(public_path('template/img/employerphotos/'), $new_file_name)) {
            if ($employer->update($data)) {
                return back()->with(['success' => 'Picture Successfully updated!']);
            } else {
                return back()->with(['failure' => 'Failed to update!']);
            }
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    public function updateemployerpasswordadmin(Request $request, $id)
    {
        $employer = User::find($id);

        $request->validate([
            'password' => ['required', 'confirmed'],
            // 'current_password' => ['required'],
        ]);

        // if (Hash::check($request->current_password, $employer->password)) {
        $data = [
            'password' => Hash::make($request->password),
        ];

        if ($employer->update($data)) {
            return back()->with(['success' => 'Employer password successfully updated!']);
        } else {
            return back()->with(['failure' => 'Failed to update employer password!']);
        }
        // } else {
        //     return back()->withErrors(['current_password' => 'Current password does not match!']);
        // }
    }

    public function createemployeradmin()
    {
        return view('admin.createemploy');
    }

    public function addemployeradmin(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Create the employer
        $employer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'type' => 'employer',
            // Add other fields as needed
        ]);

        return redirect()->route('create.employer')->with(['success' => 'Employer added successfully']);
    }

    public function deleteemployeradmin(Request $request, $id)
    {
        $employer = User::find($id);

        if ($employer) {
            $employer->delete(); // This will delete the associated listings due to onDelete('cascade')

            return redirect()->route('employers')->with(['success' => 'Employer and associated listings successfully deleted!']);
        } else {
            return redirect()->route('employers')->with(['failure' => 'Employer not found!']);
        }
    }
    public function create_jobseeker()
    {
        return view('admin.create_seeker');
    }

    public function add_jobseeker(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Create the employer
        $employer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'type' => 'job_seeker',
            // Add other fields as needed
        ]);

        // return redirect()->route('create_seeker')->with(['success' => 'Job seeker added successfully']);
        
    }
}
