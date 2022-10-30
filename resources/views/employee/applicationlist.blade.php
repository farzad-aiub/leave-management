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
                                                 <th>#</th>
                                                 {{-- <th>আবেদনের কারণ</th>
                                                 <th>আবেদনের তারিখ</th> --}}

                                                 <th>ছুটির মেয়াদকাল শুরু</th>
                                                 <th>ছুটির মেয়াদকাল শেষ</th>

                                                 <th>আবেদনকৃত ছুটি</th>
                                                 <th>অনুমোদিত ছুটি</th>


                                                 {{-- <th>অবস্থান</th> --}}
                                                 <th>বর্তমান অবস্থা</th>
                                                 <th>বিস্তারিত</th>

                                              </tr>
                                          </thead>


                                          <tbody>
                                              <tr>
                                                @php
                                                $serial=1;
                                            @endphp
                                          @foreach ($applications as $application)
                                          @php
                                          if ($application->total != null) {
                $total = $numto->bnNum($application->total);
             }else{

             }
                                          $total_days = $numto->bnNum($application->total_days);
                                          $start=   $dateConverter->getConvertedDateTime($application->start,  'BnEn', '');
                                          $end=   $dateConverter->getConvertedDateTime($application->end,  'BnEn', '');
                                          $created_at=   $dateConverter->getConvertedDateTime($application->created_at,  'BnEn', '');
                                      @endphp

                                          <th scope="row">{{$serial++}}</th>
                                          {{-- <td>{{$application->reason}}</td> --}}
                                          {{-- <td>{{$created_at}}</td> --}}
                                          <td>{{$start}}</td>
                                          <td> {{$end}}</td>
                                          @if ($application->total == null)
                                                        <td>{{$total_days}} দিন</td>
                                                            @else
                                                            <td>{{$total}} দিন</td>
                                                        @endif


                                          @if ($application->total == null)
                                                        <td>0 দিন</td>
                                                            @else
                                                            <td>{{$total_days}} দিন</td>
                                                        @endif

                                          {{-- <td>{{$application->stay}}</td> --}}
                                          <td>
                                              @if ($application->approve == Null)
                                              <h3 style="color: rgb(188, 228, 94)">অপেক্ষমাণ..</h3>


                                              @elseif ($application->approve == 1)
                                              <h3 style="color: rgb(28, 172, 40)">অনুমোদিত</h3>
                                              @elseif ($application->approve == 0)
                                              <h3 style="color: red">প্রত্যাখ্যাত </h3>
                                              @endif
                                          </td>

                                          <td>


                                            <a href="{{route('application.details',$application->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                            @if ($application->approve == Null)
                                            <a href="/application/delete/{{$application->id}}"><i  class="fas fa-trash btn btn-danger"></i></a>
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
                       {{-- <div class="row">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">আবেদনের কারণ</th>
                                <th scope="col">ছুটির মেয়াদকাল:</th>
                                <th scope="col">অবস্থান</th>
                                <th scope="col">মন্তব্য</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  @php
                                      $serial=1;
                                  @endphp
                                @foreach ($applications as $application)


                                <th scope="row">{{$serial++}}</th>
                                <td>{{$application->reason}}</td>
                                <td>{{$application->start}} To {{$application->end}}</td>
                                <td>{{$application->stay}}</td>
                                <td>
                                    @if ($application->approve == Null)
                                    <h3 style="color: rgb(188, 228, 94)">pending..</h3>
                                    @elseif ($application->approve == 1)
                                    <h3 style="color: rgb(28, 172, 40)">Approved</h3>
                                    @elseif ($application->approve == 0)
                                    <h3 style="color: red">Reject</h3>
                                    @endif
                                </td>

                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                       </div> --}}
                       <script src="{{asset('assets\js\pages\datatables.init.js')}}"></script>

 @endsection
