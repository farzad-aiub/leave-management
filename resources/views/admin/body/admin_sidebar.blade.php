<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar="" style="background: #683091;" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    @if ($req=session()->get('role')==1 )
                    <a href="{{route('admin.index')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>ড্যাশবোর্ড</span>
                    </a>
                    @endif
                    @if ( $req=session()->get('role')==2)
                    <a href="{{route('oparetor.index')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>ড্যাশবোর্ড</span>
                    </a>
                    @endif
                    @if ($req=session()->get('role')==3)
                    <a href="{{route('employee.index')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>ড্যাশবোর্ড</span>
                    </a>
                    @endif
                </li>
                @if ($req=session()->get('role')==1  )

                  <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>অ্যাডমিন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/create/oparetor') }}">অ্যাডমিন যোগ করুন</a></li>
                        <li><a href="{{ url('/Admin/oparetorlist') }}">অ্যাডমিন তালিকা</a></li>
                    </ul>
                </li>

                  @endif
                @if ( $req=session()->get('role')==2)

                  <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>অ্যাডমিন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ url('/Admin/oparetorlist') }}">অ্যাডমিন তালিকা</a></li>
                    </ul>
                </li>

                  @endif

                  @if ($req=session()->get('role')==3)

                  <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>আবেদন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ url('/send/application') }}">আবেদন করুন</a></li> --}}
                        <li><a href="{{ url('/application/list',session()->get('id')) }}"> আবেদন তালিকা</a></li>
                        {{-- <li><a href="{{ url('/application/returnlist',session()->get('id')) }}">ফেরৎ আবেদনের তালিকা</a></li> --}}
                    </ul>
                </li>

                  @endif
                  @if ( $req=session()->get('role')==1 || $req=session()->get('role')==2)

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>কর্মকর্তা/কর্মচারী</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/create/employee') }}">কর্মকর্তা/কর্মচারী যোগ করুন</a></li>
                        <li><a href="{{ url('/Admin/employeelist') }}">কর্মকর্তা/কর্মচারী তালিকা</a></li>
                    </ul>
                </li>
                @endif
				  <!-- @if ( $req=session()->get('role')==2)

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>কর্মকর্তা/কর্মচারী</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ url('/employee/list') }}">কর্মকর্তা/কর্মচারী তালিকা</a></li>
                    </ul>
                </li>
                @endif -->
                @if ( $req=session()->get('role')==2)

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>আবেদন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/admin/application/list',session()->get('id')) }}">আমার আবেদন তালিকা</a></li>




                        {{-- <li><a href="{{ url('/admin/send/application') }}">আবেদন করুন</a></li> --}}



                        <li><a href="{{ url('/pending/application') }}">অপেক্ষমান তালিকা</a></li>
                        <li><a href="{{ url('/pending/leave/application') }}"> আবেদনকৃত তালিকা</a></li>
                        <li><a href="{{ route('report') }}"> Advance Report</a></li>
                    </ul>
                </li>
                @endif
                @if ( $req=session()->get('role')==1)

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>আবেদন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ url('/pending/leave/application') }}"> আবেদনকৃত তালিকা</a></li>
                        <li><a href="{{ route('report') }}"> Advance Report</a></li>
                    </ul>
                </li>
                @endif
                {{-- @if ($req=session()->get('role')==1 || $req=session()->get('role')==2)

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Application</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/create/student') }}">Pending Application</a></li>
                        <li><a href="{{ url('/Admin/studentlist') }}">Application List</a></li>
                    </ul>
                </li>
                @endif --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    </div>
    <!-- Left Sidebar End -->
