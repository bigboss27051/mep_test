<?php echo $this->fetch('main_header.html'); ?>
<?php echo $this->fetch('main_search.html'); ?>

 
    <div class="main-container">
        <div class="container">
            <div class="row">
                
					 <?php echo $this->fetch('menu_member.index.html'); ?>
                <div class="col-sm-9 page-content">
                   

                    <div class="inner-box">
                        <div class="welcome-msg">
                            <h2 class="title-2"><i class="icon-money"></i>รหัสผ่านของฉัน</h2>
                        </div>
                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB1" data-toggle="collapse"> My
                                        Password</a></h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseB1">
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="post" action="index.php?app=member&act=repassword">
                                             
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">New Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="pass" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Confirm Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="cpass"  class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-default">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                             
                        </div>
                        

                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
    


<?php echo $this->fetch('main_footer.html'); ?>