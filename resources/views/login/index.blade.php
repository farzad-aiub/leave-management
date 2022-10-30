<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8">
        <title>নৈমিত্তিক ছুটি ব্যবস্থাপনা</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public\assets\images\logo.png')}}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('public\assets\css\bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('public\assets\css\icons.min.css')}}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('public\assets\css\app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> নৈমিত্তিক ছুটি ব্যবস্থাপনায় আপনাকে স্বাগতম!</h5>
                                        </div>
                                      
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src=".\public\assets\images\profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                            <h5 style="color: green">{{session('pass')}}</h5>
                                <div>
                                    <a>
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src=".\public\assets\images\log.png" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal" method="post" action="{{url('/login')}}">
                                       @csrf
                                        <div class="form-group">
                                            <label for="email">ইমেইল/মোবাইল নম্বর</label>
                                            <input type="text" name="email" class="form-control" id="email" placeholder="ইমেইল দিন">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="userpassword">পাসওয়ার্ড</label>
                                            <input type="password" name="password" class="form-control" id="userpassword" placeholder="পাসওয়ার্ড দিন">
                                        </div>
                
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">স্মরণ রাখুন</label>
                                            <a href="{{url('/recover/password')}}" class="font-weight-medium text-primary" style="padding-left: 147px;"> অ্যাকাউন্টটি পুনরূদ্ধার করুন </a> </p>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">প্রবেশ করুন</button>
                                        </div>
                                    </form>
                                </div>
                                <br>
                                
                                <h5 style="color: red">{{session('msg')}}</h5>
                                
                                <br>
                                @foreach ($errors as $error)
                                    {{$error}} <br>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                    
                                <p>© <script>document.write(new Date().getFullYear())</script> নৈমিত্তিক ছুটি ব্যবস্থাপনা | সহযোগীতায় <a href="http://www.tradewavetechnology.com/">Tradewave Technology</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="\assets\libs\jquery\jquery.min.js"></script>
        <script src="\assets\libs\bootstrap\js\bootstrap.bundle.min.js"></script>
        <script src="\assets\libs\metismenu\metisMenu.min.js"></script>
        <script src="\assets\libs\simplebar\simplebar.min.js"></script>
        <script src="\assets\libs\node-waves\waves.min.js"></script>
        
        <!-- App js -->
        <script src="\assets\js\app.js"></script>
        {{-- <!-- JAVASCRIPT -->
        <script src=".\public\assets\libs\jquery\jquery.min.js"></script>
        <script src=".\public\assets\libs\bootstrap\js\bootstrap.bundle.min.js"></script>
        <script src=".\public\assets\libs\metismenu\metisMenu.min.js"></script>
        <script src=".\public\assets\libs\simplebar\simplebar.min.js"></script>
        <script src=".\public\assets\libs\node-waves\waves.min.js"></script>
        
        <!-- App js -->
        <script src=".\public\assets\js\app.js"></script> --}}
    </body>
</html>
