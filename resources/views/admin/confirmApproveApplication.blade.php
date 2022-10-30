@extends('../admin.admin_master')
@section('main_contant')

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            @php

use Rakibhstu\Banglanumber\NumberToBangla;
use Rajurayhan\Bndatetime\BnDateTimeConverter;
    $numto = new NumberToBangla();
    $dateConverter  =  new  BnDateTimeConverter();
   
@endphp
@php   
               $total_days = $numto->bnNum($applications->total_days); 
              
               
           @endphp

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <!-- <h4 class="mb-0 font-size-18">আবেদনপত্র </h4> -->

                                    

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                    <center>
                    <div class="panel-body">
                            <div class="portlet-body form">
                            <form   class="form-horizontal" method="post"  action="{{url('/approve/' .$applications->id)}}"  enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                         @csrf
                                
                            <div class="form-body">

                                <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <Label>আবেদনকৃত ছুটি</Label>
                                    <input class="form-control" disabled name="approve_days" type="text" value="{{$total_days}} দিন">
                                </div>
                                <div class="col-md-6"></div>
                               
                               
                               </div> 
                               <br></br>
                               <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    <Label>ছুটির মেয়াদকাল শুরু</Label>
                                    <input class="form-control" name="start" type="date" value="{{$applications->start}}">
                                </div>
                                <div class="col-md-2">
                                    <Label>ছুটির মেয়াদকাল শেষ</Label>
                                    <input class="form-control" name="end" type="date" value="{{$applications->end}}">
                                </div>
                               
                                <div class="col-md-2"></div>
                               </div> <br>
                               <div class="row">
                           
                             <div class="col-md-2"></div>
                             <div class="col-md-4">   
                                <label for="" class="from-control"><h3>মন্তব্য</h3></label> <br>
                                {{-- <input type="textarea" class="form-control" cols="50" rows="3"> --}}
                                <textarea  name="comment"  id="" cols="45" rows="4"></textarea>
                          
                           </div>
                             <div class="col-md-6"></div>
                               </div>

                                </div>

                                   <div class="form-group ">
                                   <div class="row">
                           
                           <div class="col-md-3"></div>
                           <div class="col-md-2">
                           <button type="submit"  class="btn btn-success sav_btn"> দাখিল</button>
                           </div>
                                            
                                           
                                            {{-- <button type="submit" onclick="return confirm('It is disabled only at demo mode!')" class="btn btn-success sav_btn">Submit </button> --}}
                                     
                                    </div>

                                </form>
                            </div>
                        </div>
                    </center>

               
 @endsection
