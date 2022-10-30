@extends('admin.admin_master')
@section('main_contant')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
@php
  use Rakibhstu\Banglanumber\NumberToBangla;

    $numto = new NumberToBangla();
    $text = $numto->bnNum($endDAte);
    $obo=20 -$endDAte;
    $ob=  $numto->bnNum($obo);
    $applications=$numto->bnNum($applications);
    $join=$numto->bnNum($join);
@endphp
<div class="row">

    <div class="col-xl-12">
    <div class="row">
            <div class="col-sm-12">
                <div class="card" style="background-color:#683091; border-radius: 20px">
                    <div class="card-body" style="text-align: center">
                        <div  style="text-align: center">


                            <h3 style="text-align: center; color:#ffff !important" class="text-primary" >স্বাগতম {{$user->username}} !</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <div class="row">

        @if($user->signature)
            <div class="col-md-12">
                Signature
                <img src="{{url('/public')}}/signature/{{ $user->signature }}" height="100">
            </div>
        @else

        <div class="col-md-12">
            <div class="panel panel-primary" align="center">
                <div class="panel-heading"><h2>Signature Upload</h2></div>
                <div class="panel-body">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        <img src="{{url('/public')}}/signature/{{ Session::get('image') }}">
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
            <br>
            <br>
        </div>
        @endif
    <div class="col-sm-3 "></div>
            <div class="col-sm-6">
                <div class="card" style="background-color:#683091; border-radius: 20px">
                    <div class="card-body" style="text-align: center">
                        <div  style="text-align: center">


                            <h3 style="text-align: center; color:#ffff !important" class="text-primary" >দাপ্তরিক</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            @if ($req=session()->get('role')==1 || $req=session()->get('role')==2 )
            <div class="col-sm-4">
                <a href="/emp/leave/list">
                    <div class="card" style="background-color:#8bc643; border-radius: 20px">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                        <i style="color: saddlebrown" class="bx bx-user"></i>
                                    </span>
                                </div>


                                <h2 style="color: #ffff !important; padding-right:5px;font-size:51px;">{{ $applications }}  </h2>  <h4 style="color: #ffff !important;" class="font-size-54 mt-4">জন</h4>
                        </div>
                        <div class="text-muted">
                            <h4 style="color: #ffff !important;padding-left:49px;font-size:27px;">ছুটিতে</i></h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4">
                <a >
                    <div class="card" style="background-color:#8bc643; border-radius: 20px">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                        <i class="bx bx-user"></i>
                                    </span>
                                </div>

                                <h2 style="color: #ffff !important; padding-right:5px;font-size:51px;">{{ $join }}  </h2>  <h4 style="color: #ffff !important;" class="font-size-54 mt-4">জন</h4>
                        </div>
                        <div class="text-muted">
                            <h4 style="color: #ffff !important;padding-left:49px;font-size:27px;">কর্মরত</i></h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif
</div>
<div class="row">
    <div class="col-sm-4">
    </div>
    @if ( $req=session()->get('role')==2 )
    <div class="col-sm-4" >
        <a href="{{ url('/pending/application') }}">
            <div class="card" style="background-color: #683091; border-radius: 20px">
                <div class="card-body" style="text-align: center; font-size:x-large;color:#ffff;font:bolder">
               জমাকৃত  আবেদন

                </div>
            </div>
        </a>
    </div>
    @endif
    @if ( $req=session()->get('role')==1 )
    <div class="col-sm-4" >
        <a href="{{ url('/admin/pending/application') }}">
            <div class="card" style="background-color: #683091; border-radius: 20px">
                <div class="card-body" style="text-align: center; font-size:x-large;color:#ffff;font:bolder">
               জমাকৃত  আবেদন

                </div>
            </div>
        </a>
    </div>
    @endif

</div>
@if ( $req=session()->get('role')==2 )
<div class="row">
    <div class="col-sm-3 "></div>
            <div class="col-sm-6">
                <div class="card" style="background-color:#683091; border-radius: 20px">
                    <div class="card-body" style="text-align: center">
                        <div  style="text-align: center">


                            <h3 style="text-align: center; color:#ffff !important" class="text-primary" >ব্যক্তিগত</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endif
<div class="row">
<div class="col-sm-2"></div>
            <!-- @if ($req=session()->get('role')==2 )
            <div class="col-sm-4">
                <a href="/leave/list">
                    <div class="card" style="background-color:#8bc643;  border-radius: 20px">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                        <i style="color: saddlebrown" class="bx bx-user"></i>
                                    </span>
                                </div>


                                <h4 class="font-size-54 mb-0">সর্বমোট ছুটি নিয়েছে</h4>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$applications}}   জন</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a >
                    <div class="card" style="background-color:#8bc643;  border-radius: 20px">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                        <i class="bx bx-user"></i>
                                    </span>
                                </div>

                                <h4 class="font-size-54 mb-0">সর্বমোট অফিস করছে</h4>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$join}}  জন</h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif -->


            @if ($req=session()->get('role')==2  )

            <div class="col-sm-4" >
                <div class="card" style="background-color:#8bc643;  border-radius: 20px">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                    <i style="color: saddlebrown" class="bx bx-user"></i>
                                </span>
                            </div>

                     <h2 style="color: #ffff !important; padding-right:5px;font-size:51px">{{$text}} </h2>  <h4 style="color: #ffff !important;" class="font-size-54 mt-4"> দিন</h4>
                        </div>
                        <div class="text-muted">
                            <h4 style="color: #ffff !important;padding-left: 49px;font-size: 27px;"> ভোগকৃত ছুটি </i></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="background-color:#8bc643;   border-radius: 20px">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                    <i style="color: saddlebrown" class="bx bx-user"></i>
                                </span>
                            </div>

                            <h2 style="color: #ffff !important; padding-right:5px;font-size:51px;">{{ $ob }}  </h2>  <h4 style="color: #ffff !important;" class="font-size-54 mt-4">দিন </h4>
                        </div>
                        <div class="text-muted">
                        <h4 style="color: #ffff !important;padding-left: 49px;font-size: 27px;"> অবশিষ্ট ছুটি </i></h4>
                        </div>
                    </div>
                </div>
            </div>
            @endif


        </div>
        <!-- end row -->
    </div>
</div>

<!-- end row -->

<div class="row">
    <div class="col-sm-4">

    </div>
    @php
         $now=\Carbon\Carbon::now();
       $now=$now->toDateString();
      $id=session('id');
  $date= \App\Models\Application::where('employee_id',$id)->where('start','<=', $now)->where('end','>=', $now)->where('approve',1)->first();


    @endphp


    @if ( $req=session()->get('role')==2 )
@if ($date == Null)
 @if ($endDAte < 20)
<div class="col-sm-4" >
    <a href="{{ url('/admin/send/application') }}">
        <div class="card" style="background-color: #683091; border-radius: 20px">
            <div class="card-body" style="text-align: center; font-size:x-large;color:#ffff;font:bolder">
             আবেদন

            </div>
        </div>
    </a>
</div>
@else



 @endif
    @endif
    @endif


</div>
@endsection
