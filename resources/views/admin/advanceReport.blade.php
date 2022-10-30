@extends('admin.admin_master')
@section('main_contant')
    @php

        use Rakibhstu\Banglanumber\NumberToBangla;
        use Rajurayhan\Bndatetime\BnDateTimeConverter;
            $numto = new NumberToBangla();
            $dateConverter  =  new  BnDateTimeConverter();

    @endphp
        <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <label>নাম</label>
                            <select class="form-control" onchange="reloadTable()" id="empName">
                                <option value="">Select</option>
                                @foreach($emp as $employee)
                                    <option value="{{$employee->id}}">{{$employee->username}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Start Date</label>
                            <input type="date" class="form-control" id="start_dt" onchange="reloadTable()">
                        </div>
                        <div class="col-md-2">
                            <label>End Date</label>
                            <input type="date" class="form-control" id="end_dt" onchange="reloadTable()">
                        </div>
                        <div class="col-md-4">
                            <label>Status</label>
                            <select class="form-control" onchange="reloadTable()" id="pending">
                                <option value="4">Select</option>
                                <option value="0">প্রত্যাখ্যাত</option>
                                <option value="1">অনুমোদিত</option>
                                <option value="">অপেক্ষমাণ</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table id="appointmentTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>নাম</th>
                            <th>পদবী</th>
                            <th>মেয়াদকাল শুরু</th>
                            <th>মেয়াদকাল শেষ</th>
                            <th>আবেদনকৃত ছুটি</th>
                            <th>কারণ</th>
                            <th>ছুটিকালীন অবস্থান</th>
                            <th>আবেদনের তারিখ</th>
{{--                            <th>ভোগকৃত ছুটি</th>--}}
{{--                            <th>অবশিষ্ট ছুটি</th>--}}
                            <th>মন্তব্য</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
{{--                        <tr>--}}
{{--                            <th>Name</th>--}}
{{--                            <th>Mobile</th>--}}
{{--                            <th>Sex</th>--}}
{{--                            <th>Age</th>--}}
{{--                            <th>Time</th>--}}
{{--                            <th>Serial</th>--}}
{{--                            <th>Doctor</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
                        </tfoot>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    <script src="{{asset('public\assets\js\pages\datatables.init.js')}}"></script>

    <script>
        $(document).ready(function () {
            dataTable = $('#appointmentTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                type: "POST",
                "ajax": {
                    "url": "{!! route('get.report') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                        d.empName=$('#empName').val();
                        d.start_dt=$('#start_dt').val();
                        d.end_dt=$('#end_dt').val();
                        d.status=$('#pending').val();
                        // d.doctorId=$('#doctorId').val();
                        // d.statusId=$('#statusId').val();
                    },
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'department', name: 'department'},
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {data: 'total_days_bangla', name: 'total_days_bangla'},
                    {data: 'reason', name: 'reason'},
                    {data: 'stay', name: 'stay'},
                    {data: 'created_at', name: 'created_at'},
                    // {data: 'total', name: 'total'},
                    // {data: 'approve', name: 'approve'},
                    { "data": function(data){
                        // return data.approve;
                        if(data.approve==1){ return '<h3 style="color: rgb(28, 172, 40)">অনুমোদিত</h3>';
                            }
                        if(data.approve==0){
                            return '<h3 style="color: red">প্রত্যাখ্যাত</h3>';
                        }
                        else {
                            return '<h3 style="color: orange">অপেক্ষমাণ..</h3>';
                        }
                        // if(data.approve==0){}
                            // return ' <div class="dropdown">\n' +
                            //     '  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">\n' +
                            //     '  </button>\n' +
                            //     '  <div class="dropdown-menu">\n' +
                            //     '    <a class="dropdown-item" onclick="startInQueue(this)" data-panel-id="'+data.appointmentId+'"><i class="fas fa-sign-in-alt"></i> In</a>\n' +
                            //     '    <a class="dropdown-item" onclick="edit(this)" data-panel-id="'+data.appointmentId+'"><i class="fa fa-edit"></i>  Edit</a>\n' +
                            //     '    <a class="dropdown-item" onclick="print(this)" data-panel-id="'+data.appointmentId+'"><i class="fa fa-print"></i> Print</a>\n' +
                            //     '    <a class="dropdown-item" onclick="cancel(this)" data-panel-id="'+data.appointmentId+'"><i class="fas fa-window-close"></i> Cancel</a>\n' +
                            //     '  </div>\n' +
                            //     '</div> ';
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                    // { "data": function(data){
                    //         return ' <div class="dropdown">\n' +
                    //             '  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">\n' +
                    //             '  </button>\n' +
                    //             '  <div class="dropdown-menu">\n' +
                    //             '    <a class="dropdown-item" onclick="startInQueue(this)" data-panel-id="'+data.appointmentId+'"><i class="fas fa-sign-in-alt"></i> In</a>\n' +
                    //             '    <a class="dropdown-item" onclick="edit(this)" data-panel-id="'+data.appointmentId+'"><i class="fa fa-edit"></i>  Edit</a>\n' +
                    //             '    <a class="dropdown-item" onclick="print(this)" data-panel-id="'+data.appointmentId+'"><i class="fa fa-print"></i> Print</a>\n' +
                    //             '    <a class="dropdown-item" onclick="cancel(this)" data-panel-id="'+data.appointmentId+'"><i class="fas fa-window-close"></i> Cancel</a>\n' +
                    //             '  </div>\n' +
                    //             '</div> ';
                    //     },
                    //     "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            });
        });

        function reloadTable() {
            dataTable.ajax.reload();
        }
    </script>
@endsection
