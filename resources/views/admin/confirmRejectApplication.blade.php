@extends('../admin.admin_master')
@section('main_contant')

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h2 class="mb-0 font-size-18">মন্তব্য </h2>

                                    

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="panel-body">
                            <div class="portlet-body form">
                            <form   class="form-horizontal" method="post"  action="{{url('/reject/' .$applications->id)}}"  enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                         @csrf
                                
                            <div class="form-body">

                              
                               <div class="row">
                               
                                <div class="col-md-6">
                                    <label for="" class="from-control"><h3> </h3></label>
                                    {{-- <input type="textarea" class="form-control" cols="50" rows="6"> --}}
                                    <textarea  name="comment"  id="" cols="70" rows="6"></textarea>
                                </div>
                               
                               </div>

                                </div>

                                   <div class="form-group ">
                                        <div >
                                            
                                            <button type="submit"  class="btn btn-success sav_btn"> দাখিল     </button>
                                            {{-- <button type="submit" onclick="return confirm('It is disabled only at demo mode!')" class="btn btn-success sav_btn">Submit </button> --}}
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

               
 @endsection
