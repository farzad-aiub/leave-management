<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Oparetor;
use App\Models\Admin;
use App\Models\Application;
use Carbon\Carbon;
use App\Http\Requests\OparetorRequest;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OparetorController extends Controller
{
    protected $fullApiUrl = "https://api.mobireach.com.bd/SendTextMessage";
    protected $apiPath = [];
    protected $apiResponse;

    /**
     *Display a listing of the resource.
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
            session()->put('endDate', $endDAte);
        }

        $employeePreviousYear_days = Application::where('employee_id', $id)->where('approve', "1")->whereYear('start', '=', now()->year - 1)->whereYear('end', '=', now()->year)->first();
        if ($employeePreviousYear_days) {
            $endDAte = (int)$endDAte + (int)date('d', strtotime($employeePreviousYear_days->end));
            session()->put('endDate', $endDAte);
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
// $date= Carbon::createFromDate($request->year_name, $request->month);

// $startOfTheMonth = $date->startOfMonth();
// $startOfTheMonth=$startOfTheMonth->toDateString();
// $endOfTheMonth = $date->endOfMonth();
// $endOfTheMonth=$endOfTheMonth->toDateString();

// // return $formatDate;

// $salarypay= Application::whereBetween('salary_date',[$startOfTheMonth,$endOfTheMonth])->sum('paid_salary');

        $applications = Application::Where('approve', "1")->where('start', '<=', Carbon::now()->format('Y-m-d'))->where('end', '>=', Carbon::now()->format('Y-m-d'))->count();
        $employee = User::all()->count();
        $join = $employee - $applications;
        $endDAte = 0;
        return view('admin.index')->with('user', $user)
            ->with('applications', $applications)
            ->with('join', $join)->with('endDAte', $endDAte);
    }

    public function dashboard()
    {
        $id = session('id');
        $user = User::where('id', $id)->first();
        $oparetors = Oparetor::all();
// return view('admin.studentlist')->with('users',$users);
        return view('admin.dashboard')->with('user', $user)
            ->with('oparetors', $oparetors);
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
        $oparetor->last_name = $request->last_name;
        $oparetor->father_name = $request->father_name;
        $oparetor->mother_name = $request->mother_name;
        $oparetor->phone = $request->phone;
        $oparetor->email = $request->email;
        $oparetor->gender = $request->gender;
        $oparetor->department = $request->department;
        $oparetor->present_address = $request->present_address;
        $oparetor->permanent_address = $request->permanent_address;
        $oparetor->nid = $request->nid;
        $oparetor->dob = $request->dob;
        $oparetor->password = $request->password;
        $oparetor->role = "2";
        $oparetor->is_active = "1";
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $image = $request->image->move(public_path('profile_img'), $newImageName);
        $oparetor->image = $newImageName;
        $oparetor->save();
        $oparetor_id = Oparetor::where('first_name', $request->first_name)->pluck('id');
        User::insert([
            'username' => $request->first_name,
            'role' => "2",
            'is_active' => "1",
            'email' => $request->email,
            'password' => $request->password,
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
        return view('admin.oparetor_edit')->with('oparetor', $oparetor);
    }
//---------  oparetor edit end-------------//
//-----------Oparetor update start----------//
    public function oparetor_update(Request $request, $id)
    {
        $oparetor = Oparetor::find($id);
        $oparetor->first_name = $request->first_name;
        $oparetor->last_name = $request->last_name;
        $oparetor->father_name = $request->father_name;
        $oparetor->mother_name = $request->mother_name;
        $oparetor->phone = $request->phone;
        $oparetor->email = $request->email;
        $oparetor->gender = $request->gender;
        $oparetor->department = $request->department;
        $oparetor->present_address = $request->present_address;
        $oparetor->permanent_address = $request->permanent_address;
        $oparetor->nid = $request->nid;
        $oparetor->dob = $request->dob;
        $oparetor->password = $request->password;
        $oparetor->role = "2";
        $oparetor->is_active = $request->is_active;
        if ($request->hasFile('image') && $request->image->isValid()) {
            if (file_exists(public_path('profile_img/' . $oparetor->image))) {
                unlink(public_path('profile_img/' . $oparetor->image));
            }
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $image = $request->image->move(public_path('profile_img'), $newImageName);
            $oparetor->image = $newImageName;
        }
        $oparetor->save();
        User::where('oparetor_id', $id)
            ->update([
                'is_active' => $request->is_active,
                'password' => $request->password,
                'email' => $request->email,
                'username' => $request->first_name
            ]);
        return view('admin.oparetor_edit', ['success' => true])->with('oparetor', $oparetor);
    }

//delete funtion start
    public function Oparetordestroy($id)
    {
        Oparetor::destroy($id);
        $oparetors = Oparetor::all();
        return view('admin.oparetorlist', ['success' => true])->with('oparetors', $oparetors);
    }

///////////////////////application start//////////////////////
    public function PendingApplication()
    {
        $id = session('id');
        $applications = Application::where('admin_id', $id)->where('approve', Null)->orderBy('id', 'DESC')->get();

        return view('admin.applicationpending', compact('applications'));
    }

    public function LeavePendingApplication()
    {
        $id = session('id');
        $applications = Application::where('admin_id', $id)->where('approve', 1)->orWhere('approve', 0)->orderBy('id', 'DESC')->get();

        return view('admin.leaveapplicationpending', compact('applications'));
    }

    public function sendsms($phone)
    {

        $queries = ['To' => "88$phone", 'Message' => "আপনার ছুটির আবেদন অনুমোদিত হয়েছে", "From" => "ICTDivision", "Password" => "Ictd#2015", 'Username' => 'ictdivision'];
        //    ['To'=>$this->contactsString,'Message'=>$this->message,'Username'=>$this->username,'Password'=>$this->password,'From'=>$this->sender];
        //    $client = new Client();
        //    $response = $client->request('GET',$this->fullApiUrl,['query'=>$queries]);
        $response = Http::withHeaders(
            [
                'CONTENT-TYPE' => "application/x-www-form-urlencoded"
            ])
            ->get($this->fullApiUrl, $queries);
        // dd($response);
        $this->apiResponse = ['statusCode' => $response->getStatusCode(), 'reasonPhrase' => $response->getReasonPhrase(), 'serverResponse' => $response->getBody()->getContents()];


    }

    public function sendsmss($phone)
    {

        $queries = ['To' => "88$phone", 'Message' => "আপনার ছুটির আবেদন প্রত্যাখ্যান করা হয়েছে", "From" => "ICTDivision", "Password" => "Ictd#2015", 'Username' => 'ictdivision'];
        //    ['To'=>$this->contactsString,'Message'=>$this->message,'Username'=>$this->username,'Password'=>$this->password,'From'=>$this->sender];
        //    $client = new Client();
        //    $response = $client->request('GET',$this->fullApiUrl,['query'=>$queries]);
        $response = Http::withHeaders(
            [
                'CONTENT-TYPE' => "application/x-www-form-urlencoded"
            ])
            ->get($this->fullApiUrl, $queries);
        // dd($response);
        $this->apiResponse = ['statusCode' => $response->getStatusCode(), 'reasonPhrase' => $response->getReasonPhrase(), 'serverResponse' => $response->getBody()->getContents()];


    }

    public function ApproveApplicationstore($id)
    {

        $applications = Application::find($id);
        $day = $applications->total_days;

        $applications->update([
            'approve' => 1,
            'total' => $day,
        ]);
        $applications = $applications->employee_id;
        $email = User::where('id', $applications)->get()->first();
        $email = $email->email;
        $phone = User::where('id', $applications)->get()->first();
        $phone = $phone->phone;

        $this->sendsms($phone);
        // $details = [
        //     'title' => 'নৈমিত্তিক ছুটি ব্যবস্থাপনা',
        //     'body' => 'আপনার ছুটির আবেদন অনুমোদিত হয়েছে'
        // ];
        // Mail::to($email)->send(new \App\Mail\MyTestMail($details));

        // $number=01712345678;
        // $message='this is a demo Example form Laravel bulksmsBD Package.';
        // BulkSMSBD::send($number,$message);

        return redirect()->route('pending.application');
    }

    public function ApproveApplication(Request $request, $id)
    {
        $Sdate = Carbon::parse($request->start)->startOfDay();
        $edate = Carbon::parse($request->end)->endOfDay();
        $days = $Sdate->diffInDays($edate);
        $total_days = $days + 1;

        $applications = Application::find($id);
        $day = $applications->total_days;


        $applications->update([
            'approve' => 1,
            'total' => $day,
            // 'total_days' => $request->approve_days,
            'comment' => $request->comment,
            'start' => $request->start,
            'end' => $request->end,
            'total_days' => $total_days,

        ]);
        $applications = $applications->employee_id;
        $email = User::where('id', $applications)->get()->first();
        $email = $email->email;
        $phone = User::where('id', $applications)->get()->first();
        $phone = $phone->phone;

        $this->sendsms($phone);
        // $details = [
        //     'title' => 'নৈমিত্তিক ছুটি ব্যবস্থাপনা',
        //     'body' => 'আপনার ছুটির আবেদন অনুমোদিত হয়েছে'
        // ];
        // Mail::to($email)->send(new \App\Mail\MyTestMail($details));

        // $number=01712345678;
        // $message='this is a demo Example form Laravel bulksmsBD Package.';
        // BulkSMSBD::send($number,$message);

        return redirect()->route('pending.application');
    }

    public function RejectApplication(Request $request, $id)
    {
        $applications = Application::find($id);

        $applications->update([
            'approve' => 0,
            'comment' => $request->comment,
        ]);
        $applications = $applications->employee_id;
        $email = User::where('id', $applications)->get()->first();
        $phone = User::where('id', $applications)->get()->first();
        $phone = $phone->phone;

        $this->sendsmss($phone);
        $email = $email->email;
        // $details = [
        //     'title' => 'নৈমিত্তিক ছুটি ব্যবস্থাপনা',
        //     'body' => 'আপনার ছুটির আবেদন প্রত্যাখ্যান করা হয়েছে'
        // ];
        // Mail::to($email)->send(new \App\Mail\MyTestMail($details));
        return redirect()->route('pending.application');
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
        return redirect()->back();

    }

///////////////////////application end//////////////////////
//delete funtion end
//-----------oparetor update end----------//
//---------------------------------------Oparetorend------------------------------------------------//

//active suspend funtion end
//---------------------------------------teacher end---------------------------------------------------------------------//
//---------------------------------------student start---------------------------------------------------------------------//

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
        Oparetor::where('id', $user->oparetor_id)
            ->update([
                'is_active' => "1",
                'password' => $req->password,
                'email' => $req->email,
                'phone' => $req->phone,
                'first_name' => $req->username
            ]);
        $user = User::where('id', $id)->first();
        return view('admin.admin_profile')->with('user', $user);
    }

//---------------------------------------admin end---------------------------------------------------------------------//
    public function resultlist()
    {
        $users = User::all();
        return view('admin.resultlist')->with('users', $users);
    }

    public function result_edit($id)
    {
        $user = User::find($id);
        return view('admin.result_edit')->with('user', $user);
    }

    public function usersPending()
    {
        $users = User::all();
        return view('admin.usersPending')->with('users', $users);
    }

    public function ApplicationList($id)
    {
        $applications = Application::Where('employee_id', $id)->get()->all();
        // $applications=$applications->employee_id;
        //   $applications=Application::find($applications);


        return view('employee.applicationlist')->with('applications', $applications);
    }

    public function ConfirmApproveApplication($id)
    {
        $applications = Application::find($id);

        return view('admin.ConfirmApproveApplication')->with('applications', $applications);
    }

    public function ConfirmRejectApplication($id)
    {
        $applications = Application::find($id);

        return view('admin.confirmRejectApplication')->with('applications', $applications);
    }

    public function ApplicationDetails($id)
    {
        $application = Application::find($id);
        $adminInfo=User::where('users.id',$application->admin_id)
            ->leftJoin('oparetors','oparetors.id','users.oparetor_id')
            ->first();
//        return  $adminInfo;

        return view('admin.applicationdetails',compact('application','adminInfo'));
    }
}
