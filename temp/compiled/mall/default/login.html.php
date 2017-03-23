<?php echo $this->fetch('main_header.html'); ?>
 
<div class="main-container">
        <div class="container">
            <div class="row">
				
                <div class="col-sm-5 login-box">
                    <div class="panel panel-default">
                        <div class="panel-intro text-center">
                            <h2 class="logo-title">
                                
                                <span class="logo-icon"><i
                                        class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> BOOT<span>CLASSIFIED </span>
                            </h2>
                        </div>
                        <div class="panel-body">
                             <form method="post" id="login_form"  role="form">
                                <div class="form-group">
                                    <label for="sender-email" class="control-label">Username:</label>

                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input name="user_name" type="text" placeholder="Username"
                                               class="form-control email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user-pass" class="control-label">Password:</label>

                                    <div class="input-icon"><i class="icon-lock fa"></i>
                                        <input type="password" name="password" class="form-control" placeholder="Password"
                                               id="user-pass">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary  btn-block"  value="สมัครสมาชิก" ></a>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">

                            <div class="checkbox pull-left">
                                <label> <input type="checkbox" value="1" name="remember" id="remember"> Keep me logged
                                    in</label>
                            </div>


                            <p class="text-center pull-right"><a href="forgot-password.html"> Lost your password? </a>
                            </p>

                            <div style=" clear:both"></div>
                        </div>
                    </div>
                    <div class="login-box-btm text-center">
                        <p> Don't have an account? <br>
                            <a href="signup.html"><strong>Sign Up !</strong> </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



<?php echo $this->fetch('main_footer.html'); ?>