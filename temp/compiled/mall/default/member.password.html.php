<?php echo $this->fetch('member.header.html'); ?>
<style type="text/css">
.bgwhite {background: #FFFFFF;}
</style>
<script type="text/javascript">
$(function(){
    $('#password_form').validate({
        errorPlacement: function(error, element){
            $(element).next('.field_notice').hide();
            $(element).after(error);
        },
        success       : function(label){
            label.addClass('validate_right').text('OK!');
        },
        rules : {
            orig_password : {
                required : true
            },
            new_password : {
                required   : true,
                minlength  : 6,
                maxlength  : 20
            },
            confirm_password : {
                required   : true,
                equalTo    : '#new_password'
            }
        },
        messages : {
            orig_password : {
                required : 'รหัสผ่านเดิมจะต้องไม่ว่างเปล่า'
            },
            new_password  : {
                required   : 'รหัสผ่านจะต้องไม่ว่างเปล่า',
                minlength  : 'รหัสผ่านความยาวควรอยู่ระหว่าง 6-20 ตัวอักษร'
            },
            confirm_password : {
                required   : 'รหัสผ่านจะต้องไม่ว่างเปล่า',
                equalTo    : 'ป้อนรหัสผ่านไม่ตรงกัน'
            }
        }
    });
});
</script>
<style>
.borline td {padding:10px 0px;}
.ware_list th {text-align:left;}
</style>
<div class="content">
    <?php echo $this->fetch('member.menu.html'); ?>
    <div id="right">
        <?php echo $this->fetch('member.submenu.html'); ?>
        <div class="eject_con bgwhite">
            <div class="add">
                <form method="post" id="password_form">
                        <ul>
                            <li><h3>รหัสผ่านเดิม:</h3>
                                <p><input type="password" class="text width_normal" name="orig_password" /></p>
                            </li>
                            <li>
                                <h3>รกัสผ่านใหม่:</h3>
                                <p><input type="password" class="text width_normal" name="new_password" id="new_password"/></p>
                            </li>
                            <li>
                                <h3>ยืนยันรหัสผ่าน:</h3>
                                <p><input type="password" class="text width_normal" name="confirm_password" /></p>
                            </li>
                        </ul>
                    <div class="submit">
                        <input class="btn" type="submit" value="ส่ง" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php echo $this->fetch('footer.html'); ?>
