@extends('admin.admin_master')
@section('main_contant')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
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
                                  <table id="example" class="display" style="width:100%">
                                      <!-- <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100"> -->

                                          <thead>
                                              <tr>
                                                {{-- <th>#</th> --}}
                                                <th>নাম ও পদবি</th>
                                                <th>শাখা</th>
                                                <th>ইমেইল</th>
                                                <th>মোবাইল</th>
                                                <th>পদক্ষেপ</th>
                                                <th style="display:none">পদক্ষেপ</th>

                                              </tr>
                                          </thead>
                                      
                                      
                                          <tbody>
                                             
                                             <tr>
                                                @php
                                                $serial=1;
                                            @endphp
                                          @foreach ($oparetors   as $employee)
          
          
                                          {{-- <th>{{$serial++}}</th> --}}
                                          <td><p  name="btn" data-first_name="{{$employee->first_name}}" data-id="{{$employee->id}}" data-end="{{$employee->department}}" data-start="{{$employee->branch}}" data-total_days="{{$employee->email}}"
                                           value="{{$employee->id}}" class="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-default">{{$employee->first_name}}</p>
                                          {{$employee->department}}</td>
                                          <td>{{$employee->branch}}</td>
                                          <td>{{$employee->email}}</td>
                                   @php
                                   
                                        $number = $numto->bnNum($employee->phone); 
                                       
                                    @endphp
                                          <td>{{$number}}</td>
                                          <td>
                                            
                                            <a href="/oparetor/profile/details/{{$employee->id}}" data-toggle="tooltip" data-placement="top" title="details"><i class="fas fa-eye"></i></a>
                                            <a href="/oparetor/edit/{{$employee->id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bx bx-edit"></i></a>
                                         <!--    <a href="/oparetor/profile/{{$employee->id}}" data-toggle="tooltip" data-placement="top" title="Profile"><i class="bx bx-user-circle"></i></a> -->
                                               <a href="/oparetor/delete/{{$employee->id}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bx bx-trash"></i></a>
                                         
                                          </td>
                                          <td style="display:none">{{$employee->status}}</td>
                                              </tr>
                                             
                                            
                                            
                                               
                                             @endforeach
                                          </tbody>
                                      </table>
                                      
                                  </div> <!-- end card body-->
                              </div> <!-- end card -->
                          </div><!-- end col-->
                      </div>

                      <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <table class="table">
                    <tr>
                        <th>নাম</th>
                        <td id="first_nameShow"></td>
                    </tr>
                    <tr>
                        <th>ইমেইল</th>
                        <td id="emailShow"></td>
                    </tr>
                    <tr>
                        <th>পদবী  </th>
                        <td id="departmentShow"></td>
                    </tr>
                    <tr>
                        <th>শাখা  </th>
                        <td id="branchShow"></td>
                    </tr>

                    
                </table>
                <table >
                                          <thead id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                              <tr>
                                          
                                                <th style="padding:0px 10px;">তারিখ হতে</th>
                                                <th style="padding:0px 10px;">তারিখ পর্যন্ত</th>
                                                <th style="padding:0px 10px;">অবস্থান</th>
                                                <th style="padding:0px 10px;">কারণ </th>
                                             
                                               

                                              </tr>
                                          </thead>
                                      
                                      
                                          <tbody id="wishlistToShow">
                                             <tr >
                                            
                                           </tr>
                                            
                                            
                                          
                                             
                                          
                                          </tbody>
                                      </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(()=>{
        $(document).on('click','.submitBtn',function(e){
        e.preventDefault();
        let email   = this.dataset.total_days;
        let department   = this.dataset.end;
        let branch = this.dataset.start;
        let first_name = this.dataset.first_name;
        let id = this.dataset.id;


      console.log(id);
      axios.get(`/leave-list/${id}`)
                .then(response=>{
                    // console.log(response.data);

                       var rows = ""
                       data=response.data;
                       console.log(data);
                    let  row = data.map((el)=>{
                        console.log(el);
                       return ` <tr>
                                          
                                          <td style="padding:0px 10px;">${el.start}</td>
                                          <td style="padding:0px 10px;">${el.end}</td>
                                          <td style="padding:0px 10px;">${el.stay}</td>
                                          <td style="padding:0px 10px;">${el.reason} </td>
                                       
                                         

                                        </tr>`
                       });
                      
                       $('#wishlistToShow').html(row);



                    //   $('#wishlistToShow').html('row');
                    //   $.each(response.data, function(key,value){

                    //      rows =

                    //     ` <tr>
                                          
                    //                             <th style="padding:0px 10px;">mesba</th>
                    //                             <th style="padding:0px 10px;">${value.leave.end}</th>
                    //                             <th style="padding:0px 10px;">${value.leave.stay}</th>
                    //                             <th style="padding:0px 10px;">${value.leave.reason} </th>
                                             
                                               

                    //                           </tr>`;
                    //     $('#wishlistToShow').append(rows);

                    //     });
                })
                .catch(error=>{
console.log(error);
                })
        

        $('#emailShow').text(email);
        $('#departmentShow').text(department );
        $('#branchShow').text(branch );
        $('#first_nameShow').text(first_name );
    })
    });
   

    // function addDriverToSelectBox(data){
    //     let selectBox = document.querySelector('#driver');
    //              console.log("mesba");
    //     data.forEach(item=>{
    //         const tr =document.createElement('tr');

    //         tr.textContent=item.start;

        
    //         tr.value=item.id;
    //         selectBox.appendChild(tr);

       
    //     })
    // }

   

</script>

<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 5, "asc" ]]
    } );
} );
</script>
            

 @endsection