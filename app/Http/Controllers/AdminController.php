<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Oparetor;
use App\Models\Employee;
use App\Models\Application;
use App\Models\Admin;
use Carbon\Carbon;
use App\Http\Requests\OparetorRequest;
use DateTime;
use Mail;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('id');
        $user = User::where('id', $id)->first();
        $day = now();
        $emp = Application::where('employee_id', $id)->where('approve', "1")->orderBy('id', 'DESC')->get()->first();
        $endDAte = Application::where('employee_id', $id)->where('approve', "1")->whereYear(
            'start', '=', now()->year
        )->sum('total_days');
        $emp_minuesLeaves = Application::where('employee_id', $id)->where('approve', "1")->whereYear('start', '=', now()->year)->whereYear('end', '=', now()->year + 1)->first();
        if ($emp_minuesLeaves) {
            $endDAte = (int)$endDAte - (int)date('d', strtotime($emp_minuesLeaves->end));
        }

        $employeePreviousYear_days = Application::where('employee_id', $id)->where('approve', "1")->whereYear('start', '=', now()->year - 1)->whereYear('end', '=', now()->year)->first();
        if ($employeePreviousYear_days) {
            $endDAte = (int)$endDAte + (int)date('d', strtotime($employeePreviousYear_days->end));
        }
        if ($emp != null) {

            $Sdate = Carbon::parse($emp->start)->startOfDay();
            $edate = Carbon::parse($emp->end)->endOfDay();
            $days = $Sdate->diffInDays($edate);
            $days = $days + 1;
            $applications = Application::Where('approve', "1")->where('start', '<=', Carbon::now()->format('Y-m-d'))->where('end', '>=', Carbon::now()->format('Y-m-d'))->count();
            $employee = User::all()->count();
            $join = $employee - $applications;

            // $emp=Application::where('employee_id',$id)->where('approve',"1")->where('id', 'DESC')->get();
            //
            //  $days = $interval->format('%a');
            return view('admin.index')->with('user', $user)
                ->with('days', $days)
                ->with('applications', $applications)
                ->with('join', $join)
                ->with('endDAte', $endDAte);
        }
        $applications = Application::Where('approve', "1")->where('start', '<=', Carbon::now()->format('Y-m-d'))->where('end', '>=', Carbon::now()->format('Y-m-d'))->count();
        $employee = User::all()->count();
        $join = $employee - $applications;
        $endDAte = 0;
        return view('admin.index')->with('user', $user)
            ->with('applications', $applications)
            ->with('join', $join)->with('endDAte', $endDAte);
    }

//---------------------------------------Oparetor start---------------------------------------------------------------------//

//---------view add oparetor page-------------//
    public function create_oparetor()
    {
        return view('admin.create_oparetor');
    }
//---------view add oparetor page end-------------//
//--------- add oparetor funtion start-------------//
    public function add_oparetor(OparetorRequest $request)
    {

        $oparetor = new Oparetor;
        $oparetor->first_name = $request->first_name;
        $oparetor->phone = $request->phone;
        $oparetor->email = $request->email;
        $oparetor->branch = $request->branch;
        $oparetor->department = $request->department;
        if ($request->department == "সিনিয়র সচিব") {
            $oparetor->status = 1;
        }
        if ($request->department == "অতিরিক্ত সচিব") {
            $oparetor->status = 2;
        }
        if ($request->department == "মাননীয় প্রতিমন্ত্রীর একান্ত সচিব") {
            $oparetor->status = 3;
        }
        if ($request->department == "একান্ত সচিব") {
            $oparetor->status = 4;
        }

        if ($request->department == "সিনিয়র সচিবের একান্ত সচিব") {
            $oparetor->status = 5;
        }
        if ($request->department == "যুগ্মসচিব") {
            $oparetor->status = 6;
        }
        if ($request->department == "উপসচিব") {
            $oparetor->status = 7;
        }
        if ($request->department == "সিনিয়র সহকারী সচিব") {
            $oparetor->status = 8;
        }
        if ($request->department == "সহকারী সচিব") {
            $oparetor->status = 9;
        }

        if ($request->department == "সিনিয়র সিস্টেম এনালিস্ট") {
            $oparetor->status = 10;
        }

        if ($request->department == "সিনিয়র মেইন্টেনেন্স ইঞ্জিনিয়ার") {
            $oparetor->status = 11;
        }

        if ($request->department == "সিস্টেম এনালিস্ট") {
            $oparetor->status = 12;
        }
        if ($request->department == "প্রোগ্রামার") {
            $oparetor->status = 13;
        }

        if ($request->department == "সহকারী মেইন্টেনেন্স ইঞ্জিনিয়ার") {
            $oparetor->status = 14;
        }
        $oparetor->password = $request->password;
        if ($request->department == "হিসাবরক্ষণ") {
            $oparetor->status = 15;
        }
        $oparetor->password = $request->password;
        $oparetor->role = "2";
        $oparetor->is_active = "1";
        $oparetor->save();
        $oparetor_id = Oparetor::where('first_name', $request->first_name)->pluck('id');
        User::insert([
            'username' => $request->first_name,
            'role' => "2",
            'is_active' => "1",
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'oparetor_id' => $oparetor_id[0]
        ]);
        return view('admin.create_oparetor', ['success' => true]);
    }
