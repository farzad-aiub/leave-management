@extends('../admin.admin_master')
@section('main_contant')

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">আবেদনপত্র ফেরৎ</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                                            <li class="breadcrumb-item active">Return Application</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="panel-body">
                            <div class="portlet-body form">
                            <form   class="form-horizontal" method="post" id="MyForm" role="form" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                         @csrf
                                <input type="hidden" name="employee_id" value="{{session()->get('id') }}">
                            <div class="form-body">

                               <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <label for="" class="from-control"><h3>মন্তব্য করুন</h3></label>
                                    {{-- <input type="textarea" class="form-control" cols="50" rows="6"> --}}
                                    <textarea  name="comment"  id="" cols="70" rows="6"></textarea>
                                </div>
                               
                               </div>

                                </div>

                                   <div class="form-group " style="text-align: center">
                                        <div >
                                            <button type="reset" class="btn btn-danger">রিসেট </button>
                                            <button type="submit"  class="btn btn-success sav_btn">আবেদন ফেরৎ  দিন  </button>
                                            {{-- <button type="submit" onclick="return confirm('It is disabled only at demo mode!')" class="btn btn-success sav_btn">Submit </button> --}}
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                <!-- End Page-content -->
                @if(isset($success) && $success == true)
                <script>
                 Swal.fire(
                     'success','New Application Create sucessfully done','success'
                 );

           </script>
                @endif
 @endsection
