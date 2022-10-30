@extends('admin.admin_master')
@section('main_contant')

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            @php
            use Rakibhstu\Banglanumber\NumberToBangla;
            
                $numto = new NumberToBangla();
              
               
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
                                                <th>নাম</th>
                                                <th>ইমেইল</th>
                                                <th>মোবাইল</th>

                                              </tr>
                                          </thead>
                                      
                                      
                                          <tbody>
                                              <tr>
                                                @php
                                                $serial=1;
                                                //$serial = $numto->bnNum($serial); 
                                            @endphp
                                          @foreach ($applications as $application)
          
                                         @php   
                                          $phone = $numto->bnNum($application->phone); 
                                       
                                      
                                      @endphp
          
                                          <th scope="row">{{$serial++}}</th>
                                          <td>{{$application->username}}</td>
                                          <td>{{$application->email}}</td>
                                          <td>{{$phone}}</td>
                                              </tr>
                                             
                                            
                                            
                                               
                                             @endforeach
                                          </tbody>
                                      </table>
                                      
                                  </div> <!-- end card body-->
                              </div> <!-- end card -->
                          </div><!-- end col-->
                      </div>
                      <script src="{{asset('public\assets\js\pages\datatables.init.js')}}"></script>  

 @endsection

