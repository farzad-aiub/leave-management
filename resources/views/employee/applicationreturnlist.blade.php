@extends('admin.admin_master')
@section('main_contant')

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->


                        <!-- start page title -->
                       <div class="row">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">আবেদনের কারণ</th>
                                <th scope="col">মন্তব্য</th>
                                <th scope="col">অ্যাকশান</th>
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
                                <td>{{Str::limit($application->comment, 40)}}</td>
                                <td>
                                   <a href="/application/return/Details/{{($application->id)}}"><button class="btn btn-primary">বিস্তারিত দেখুন</button></a>
                                </td>


                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                       </div>

 @endsection
