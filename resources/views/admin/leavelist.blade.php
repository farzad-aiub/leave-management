@extends('admin.admin_master')
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

                        <!-- start page title -->
                        <div class="row">
                          <div class="col-12">
                              <div class="card">
                                  <div class="card-body">
                                      <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                          <thead>
                                              <tr>
                                                <th >#</th>
                                                <th>নাম</th>
                                                <th>আবেদনের কারণ</th>
                                                <th>ছুটির মেয়াদকাল</th>
                                                <th>সর্বমোট ছুটি</th>
                                                <th> ছুটি বাকি আছে </th>
                                                <th>অবস্থান</th>
                                              </tr>
                                          </thead>


                                          <tbody>
                                              <tr>
                                                @php
                                      $serial=1;
                                  @endphp
                                @foreach ($applications as $application)

                                @php   
                                $total_days = $numto->bnNum($application->total_days); 
                               
                             $start=   $dateConverter->getConvertedDateTime($application->start,  'BnEn', ''); 
                             $end=   $dateConverter->getConvertedDateTime($application->end,  'BnEn', ''); 
                            @endphp

                                <th scope="row">{{$serial++}}</th>
                                <td> <p  name="btn" data-end="{{$application->end}}" data-start="{{$application->start}}" data-total_days="{{$application->total_days}}" value="{{$application->employee->username}}" class="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-default">{{$application->employee->username}}</p> </td>
                                <td>{{$application->reason}}</td>
                                <td>{{$start}} To {{$end}}</td>
                                <td><input type="hidden" value="{{$application->total_days}} দিন"  class="leave">{{$total_days}} দিন</td>
                                @php
                                    $Sdate =  Carbon\Carbon::parse($application->start)->startOfDay();
                                    $edate = Carbon\Carbon::parse($application->end)->endOfDay();
                                    $day=now();
                                    $days = $edate->diffInDays($day);
                                    $dayy=$days+1;
                                    $d= $numto->bnNum($dayy); 
                                    
                                @endphp
                                <td><input type="hidden" value="{{$application->total_days}} দিন"  class="leave">{{$d}} দিন</td>
                                <td>{{$application->stay}}</td>
                                              </tr>


                                              {{-- <input  type="button" name="btn" value="{{$application->name}}" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-default"> --}}

                                             @endforeach
                                          </tbody>
                                      </table>

                                  </div> <!-- end card body-->
                              </div> <!-- end card -->
                          </div><!-- end col-->
                      </div>
                      <!-- end row-->
                                {{-- modal --}}

<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <table class="table">
                    <tr>
                        <th>ছুটি নিয়েছে</th>
                        <td id="leaveShow"></td>
                    </tr>
                    <tr>
                        <th>ছুটি বাকি রয়েছে</th>
                        <td id="enoughShow"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click','.submitBtn',function(e){
        e.preventDefault();
        let total_days   = this.dataset.total_days;
        let end   = this.dataset.end;
        let start = this.dataset.start;


        //check start date
        var date1 = new Date(start);
        var date2 = new Date(end);

        let {Difference_In_Days,Hours,Minutes} = getDifferenceDays(date1,date2)


        console.log(Difference_In_Days,'left days')

        $('#leaveShow').text(total_days + " দিন");
        $('#enoughShow').text(Difference_In_Days+ " দিন " + Hours + " ঘন্টা " +  "      "  +  Minutes + " মিনিট বাকি ");
    })



    function getDifferenceDays(start,end){
        console.log(end);
        let todays = new Date();
        // var Difference_In_Time = (todays.getTime() - start.getTime());
        let Difference_In_Time = (end.getTime() - todays.getTime());
        // To calculate the no. of days between two dates\
        // let Month              = Math.floor(Difference_In_Time / (1000 * 3600 * 24*30));
        var Difference_In_Days = Math.floor(Difference_In_Time / (1000 * 3600 * 24))+1;
        var Hours   = Math.floor((Difference_In_Time % (1000 * 3600 * 24)) / (3600*1000));
        var Minutes = Math.floor(((Difference_In_Time % (1000 * 3600 * 24)) % (3600*1000))/(60*1000));
        console.log(Difference_In_Days,'before',todays.getDate() , end.getDate())
        // if(todays.getDate() === )
        console.log(Difference_In_Days+1,Hours,Minutes);
        return {Difference_In_Days,Hours,Minutes};
    }

</script>
<script src="{{asset('public\assets\js\pages\datatables.init.js')}}"></script>
 @endsection
