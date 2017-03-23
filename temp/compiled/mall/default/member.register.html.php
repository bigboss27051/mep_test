 
 <?php echo $this->fetch('main_header.html'); ?>

<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-8 page-content">
                    <div class="inner-box category-content">
                        <h2 class="title-2"><i class="icon-user-add"></i> สร้างบัญชีใช้งานของท่าน  </h2>

                        <div class="row">
                            <div class="col-sm-12">
                                 <form class="form-horizontal" id="register_form" method="post" action="">
                                    <fieldset>
                                         
 

                                        
										<div class="form-group required">
                                            <label for="inputEmail3" class="col-md-4 control-label">อีเมลล์  
                                                <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input id="user_name" name="user_name" type="email" class="form-control" id="inputEmail3"
                                                       placeholder="Email">
                                            </div>
                                        </div>
                                       
										<div class="form-group required">
                                            <label for="inputPassword3" class="col-md-4 control-label">รหัสผ่าน </label>

                                            <div class="col-md-6">
                                                <input type="password" name="password" class="form-control" id="inputPassword3"
                                                       placeholder="Password">

                                                <p class="help-block">** ตัวเลขหรือตัวหนังสืออย่างต่ำ 8 ตัวอักษร
                                                    </p>
                                            </div>
                                        </div>
										<div class="form-group required">
                                            <label for="inputPassword3" class="col-md-4 control-label">ยืนยันรหัสผ่าน   </label>

                                            <div class="col-md-6">
                                                <input type="password" name="password_confirm" class="form-control" id="inputPassword3"
                                                       placeholder="Password">

                                                <p class="help-block">** ตัวเลขหรือตัวหนังสืออย่างต่ำ 8 ตัวอักษร
                                                    </p>
                                            </div>
                                        </div>
										
                                        
                                        
										 <div class="form-group required">
                                            <label class="col-md-4 control-label">ชื่อ - นามสกุล <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input   name="realname" placeholder="** ชื่อ - นามสกุล"
                                                       class="form-control input-md" type="text">

                                                
                                            </div>
                                        </div>
										<div class="form-group required">
                                            <label class="col-md-4 control-label">ที่อยู่<sup>*</sup></label>

                                            <div class="col-md-6">
                                               <textarea name="address" class="form-control"  rows="3"></textarea>

                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group required">
                                            <label class="col-md-4 control-label">หมายเลขโทรศัพท์มือถือ  <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input name="phonetel" placeholder="** ตัวอย่าง : 028899818 หรือ 0900501200"
                                                       class="form-control input-md" type="text">

                                                
                                            </div>
                                        </div>

                                         

                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label"></label>

                                            <div class="col-md-8">
                                                <div class="termbox mb10">
                                                    <label class="checkbox-inline" for="checkboxes-1">
                                                        <input  name="agree" value="1"
                                                               type="checkbox">
                                                       <a href="terms-conditions.html">ยอมรับ   ข้อตกลงและยอมรับเงื่อนไข ในบริการของ maha-express.com แล้ว </a> </label>
                                                </div>
                                                <div style="clear:both"></div>
                                                <input  type="submit" class="btn btn-primary" value="Register"  > </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="col-md-4 reg-sidebar">
                    <div class="reg-sidebar-inner text-center">
                        <div class="promo-text-box"><i class=" icon-picture fa fa-4x icon-color-1"></i>

                            <h3><strong>Post a Free Classified</strong></h3>

                            <p> Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. </p>
                        </div>
                        <div class="promo-text-box"><i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>

                            <h3><strong>Create and Manage Items</strong></h3>

                            <p> Nam sit amet dui vel orci venenatis ullamcorper eget in lacus.
                                Praesent tristique elit pharetra magna efficitur laoreet.</p>
                        </div>
                        <div class="promo-text-box"><i class="  icon-heart-2 fa fa-4x icon-color-3"></i>

                            <h3><strong>Create your Favorite ads list.</strong></h3>

                            <p> PostNullam quis orci ut ipsum mollis malesuada varius eget metus.
                                Nulla aliquet dui sed quam iaculis, ut finibus massa tincidunt.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    



 

<?php echo $this->fetch('main_footer.html'); ?>