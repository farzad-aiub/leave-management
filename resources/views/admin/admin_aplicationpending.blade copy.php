@extends('admin.admin_master')
@section('main_contant')
@php
use Rakibhstu\Banglanumber\NumberToBangla;
use Rajurayhan\Bndatetime\BnDateTimeConverter;
    $numto = new NumberToBangla();
    $dateConverter  =  new  BnDateTimeConverter();
   
@endphp




<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                          <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>নাম ও পদবী</th>
                                      <th>মেয়াদকাল শুরু</th>
                                      <th>মেয়াদকাল শেষ</th>
                                      <th>সর্বমোট ছুটি</th>
                                      <th>কারণ</th>
                                      <th>ছুটিকালীন অবস্থান</th>
                                      <th>আবেদনের তারিখ</th>
                                      <th>ভোগকৃত ছুটি</th>
                                      <th>অবশিষ্ট ছুটি</th>
                                      <th>মন্তব্য</th>
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
                          
                           $start=   $dateConverter->getConvertedDateTime($application->start,  'EnBn', ''); 
                           $end=   $dateConverter->getConvertedDateTime($application->end,  'EnBn', ''); 
                          @endphp
                              <th scope="row">{{$serial++}}</th>

                              <td>{{$application->name}}
                                <br>
                                {{$application->department}}
                            </td>
                              <td>{{$start}}</td>
                              <td> {{$end}}</td>
                              <td> <input type="hidden" id="leave" value="{{$application->total_days}} দিন">{{$application->total_days}} দিন</td>
                              <td>{{$application->reason}}</td>
                              <td>{{$application->stay}}</td>
                              <td>{{$application->created_at}}</td>
                              @php
                              $year=\Carbon\Carbon::now();
                              $now=$year->year;
                              $app=$application->employee_id;
                              $appp=\App\Models\Application::where('employee_id',$app)->where('approve',1)->whereYear('end',$now)->sum('total_days');
                              $app = $numto->bnNum($appp); 
                                $ap=20-$appp;
                                $ap = $numto->bnNum($ap); 
                           @endphp
                              <td>{{$app}} দিন</td>
                              <td>{{ $ap}} দিন</td>

                              <td>


                                  @if ($application->approve == Null)
                                  <a href="/admin/approve/{{$application->id}}"><button class="btn btn-success"  value="1">অনুমোদন</button></a>
                                  <a href="/admin/reject/{{$application->id}}"> <button class="btn btn-danger"  value="0">বাতিল </button></a>
                                  @elseif ($application->approve == 1)
                                  <h3 style="color: rgb(28, 172, 40)">অনুমোদিত</h3>
                                  @elseif ($application->approve == 0)
                                  <h3 style="color: red">প্রত্যাখ্যাত</h3>
                                  @endif
                                  <!-- {{-- <a href="/application/return/{{$application->id}}"><button class="btn btn-primary">ফিরিয়ে দিন</button></a> --}}
                                  {{-- <a href="/application/delete/{{$application->id}}"><button class="btn btn-danger">বাদ দিন</button></a> --}} -->
                              </td>
                                  </tr>




                                 @endforeach
                              </tbody>
                          </table>

                      </div> <!-- end card body-->
                  </div> <!-- end card -->
              </div><!-- end col-->
          </div>
          <!-- end row-->


 @endsection
