<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8">
        <title>recover Password | Office Managment System</title>
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
                                        <!-- <div class="text-primary p-4">
                                            <h5 class="text-primary">Register</h5>
                                            <p>Get your Office Managment system account now.</p>
                                        </div> -->
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{asset('public\assets\images\profile-img.png')}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                <a>
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src=".\public\assets\images\logo.png" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
									<form class="form-horizontal" method="post" action="{{url('/send/code')}}">
										@csrf
										<div class="form-group">
											<select name="role" class="form-control">
												<option disabled selected="">Role</option>
												<option value="2">Admin</option>
												<option value="3">Employee</option>
											</select>      
                                        </div>
                                        <div class="form-group">
                                            <label for="useremail">Email</label>
                                            <input type="email" name="email" class="form-control" id="useremail" placeholder="Enter email">        
                                        </div>
                
                                        <!-- <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                                        </div>
                
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>
                                            <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">        
                                        </div>
                    
                                        <div class="mt-4">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                                        </div> -->

                                        <div class="mt-4 text-center">
                                           <button type="submit" class="btn btn-primary"> Send Code</button>
            
                                        </div>
                
                                        <h5 style="color: red">{{session('email')}}</h5>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <p>Already have an account ? <a href="/login" class="font-weight-medium text-primary"> Login</a> </p>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="assets\libs\jquery\jquery.min.js"></script>
        <script src="assets\libs\bootstrap\js\bootstrap.bundle.min.js"></script>
        <script src="assets\libs\metismenu\metisMenu.min.js"></script>
        <script src="assets\libs\simplebar\simplebar.min.js"></script>
        <script src="assets\libs\node-waves\waves.min.js"></script>
        
        <!-- App js -->
        <script src="assets\js\app.js"></script>
    </body>
</html>
