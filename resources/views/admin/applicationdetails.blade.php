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

             if ($application->total != null) {
                $total = $numto->bnNum($application->total);
             }else{

             }

            //   $total = $numto->bnNum($application->total);
              $total_days = $numto->bnNum($application->total_days);
             $start=   $dateConverter->getConvertedDateTime($application->start,  'BnEn', '');
             $end=   $dateConverter->getConvertedDateTime($application->end,  'BnEn', '');
             $created_at=   $dateConverter->getConvertedDateTime($application->created_at,  'BnEn', '');
         @endphp
                        <!-- start page title -->
                        <div class="row">

                        </div>
                        <!-- end page title -->

                        <div class="row">



                            <div class="col-xl-6">
                                <div class="card">
                                <div class="card-body">
                                        <h4 class="card-title mb-4">বিস্তারিত তথ্য</h4>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">আবেদনের তারিখ:</th>
                                                        <td>{{$created_at}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">আবেদন অনুমোদনকারীঃ </th>
                                                        <td>{{$adminInfo->username}} ({{$adminInfo->department}}, {{$adminInfo->branch}}) </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">ছুটির মেয়াদকাল শুরু:</th>
                                                        <td>{{$start}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">ছুটির মেয়াদকাল শেষ:</th>
                                                        <td>{{$end}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">আবেদনকৃত ছুটি:</th>
                                                        @if ($application->total == null)
                                                        <td>{{$total_days}} দিন</td>
                                                            @else
                                                            <td>{{$total}} দিন</td>
                                                        @endif
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                      </div>
                            <div class="col-xl-6">
                                <div class="card">
                                <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">অনুমোদিত ছুটি:</th>
                                                        @if ($application->total == null)
                                                        <td>0 দিন</td>
                                                            @else
                                                            <td>{{$total_days}} দিন</td>
                                                        @endif

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">অবস্থান:</th>
                                                        <td>{{$application->stay}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">কারন:</th>
                                                        <td>{{$application->reason}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">মন্তব্য:</th>
                                                        <td>{{$application->comment}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">বর্তমান অবস্থা:</th>
                                                        <td>
                                                            @if ($application->approve == Null)
                                                            <h3 style="color: rgb(188, 228, 94)">অপেক্ষমাণ..</h3>


                                                            @elseif ($application->approve == 1)
                                                            <h3 style="color: rgb(28, 172, 40)">অনুমোদিত</h3>
                                                            @elseif ($application->approve == 0)
                                                            <h3 style="color: red">প্রত্যাখ্যান</h3>
                                                            @endif
                                                        </td>
                                                    </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                      </div>
                        <!-- end row -->

                    @endsection