//--------- add oparetor funtion end-------------//
//--------- add oparetor list view funtion start-------------//
    public function oparetorlist()
    {
        $oparetors = Oparetor::all();
        return view('admin.oparetorlist')->with('oparetors', $oparetors);
    }

//--------- add oparetor list view funtion end-------------//
    public function oparetorprofile($id)
    {
        $oparetor = Oparetor::find($id);
        return view('admin.oparetor_profile')->with('oparetor', $oparetor);
    }

//---------  oparetor edit start-------------//
    public function Oparetoredit($id)
    {
        $oparetor = Oparetor::find($id);
        return view('admin.admin_editview')->with('oparetor', $oparetor);
    }
// public function Oparetoredit($id)
// {
// $oparetor = Oparetor::find($id);
// return view('admin.admin_edit')->with('oparetor',$oparetor);
// }
//---------  oparetor edit end-------------//
//-----------Oparetor update start----------//
    public function oparetor_update_store(Request $request, $id)
    {
        $oparetor = Oparetor::find($id);
        $oparetor->first_name = $request->first_name;
        $oparetor->phone = $request->phone;
        $oparetor->email = $request->email;
        $oparetor->branch = $request->branch;
        $oparetor->department = $request->department;

        if ($request->department == "সিনিয়র সচিব") {
            $oparetor->status = 1;
        }
        if ($request->department == "অতিরিক্ত সচিব") {
            $oparetor->status = 2;
        }
        if ($request->department == "মাননীয় প্রতিমন্ত্রীর একান্ত সচিব") {
            $oparetor->status = 3;
        }
        if ($request->department == "একান্ত সচিব") {
            $oparetor->status = 4;
        }

        if ($request->department == "সিনিয়র সচিবের একান্ত সচিব") {
            $oparetor->status = 5;
        }
        if ($request->department == "যুগ্মসচিব") {
            $oparetor->status = 6;
        }
        if ($request->department == "উপসচিব") {
            $oparetor->status = 7;
        }
        if ($request->department == "সিনিয়র সহকারী সচিব") {
            $oparetor->status = 8;
        }
        if ($request->department == "সহকারী সচিব") {
            $oparetor->status = 9;
        }

        if ($request->department == "সিনিয়র সিস্টেম এনালিস্ট") {
            $oparetor->status = 10;
        }

        if ($request->department == "সিনিয়র মেইন্টেনেন্স ইঞ্জিনিয়ার") {
            $oparetor->status = 11;
        }

        if ($request->department == "সিস্টেম এনালিস্ট") {
            $oparetor->status = 12;
        }
        if ($request->department == "প্রোগ্রামার") {
            $oparetor->status = 13;
        }

        if ($request->department == "সহকারী মেইন্টেনেন্স ইঞ্জিনিয়ার") {
            $oparetor->status = 14;
        }
        if ($request->department == "হিসাবরক্ষণ") {
            $oparetor->status = 15;
        }

        $oparetor->password = $request->password;
        $oparetor->role = "2";
        $oparetor->is_active = "1";
        $oparetor->save();
        User::where('oparetor_id', $id)
            ->update([
                'is_active' => "1",
                'password' => $request->password,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->first_name
            ]);
        return view('admin.oparetor_edit', ['success' => true])->with('oparetor', $oparetor);
    }

    public function oparetor_update(Request $request, $id)
    {
        $oparetor = Oparetor::find($id);
        $oparetor->first_name = $request->first_name;
        $oparetor->phone = $request->phone;
        $oparetor->email = $request->email;
        $oparetor->branch = $request->branch;
        $oparetor->department = $request->department;

        if ($request->department == "সিনিয়র সচিব") {
            $oparetor->status = 1;
        }
        if ($request->department == "অতিরিক্ত সচিব") {
            $oparetor->status = 2;
        }
        if ($request->department == "মাননীয় প্রতিমন্ত্রীর একান্ত সচিব") {
            $oparetor->status = 3;
        }
        if ($request->department == "একান্ত সচিব") {
            $oparetor->status = 4;
        }

        if ($request->department == "সিনিয়র সচিবের একান্ত সচিব") {
            $oparetor->status = 5;
        }
        if ($request->department == "যুগ্মসচিব") {
            $oparetor->status = 6;
        }
        if ($request->department == "উপসচিব") {
            $oparetor->status = 7;
        }
        if ($request->department == "সিনিয়র সহকারী সচিব") {
            $oparetor->status = 8;
        }
        if ($request->department == "সহকারী সচিব") {
            $oparetor->status = 9;
        }

        if ($request->department == "সিনিয়র সিস্টেম এনালিস্ট") {
            $oparetor->status = 10;
        }

        if ($request->department == "সিনিয়র মেইন্টেনেন্স ইঞ্জিনিয়ার") {
            $oparetor->status = 11;
        }

        if ($request->department == "সিস্টেম এনালিস্ট") {
            $oparetor->status = 12;
        }
        if ($request->department == "প্রোগ্রামার") {
            $oparetor->status = 13;
        }

        if ($request->department == "সহকারী মেইন্টেনেন্স ইঞ্জিনিয়ার") {
            $oparetor->status = 14;
        }
        if ($request->department == "15") {
            $oparetor->status = 15;
        }
        $oparetor->password = $request->password;
        $oparetor->role = "2";
        $oparetor->is_active = "1";
        $oparetor->save();
        User::where('oparetor_id', $id)
            ->update([
                'is_active' => "1",
                'password' => $request->password,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->first_name
            ]);
        return view('admin.oparetor_edit', ['success' => true])->with('oparetor', $oparetor);
    }

