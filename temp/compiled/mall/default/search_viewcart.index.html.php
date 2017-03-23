<?php echo $this->fetch('main_header.html'); ?>
 
 <?php echo $this->fetch('main_search2.html'); ?>

    <div class="main-container">
        <div class="container">
            <ol class="breadcrumb pull-left">
                <li><a href="#"><i class="icon-home fa"></i></a></li>
                <li><a href="category.html">สินค้า</a></li>
 
                <li class="active">สินค้าในตระกร้า</li>
            </ol>
            <div class="pull-right backtolist"> </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 page-content col-thin-right">
                     <div class="col-sm-12 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-heart-1"></i>สินค้าในตระกร้า </h2>

                        <div class="table-responsive">
                            <div class="table-action">
                                <label for="checkAll">
                                    <input id="checkAll" type="checkbox">
                                    Select: All | <a href="#" class="btn btn-xs btn-danger">Delete <i class="glyphicon glyphicon-remove "></i></a> </label>

                                <div class="table-search pull-right col-xs-7">
                                    
                                </div>
                            </div>
                            <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo footable-loaded footable" data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                <tr>
                                    <th data-type="numeric" data-sort-initial="true"></th>
                                    <th>รูป</th>
                                    <th data-sort-ignore="true">สินค้า</th>
									 <th>Color</th>
									<th>Size</th>
                                    <th data-type="numeric">ราคา (บาท)</th>
									 <th data-type="numeric">จำนวน</th>
                                    <th> Option</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php $_from = $this->_var['list_cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
                                <tr>
                                    <td style="width:2%" class="add-img-selector">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox">
                                            </label>
                                        </div>
                                    </td>
                                    <td style="width:14%" class="add-img-td">
										<a href="ads-details.html"><img class="thumbnail  img-responsive" src="<?php echo $this->_var['order']['goods_image']; ?>" alt="img"></a></td>
                                    <td  class="ads-details-td">
                                        <div>
                                            <p><strong> <a href="<?php echo $this->_var['order']['adlink']; ?>" target="_blank" title="Brend New Nexus 4"><?php echo $this->_var['order']['goods_name']; ?></a> </strong></p>

                                            <p> <?php echo $this->_var['order']['goods_name_thai']; ?></p>
                                        </div>
                                    </td>
									<td style="width:16%" class="price-td" align="center">
                                        <div><strong><img   src="<?php echo $this->_var['order']['color']; ?>" width="30"> </strong></div>
                                    </td>
									<td style="width:16%" class="price-td" align="center">
                                        <div><strong> <?php echo $this->_var['order']['size']; ?></strong></div>
                                    </td>
                                    <td style="width:16%" class="price-td">
                                        <div><strong> <?php echo price_format($this->_var['order']['price_thai']); ?>  </strong></div>
                                    </td>
									<td style="width:16%" class="price-td" align="center">
                                        <div><strong> <?php echo $this->_var['order']['quantity']; ?> </strong></div>
                                    </td>
                                    <td style="width:10%" class="action-td">
                                        <div>
                                            <p><a class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> Share
                                            </a></p>

                                            <p><a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Delete
                                            </a></p>
                                        </div>
                                    </td>
                                </tr>
								 <?php endforeach; else: ?>
								<tr class="no_data">
									<td colspan="7">ไม่มีข้อมูลที่บันทึกไว้</td>
								</tr>
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
 
                                </tbody>
                            </table>
							<a href="index.php" class="btn btn-success"  ><i lass=" icon-phone-1"></i>สั่งสินค้าเพิ่มเติม</a>
							<a href="index.php?app=order&act=checkout" class="btn btn-primary pull-right"  ><i lass=" icon-phone-1"></i>Checkout</a>
                        </div>
                        

                    </div>
                </div>

                </div>
                

                <div class="col-sm-3  page-sidebar-right">
                    <aside>
                        <div class="panel sidebar-panel panel-contact-seller">
                            <div class="panel-heading">ติอต่อเรา</div>
                            <div class="panel-content user-info">
                                <div class="panel-body text-center">
                                    <div class="seller-info">
                                        <h3 class="no-margin">maha-express</h3>

                                        <p>Location: <strong>New York</strong></p>

                                        <p> Joined: <strong>12 Mar 2009</strong></p>
                                    </div>
                                    <div class="user-ads-action"><a href="#contactAdvertiser" data-toggle="modal"
                                                                    class="btn   btn-default btn-block"><i
                                            class=" icon-mail-2"></i> Send a message </a> <a
                                            class="btn  btn-info btn-block"><i class=" icon-phone-1"></i> 01680 531 352
                                    </a></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel sidebar-panel">
                            <div class="panel-heading">หมายเหตุ</div>
                            <div class="panel-content">
                                <div class="panel-body text-left">
                                    <ul class="list-check">
                                        <li>ควรเลือกสีและขนาดให้ถูกต้อง ระบบจะทำการสั่งรายการสินค้าโดยอัตโนมัติ</li>
                                        <li> สีอาจมีความแตกต่างจากของจริง เนื่องจากบางร้านค้าใช้เทคนิคในการแต่งรูปภาพสินค้า</li>
                                        
                                    </ul>
                                    <p><a class="pull-right" href="#"> Know more <i
                                            class="fa fa-angle-double-right"></i> </a></p>
                                </div>
                            </div>
                        </div>
                        
                    </aside>
                </div>
                
            </div>
        </div>
    </div>
    
	
    
 
 
<?php echo $this->fetch('main_footer.html'); ?>