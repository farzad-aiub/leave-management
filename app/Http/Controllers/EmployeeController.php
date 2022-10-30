<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Oparetor;
use App\Models\Employee;
use App\Models\Application;
use DateTime;
use App\Http\Requests\OparetorRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mail;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    protected $fullApiUrl = "https://api.mobireach.com.bd/SendTextMessage";
    protected $apiPath = [];
    protected $apiResponse;
    public function index()
    {
        $id = session('id');
        $user=User::where('id',$id)->first();
        $m=now();
        // dd($Sdate->month);
        $emp=Application::where('employee_id',$id)->where('approve',"1")->orderBy('id', 'DESC')->get()->first();
        $endDAte=Application::where('employee_id',$id)->where('approve',"1")->whereYear(
            'start','=',now()->year
        )->sum('total_days');
        $emp_minuesLeaves = Application::where('employee_id',$id)->where('approve',"1")->whereYear('start','=',now()->year)->whereYear('end','=',now()->year+1)->first();
        if($emp_minuesLeaves){
        $endDAte =(int) $endDAte - (int) date('d',strtotime($emp_minuesLeaves->end)) ;
        }

        $employeePreviousYear_days = Application::where('employee_id',$id)->where('approve',"1")->whereYear('start','=',now()->year-1)->whereYear('end','=',now()->year)->first();
        if($employeePreviousYear_days){
            $endDAte =(int)$endDAte + (int) date('d',strtotime($employeePreviousYear_days->end)) ;
        }





       if ($emp != null) {

        $Sdate = Carbon::parse($emp->start)->startOfDay();
        $edate = Carbon::parse($emp->end)->endOfDay();
        $days = $Sdate->diffInDays($edate);
        $days=$days+1;

        // $emp=Application::where('employee_id',$id)->where('approve',"1")->where('id', 'DESC')->get();
        //
        //  $days = $interval->format('%a');
        return view('employee.index')->with ('user',$user)
        ->with('days',$days)
        ->with('endDAte',$endDAte);
       }
       $endDAte=0;
        return view('employee.index')->with ('user',$user)
        ->with('endDAte',$endDAte);
    }
    public function SendApplication ()
    {
//        return "asdas";
        $user = User::where('role', "2")->get();
        $id = session('id');
        $dept=User::where('id',$id)->get()->first();
        $dept=$dept->employee_id;
        $dept=Employee::where('id',$dept)->get()->first();


        return view('employee.sendaplication',compact('user','dept'));
    }
    public function WeekDayCount(Request $r){
        Carbon::setWeekendDays([
            Carbon::FRIDAY,
            Carbon::SATURDAY,
        ]);

        $Sdate = Carbon::parse($r->startDt)->startOfDay();
        $edate = Carbon::parse($r->endDt)->endOfDay();
        $days = $Sdate->diffInWeekdays($edate);
        return $days;
    }
    public function ApplicationStore(Request $request)
    {
        Carbon::setWeekendDays([
            Carbon::FRIDAY,
            Carbon::SATURDAY,
        ]);
//        return $request;
        $Sdate = Carbon::parse($request->start)->startOfDay();
        $edate = Carbon::parse($request->end)->endOfDay();
//        $days = $Sdate->diffInDays($edate);
        $days = $Sdate->diffInWeekdays($edate);



//        $total_days=$days+1;
        $total_days=$days;

//        return $total_days;

        $leave=Application::where('employee_id',$request->employee_id)->where('start',$request->start)->where('end',$request->end)->first();

        if ($total_days > 10) {
            $request->session()->flash('application', 'সর্বোচ্চ ১০ দিন ছুটি নিতে পারবেন ');
            return redirect('/send/application');
        }
        if ($leave != null) {
            $request->session()->flash('application', 'উক্ত তারিখে ছুটির আবেদন পূর্বে গৃহীত করা রয়েছে! ');
            return redirect('/send/application');
        }
        else{

            $application= new Application;

            $application->name=$request->name;
            $application->department=$request->department;
            $application->admin_id=$request->admin_id;
            $application->employee_id=$request->employee_id;
            $application->reason=$request->reason;
            $application->stay=$request->stay;
            $application->start=$request->start;
            $application->end=$request->end;
            $application->total_days= $total_days;
            $application->save();
            $applications=Application::all();
            $email=User::where('id',$request->admin_id)->get()->first();
            $email=$email->email;
            $phone=User::where('id',$request->admin_id)->get()->first();
            $phone=$phone->phone;
            $name=$request->name;

// $this->sendsms($phone,$name);
// $details = [
//     'title' => 'নৈমিত্তিক ছুটি ব্যবস্থাপনা',
//     'body' => $request->name .'ছুটির  জন্য আবেদন করেছে'
// ];
// Mail::to($email)->send(new \App\Mail\MyTestMail($details));
            return redirect('/employee');

        }


// return view('employee.sendaplication',['success'=>true])->with('applications',$applications);
    }
    public function sendsms($phone,$name){

        $queries = ['To'=>"88$phone",'Message'=>"$name ছুটির  জন্য আবেদন করেছে","From"=>"ICTDivision","Password"=>"Ictd#2015",'Username'=>'ictdivision'];
     //    ['To'=>$this->contactsString,'Message'=>$this->message,'Username'=>$this->username,'Password'=>$this->password,'From'=>$this->sender];
     //    $client = new Client();
     //    $response = $client->request('GET',$this->fullApiUrl,['query'=>$queries]);
        $response = Http::withHeaders(
            [
                'CONTENT-TYPE'=>"application/x-www-form-urlencoded"
            ])
         ->get($this->fullApiUrl,$queries);
         // dd($response);
        $this->apiResponse = ['statusCode'=>$response->getStatusCode(),'reasonPhrase'=>$response->getReasonPhrase(),'serverResponse'=>$response->getBody()->getContents()];

            }

    public function ApplicationList($id)
    {
        $applications = Application::Where('employee_id',$id)->get()->all();
        // $applications=$applications->employee_id;
        //   $applications=Application::find($applications);


return view('employee.applicationlist')->with('applications',$applications);
    }
    public function ApplicationReturnList($id)
    {
        $applications = Application::Where('employee_id',$id)->where('return',"1")->get()->all();
        // $applications=$applications->employee_id;
        //   $applications=Application::find($applications)


return view('employee.applicationreturnlist')->with('applications',$applications);
    }
    public function ApplicationReturnDetails($id)
    {
        $application = Application::find($id);


return view('employee.applicationreturndetails')->with('application',$application);
    }
//---------------------------------------employee start--------------------------------------------------------------------//
public function adminprofile(Request $req)
{
$id = session('id');
$user=User::where('id',$id)->first();
return view('employee.employee_profile')->with ('user',$user);
}

public function pro_update( $id)
{
$admin=User::find($id);
return view('employee.employee_profile_edit')->with('admin',$admin);
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
$user->password =$req->password;
$user->save();
Employee::where('id', $user->employee_id)->update([
    'password' => $req->password,
    'email' => $req->email,
    'phone' => $req->phone,
    'first_name'=>$req->username
    ]);

return redirect('employee/profile');
// $user=User::where('id',$id)->first();
// return view('admin.admin_profile')->with ('user',$user);
}
//---------------------------------------employee start
}