//delete funtion start
    public function Oparetordestroy($id)
    {
        Oparetor::destroy($id);
        $oparetors = Oparetor::all();
        $user = User::where('oparetor_id', $id)->get()->first();
        User::destroy($user->id);
        return redirect()->back()->with('success', 'your message,here');
// return view('admin.oparetorlist',['success'=>true])->with('oparetors',$oparetors);
    }
//////////////////////////////////////////////// oparetor end///////////////////////////////////////////////////////////////

/////////////////////////////////////////////// employee start//////////////////////////////////////////////////////////

//---------view add employee page-------------//
    public function CreateEmployee()
    {
        return view('admin.create_employee');
    }
//---------view add employee page end-------------//
//--------- add employee funtion start-------------//
    public function AddEmployee(Request $request)
    {
        $employee = new Employee;
        $employee->first_name = $request->first_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->branch = $request->branch;
        $employee->department = $request->department;
        $employee->password = $request->password;
        $employee->role = "3";
        $employee->is_active = "1";
// if ($request->hasFile('image')) {
// $newImageName=time().'-'.$request->name.'.'.$request->image->extension();
// $image=$request->image->move(public_path('profile_img'),$newImageName);
// $employee->image=$newImageName;
// }
        $employee->save();
        $employee_id = Employee::where('first_name', $request->first_name)->pluck('id');
        User::insert([
            'username' => $request->first_name,
            'role' => "3",
            'is_active' => "1",
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'employee_id' => $employee_id[0]
        ]);
        return view('admin.create_employee', ['success' => true]);
    }
//--------- add employee funtion end-------------//


//--------- add employee list view funtion start-------------//
    public function Employeelist()
    {
        $employees = Employee::all();
        return view('admin.employeelist')->with('employees', $employees);
    }

//--------- add oparetor list view funtion end-------------//
    public function Employeeprofile($id)
    {
        $oparetor = Employee::find($id);
        return view('admin.oparetor_profile')->with('oparetor', $oparetor);
    }

