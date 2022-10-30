@extends('admin.admin_master')
@section('main_contant')

      <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
                        <!-- start page title -->
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
                                                @if($user->is_active =='1')
                                                <p class="text-muted mb-0 text-truncate">সক্রিয়</p>
                                                @else
                                                <p class="text-muted mb-0 text-truncate">সাসপেন্ড</p>
                                                @endif
                                            </div>

                                            <div class="col-sm-8">
                                                <div class="pt-4">

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="font-size-15">পদবি:{{$user->admin->department}}</h5>
                                                            <p class="text-muted mb-0">ইমেইল:{{$user->email}}</p>
                                                        </div>
                                                    </div>
                                             <div class="mt-4">
                                                        <a href="/user/edit/{{$user->id}}" class="btn btn-primary waves-effect waves-light btn-sm">হালনাগাদ করুন <i class="mdi mdi-arrow-right ml-1"></i></a>
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
                                                        <td>{{$user->username}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">মুঠোফোন :</th>
                                                        <td>{{$user->phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">ইমেইল :</th>
                                                        <td>{{$user->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">শাখা :</th>
                                                        <td>{{$user->admin->branch}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        </div>
</div>
                        <!-- end row -->

                    @endsection

