<?php echo $this->fetch('main_header.html'); ?>
<?php echo $this->fetch('main_search.html'); ?>

 
    <div class="main-container">
        <div class="container">
            <div class="row">
                
					 <?php echo $this->fetch('menu_member.index.html'); ?>
                <div class="col-sm-9 page-content">
                   

                    <div class="inner-box">
                        <div class="welcome-msg">
                            <h3 class="page-sub-header2 clearfix no-padding">สวัสดี，<?php echo htmlspecialchars($this->_var['visitor']['user_name']); ?></h3>
                            <span class="page-sub-header-sub small">เวลาเข้าสู่ระบบล่าสุด: <?php echo local_date("Y-m-d H:i:s",$this->_var['user']['last_login']); ?> <br>เข้าสู่ระบบครั้งล่าสุด IP: <?php echo $this->_var['user']['last_ip']; ?></span>
                        </div>
                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB1" data-toggle="collapse"> My
                                        details </a></h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseB1">
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="post">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">ชื่อ - นามสกุล</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="realname" value="<?php echo $this->_var['member_row']['real_name']; ?>" class="form-control" placeholder="ชื่อ - นามสกุล">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email</label>

                                                <div class="col-sm-9">
                                                    <input type="email" name="email" class="form-control"
                                                           placeholder="jhon.deo@example.com" value="<?php echo $this->_var['member_row']['email']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">ที่อยู่</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="address" class="form-control" placeholder=".." value="<?php echo $this->_var['member_row']['address']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Phone" class="col-sm-3 control-label">เบอร์ติดต่อ</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="Phone" name="phone" value="<?php echo $this->_var['member_row']['phone_tel']; ?>"
                                                           placeholder="880 124 9820">
                                                </div>
                                            </div>
                                             

                                            <div class="form-group hide"> 
                                                <label class="col-sm-3 control-label">Facebook account map</label>

                                                <div class="col-sm-9">
                                                    <div class="form-control"><a class="link"
                                                                                 href="fb.com">Jhone.doe</a> <a
                                                            class=""> <i class="fa fa-minus-circle"></i></a></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9"></div>
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
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB2" data-toggle="collapse"> Settings </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseB2">
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="post" action="index.php?app=member&act=repassword">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox">
                                                            Comments are enabled on my ads </label>
                                                    </div>
                                                </div>
                                            </div>
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
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB3" data-toggle="collapse">
                                        Preferences </a></h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseB3">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                        I want to receive newsletter. </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                        I want to receive advice on buying and selling. </label>
                                                </div>
                                            </div>
                                        </div>
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