//---------  oparetor edit start-------------//
    public function Employeeedit($id)
    {

        $employee = Employee::find($id);

        return view('admin.employee_edit')->with('employee', $employee);
    }
//---------  oparetor edit end-------------//
//-----------Oparetor update start----------//
    public function Employee_update(Request $request, $id)
    {

        $employee = Employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->branch = $request->branch;
        $employee->department = $request->department;
        $employee->password = $request->password;
        $employee->role = "3";
        $employee->is_active = "1";
// if($request->hasFile('image') && $request->image->isValid()){
// if(file_exists(public_path('profile_img/'.$employee->image))){
// unlink(public_path('profile_img/'.$employee->image));
// }
// $newImageName=time().'-'.$request->name.'.'.$request->image->extension();
// $image=$request->image->move(public_path('profile_img'),$newImageName);
// $employee->image=$newImageName;
// }
        $employee->save();
        User::where('employee_id', $id)
            ->update([
                'is_active' => "1",
                'password' => $request->password,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->first_name
            ]);
        return view('admin.employee_edit', ['success' => true])->with('employee', $employee);
    }

//delete funtion start
    public function Employeedestroy($id)
    {
        Employee::destroy($id);
        $employees = Employee::all();
        $user = User::where('employee_id', $id)->get()->first();
        User::destroy($user->id);
        return view('admin.employeelist', ['success' => true])->with('employees', $employees);
    }
//delete funtion end
//-----------oparetor update end----------//
//---------------------------------------Oparetorend------------------------------------------------//
//---------------------------------------employee start---------------------------------------------------------------------//
//---------------------------------------Admin start--------------------------------------------------------------------//
    public function adminprofile(Request $req)
    {
        $id = session('id');
        $user = User::where('id', $id)->first();
        return view('admin.admin_profile')->with('user', $user);
    }

    public function pro_update($id)
    {
        $admin = User::find($id);
        return view('admin.admin_profile_edit')->with('admin', $admin);
    }

    public function profile_update(Request $req)
    {
        $id = session('id');
        $user = User::find($id);
        $user->username = $req->username;
// $user->first_name =$req->first_name;
// $user->last_name =$req->last_name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->password = $req->password;
        $user->save();

        Oparetor::where('id', $user->oparetor_id)->update([
            'password' => $req->password,
            'email' => $req->email,
            'phone' => $req->phone,
            'first_name' => $req->username
        ]);
//   $user->is_active="1";
//   $newImageName=time().'-'.$req->name.'.'.$req->image->extension();
//  $image=$req->image->move(public_path('profile_img'),$newImageName);
//   $user->image=$newImageName;
        $user = User::where('id', $id)->first();
        return view('admin.admin_profile')->with('user', $user);
    }
