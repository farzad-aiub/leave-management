<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Rakibhstu\Banglanumber\NumberToBangla;
use Rajurayhan\Bndatetime\BnDateTimeConverter;

class ReportController extends Controller
{
    public function index(){


//        $applications =Application::get();
        $applications =Application::get();
        $emp=User::get();

//        $datatables = Datatables::of($applications);
//        return $datatables->make(true);
//        return $applications;
        return view('admin.advanceReport',compact('emp'));
    }

    public function data(Request $r){
        $numto = new NumberToBangla();
        $dateConverter  =  new  BnDateTimeConverter();

        $role = session('role');
//        return $role;
        if($role==1){
            $applications =Application::select("*");
        }
        else{
            $applications =Application::select("*")->where('admin_id',session('id'));
        }

        if($r->empName){
            $applications=$applications->where('employee_id',$r->empName);
        }

        if($r->start_dt){ $applications=$applications->where('start','>=',$r->start_dt);}
        if($r->end_dt){ $applications=$applications->where('end','<=',$r->end_dt);}
        if($r->status !=4){ $applications=$applications->where('approve',$r->status);}

        $applications=$applications->get();
        $datatables = Datatables::of($applications)
            ->addColumn('total_days_bangla',function ($data) use ($numto){
                return $numto->bnNum($data->total_days);
            })->addColumn('start',function ($data) use ($dateConverter){
                return  $dateConverter->getConvertedDateTime($data->start,  'BnEn', '');
            })->addColumn('end',function ($data) use ($dateConverter){
                return  $dateConverter->getConvertedDateTime($data->end,  'BnEn', '');
            });
        return $datatables->make(true);

    }
}
