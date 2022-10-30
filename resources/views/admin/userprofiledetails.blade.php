@extends('admin.admin_master')
@section('main_contant')

      <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
                        <!-- start page title -->
@php

use Rakibhstu\Banglanumber\NumberToBangla;
use Rajurayhan\Bndatetime\BnDateTimeConverter;
    $numto = new NumberToBangla();
    $dateConverter  =  new  BnDateTimeConverter();
   
@endphp
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">প্রোফাইল</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{$user->username}}</a></li>
                                            <li class="breadcrumb-item active">প্রোফাইল</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="bg-soft-primary">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
                                                    <h5 class="text-primary">প্রোফাইলে স্বাগতম !</h5>
                                                    <p>{{$user->username}}</p>
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="{{asset('assets\images\profile-img.png')}}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                {{-- <div class="avatar-md profile-user-wid mb-4">
                                                    <img src="{{asset('assets\images\users\avatar-1.jpg')}}" alt="" class="img-thumbnail rounded-circle">
                                                </div> --}}
                                                <h5 class="font-size-15 text-truncate">অ্যাডমিন</h5>
                                             
                                            </div>

                                            <div class="col-sm-8">
                                                <div class="pt-4">

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="font-size-15">পদবি: {{$user->department}}</h5>
                                                            <p class="text-muted mb-0">ইমেইল: {{$user->email}}</p>
                                                        </div>
                                                    </div>
                                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->


                            </div>

                            <div class="col-xl-8">
                                <div class="card">
                                <div class="card-body">
                                        <h4 class="card-title mb-4">ব্যক্তিগত তথ্য</h4>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">নাম:</th>
                                                        <td>{{$user->first_name}}</td>
                                                    </tr>
                                                    @php   
                                                    $phone = $numto->bnNum($user->phone); 
                                                   
                                                @endphp
                                                    <tr>
                                                        <th scope="row">মুঠোফোন :</th>
                                                        <td>{{$phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">ইমেইল :</th>
                                                        <td>{{$user->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">শাখা :</th>
                                                        <td>{{$user->branch}}</td>
                                                    </tr>
                                                    @php
               $year=\Carbon\Carbon::now();
               $now=$year->year;
            
               $use=\App\Models\User::where('oparetor_id',$user->id)->first();
               $id=$use->id;
               $appp=\App\Models\Application::where('employee_id',$id)->where('approve',1)->whereYear('end',$now)->sum('total_days');
              
                 $app = $numto->bnNum($appp); 
                 $ap=20-$appp;
                 $ap = $numto->bnNum($ap); 
            @endphp
            <tr>
                                                        <th scope="row">ভোগকৃত ছুটি :</th>
                                                        <td>{{$app}} দিন</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">অবশিষ্ট  ছুটি :</th>
                                                        <td>{{$ap}} দিন</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                   
  
</div>
                        </div>
@php
//  $id=session('id');
//   $date= \App\Models\Application::where('employee_id',$id)->where('start','<=', $now)->where('end','>=', $now)->where('approve',1)->first();

    $driver = \App\Models\User::where('oparetor_id', $user->id)->pluck('id')->first();
    $application = \App\Models\Application::where('employee_id',$driver)->get();
    @endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                          {{-- <th>#</th> --}}

                          <th>আবেদনের তারিখ	</th>
                          <th>তারিখ হতে	</th>
                          <th>তারিখ পর্যন্ত</th>
                          <th>আবেদনকৃত ছুটি</th>
                          <th>অনুমোদিত ছুটি</th>
                          <th>অবস্থান</th>
                          <th>কারণ</th>
                          <th>অবস্থা </th>
                              
                        </tr>
                    </thead>
                
                
                    <tbody>
                       
                       <tr>
                          @php
                          $serial=1;
                      @endphp
                    @foreach ($application   as $app)


                    @php   
                    $total_days = $numto->bnNum($app->total_days); 
                    if ($app->total != null) {
                $total = $numto->bnNum($app->total); 
             }else{
                
             }
                   
                    $start=   $dateConverter->getConvertedDateTime($app->start,  'BnEn', ''); 
                    $end=   $dateConverter->getConvertedDateTime($app->end,  'BnEn', ''); 
                    $created_at=   $dateConverter->getConvertedDateTime($app->created_at,  'BnEn', ''); 
                @endphp
                    
                    <td>{{$created_at}}</td>
                    <td>{{$start}}</td>
                    <td>{{$end}}</td>
                    @if ($app->total == null)
                                                        
                    <td>{{$total_days}} দিন</td>
                    @else
                           <td>{{$total}} দিন</td>
                                                        @endif
                                                        @if ($app->total == null)
                                                        <td>০ দিন</td>
                                                            @else
                                                            <td>{{$total_days}} দিন</td>
                                                        @endif                                                   
                                                     
                    <td>{{$app->stay}}</td>
                    <td>{{$app->reason}}</td>
                    <td>
                                              @if ($app->approve == Null)
                                              <h3 style="color: rgb(188, 228, 94)">অপেক্ষমাণ..</h3>
                                             <a href="/application/delete/{{$application->id}}"><i  class="fas fa-trash btn btn-danger"></i></a>
                                             
                                              @elseif ($app->approve == 1)
                                              <h3 style="color: rgb(28, 172, 40)">অনুমোদিত</h3>
                                              @elseif ($app->approve == 0)
                                              <h3 style="color: red">প্রত্যাখ্যাত</h3>
                                              @endif
                                          </td>
                    
          
                        </tr>
                       
                      
                      
                         
                       @endforeach
                    </tbody>
                </table>
                
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
                        <!-- end row -->

                        <script src="{{asset('public\assets\js\pages\datatables.init.js')}}"></script>  

                    @endsection

