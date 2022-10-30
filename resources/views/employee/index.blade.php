@extends('../admin.admin_master')
@section('main_contant')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
{{-- <div class="row">
    
    <div class="col-xl-3">
        <div class="card bg-soft-primary">
            <div>
                <div class="row">
                    <div class="col-md-3"></div>
                   
                    <div class="col-md-6">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">স্বাগতম {{$user->username}} !</h5>
                            <p> ড্যাশবোর্ড</p>
                
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-5 align-self-end">
                        <img src="assets\images\profile-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3"></div>
</div> --}}
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

        </div>
        <!-- end row -->
    </div>
<div class="row">
   
    <div class="col-xl-12">
        <div class="row">
        <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <div class="card" style="background-color:#8bc643;  border-radius: 20px">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                    <i style="color: saddlebrown" class="bx bx-user"></i>
                                </span>
                            </div>
@php
  use Rakibhstu\Banglanumber\NumberToBangla;

    $numto = new NumberToBangla();
    $text = $numto->bnNum($endDAte); 
    $obo=20 -$endDAte;
    $ob=  $numto->bnNum($obo); 
@endphp
                            <h2 style="color: #ffff !important; padding-right:5px;font-size:51px;">{{ $text }}  </h2>  <h4 style="color: #ffff !important;" class="font-size-54 mt-4">দিন</h4>
                        </div>
                        <div class="text-muted">
                            <h4 style="color: #ffff !important;padding-left:49px;font-size:27px"> ভোগকৃত ছুটি</i></h4>
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

                            <h2 style="color: #ffff !important; padding-right:5px;font-size:51px;">{{  $ob }}  </h2>    <h4 style="color: #ffff !important;" class="font-size-54 mt-4">দিন </h4>
                        </div>
                        <div class="text-muted">
                        <h4 style="color: #ffff !important;padding-left:49px;font-size:27px"> অবশিষ্ট ছুটি</i></h4>
                        </div>
                    </div>
                </div>
            </div>
          
            <!-- <div class="col-sm-4">
                <div class="card" style="background-color:#8bc643;  border-radius: 20px">
                   <a href="{{ url('/application/list',session()->get('id')) }}">
                    <div class="card-body" >
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs mr-3">
                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                    <i class="bx bx-user"></i>
                                </span>
                            </div>

                            <h4 style="color: #ffff !important;" class="font-size-54 mb-2"> আবেদনের হিসাব</h4>
                        </div>
                        <div class="text-muted mt-4">
                            <h4><i class="mdi mdi-chevron-up ml-1 text-success"></i></h4>
                        </div>
                    </div>
                   </a>
                </div>
            </div> -->
            
        </div>

        </div>
        <!-- end row -->
    </div>
</div>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-1">
        
    </div>
 
    <div class="col-sm-4" >
        <a href="{{ url('/application/list',session()->get('id')) }}">
            <div class="card" style="background-color: #683091; border-radius: 20px">
                <div class="card-body" style="text-align: center; font-size:x-large;color:#ffff;font:bolder">
                আবেদনের হিসাব

                </div>
            </div>
        </a>
    </div> 
   
    


    <div class="col-sm-3"></div>

</div>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-1">
        
    </div>
    @php
         $now=\Carbon\Carbon::now();
       $now=$now->toDateString(); 
      $id=session('id');
  $date= \App\Models\Application::where('employee_id',$id)->where('start','<=', $now)->where('end','>=', $now)->where('approve',1)->first();


    @endphp
   
   @if ($date == Null)
   @if ($endDAte < 20)
   
    <div class="col-sm-4" >
        <a href="{{ url('/send/application') }}">
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
    


    <div class="col-sm-3"></div>

</div>

<!-- end row -->
@endsection