//---------------------------------------admin
//---------------------------------------admin end--------------------------------------------------------------------//
    public function JoinList()
    {
        $day = now();
        $applications = Application::Where('approve', "1")->where('start', '<=', Carbon::now()->format('Y-m-d'))->where('end', '>=', Carbon::now()->format('Y-m-d'))->get()->pluck('employee_id');
        $applications = User::whereNotIn('id', $applications)->get();
        return view('admin.joinemp')->with('applications', $applications);
    }

    public function LeaveList()
    {
        $day = now();
        $applications = Application::Where('approve', "1")->where('start', '<=', Carbon::now()->format('Y-m-d'))->where('end', '>=', Carbon::now()->format('Y-m-d'))->get();

        return view('admin.leavelist')->with('applications', $applications);
    }

    public function SendApplication()
    {
        $id = session('id');
        $user = User::where('role', "2")->whereNotIn('id', [$id])->get();
        $superadmin = User::where('role', "1")->get();


        $dept = User::where('id', $id)->get()->first();
        $dept = $dept->oparetor_id;
        $dept = Oparetor::where('id', $dept)->get()->first();

        return view('admin.sendaplication', compact('user', 'dept', 'superadmin'));
    }

    public function ApplicationStore(Request $request)
    {

        $Sdate = Carbon::parse($request->start)->startOfDay();
        $edate = Carbon::parse($request->end)->endOfDay();
        $days = $Sdate->diffInDays($edate);
        $total_days = $days + 1;
        $leave = Application::where('employee_id', $request->employee_id)->where('start', $request->start)->where('end', $request->end)->first();
        if ($total_days > 10) {
            $request->session()->flash('application', 'সর্বোচ্চ ১০ দিন ছুটি নিতে পারবেন ');
            return redirect('/admin/send/application');
        }
        if ($leave != null) {
            $request->session()->flash('application', 'উক্ত তারিখে ছুটির আবেদন পূর্বে গৃহীত করা রয়েছে! ');
            return redirect('/admin/send/application');
        } else {
            $application = new Application;

            $application->name = $request->name;
            $application->department = $request->department;
            $application->admin_id = $request->admin_id;
            $application->employee_id = $request->employee_id;
            $application->reason = $request->reason;
            $application->stay = $request->stay;
            $application->start = $request->start;
            $application->end = $request->end;
            $application->total_days = $total_days;
            $application->save();
            $applications = Application::all();
            $email = User::where('id', $request->admin_id)->get()->first();
            // dd($email);
            $email = $email->email;
            // $details = [
            //     'title' => 'নৈমিত্তিক ছুটি ব্যবস্থাপনা',
            //     'body' => $request->name .'ছুটির  জন্য আবেদন করেছে'
            // ];
            // Mail::to($email)->send(new \App\Mail\MyTestMail($details));
            return redirect('/oparetor');
        }


// return view('employee.sendaplication',['success'=>true])->with('applications',$applications);
    }

    public function ApplicationList($id)
    {
        $applications = Application::Where('employee_id', $id)->get()->all();
        // $applications=$applications->employee_id;
        //   $applications=Application::find($applications);


        return view('employee.applicationlist')->with('applications', $applications);
    }


    public function PendingApplication()
    {
        $id = session('id');
        $applications = Application::where('admin_id', $id)->where('approve', null)->orderBy('id', 'DESC')->get();

        return view('admin.applicationpending', compact('applications'));
    }

    public function ApproveApplication($id)
    {

        $applications = Application::find($id);

        $applications->update([
            'approve' => 1,
        ]);

        $applications = $applications->employee_id;
        $email = User::where('id', $applications)->get()->first();
        $email = $email->email;
        // $details = [
        //     'title' => 'Leave',
        //     'body' => 'your leave application is Approved'
        // ];
        // Mail::to($email)->send(new \App\Mail\MyTestMail($details));


        return redirect()->route('admin.pending.application');
    }

    public function RejectApplication($id)
    {
        $applications = Application::find($id);

        $applications->update([
            'approve' => 0,
        ]);

        $applications = $applications->employee_id;
        $email = User::where('id', $applications)->get()->first();
        $email = $email->email;
        // $details = [
        //     'title' => 'Leave',
        //     'body' => 'your leave application is rejected'
        // ];
        // Mail::to($email)->send(new \App\Mail\MyTestMail($details));

        return redirect()->route('admin.pending.application');
    }

    public function ApplicationReturn($id)
    {
        $application = Application::find($id);

        return view('admin.applicationreturn')->with('application', $application);
    }

    public function ApplicationReturnSend(Request $request, $id)
    {
        $application = Application::find($id);
        $application->update([
            'comment' => $request->comment,
            'return' => "1",
        ]);


        $applications = Application::all();
        return view('admin.applicationpending')->with('applications', $applications);
    }

    public function ApplicationDelete($id)
    {
        Application::destroy($id);
        $applications = Application::all();
        return view('admin.applicationpending', ['success' => true])->with('applications', $applications);

    }

    public function leaveShow($id)
    {
        $now = Carbon::now();
        $now->year;

        $driver = User::where('oparetor_id', $id)->pluck('id')->first();
        $leave = Application::where('employee_id', $driver)->whereYear('end', $now->year)->get();

        return $leave;
    }

    public function leaveShowEmp($id)
    {
        $now = Carbon::now();
        $now->year;

        $driver = User::where('employee_id', $id)->pluck('id')->first();
        $leave = Application::where('employee_id', $driver)->whereYear('end', $now->year)->get();

        return $leave;
    }

    public function AdminShow($app_id)
    {


        $admin = User::find($app_id);

        return response()->json(compact('admin'));
    }

    public function UserProfileDetails($id)
    {


        $user = Oparetor::find($id);

        return view('admin.userprofiledetails', compact('user'));
    }

    public function employeeProfileDetails($id)
    {


        $user = Employee::find($id);

        return view('admin.employeeprofiledetails', compact('user'));
    }


}
