@extends('admin.admin_master')
@section('main_contant')

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">হালনাগাদ প্রোফাইল</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">কর্মকর্তা কর্মচারী</a></li>
                                            <li class="breadcrumb-item active">হালনাগাদ কর্মকর্তা কর্মচারী</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{url('/employee/edit/'.$admin->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="username">ব্যবহারকারীর নাম</label>
                                                        <input id="first_name" name="username" type="text" value="{{$admin->username}}" class="form-control">
                                                        @if($errors->has('first_name'))
                                                       <div style="color:red"> {{$errors->first('first_name')}}</div>
                                                       @endif
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="phone">মোবাইল</label>
                                                        <input id="phone" name="phone" type="text" value="{{$admin->phone}}" class="form-control">
                                                        @if($errors->has('phone'))
                                                       <div style="color:red"> {{$errors->first('phone')}}</div>
                                                       @endif
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="email">ইমেইল</label>
                                                        <input id="email" name="email" type="text" value="{{$admin->email}}" class="form-control">
                                                        @if($errors->has('email'))
                                                       <div style="color:red"> {{$errors->first('email')}}</div>
                                                       @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">নতুন পাসওয়ার্ড</label>
                                                        <input id="password" name="password" type="password" value="{{$admin->password}}" class="form-control">
                                                        @if($errors->has('password'))
                                                       <div style="color:red"> {{$errors->first('password')}}</div>
                                                       @endif
                                                    </div>
                                                </div>
        
                                              
                                    </div>

                                </div> 
                                <!-- end card-->
                                                </div>
                                            </div>
        
                                            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">হালনাগাদ করুন</button>
                                        </form>
        
                                    </div>
                                </div>
                    
                </div>
                <!-- End Page-content -->
                @if(isset($success) && $success == true) 
                <script>
                 Swal.fire(
                     'success','Updated admin sucessfully done','success'
                 );
             
           </script>
                @endif 
 @endsection