 <?php echo $this->fetch('main_header.html'); ?>
<?php echo $this->fetch('main_search.html'); ?>

<div class="main-container">
        <div class="container">
            <div class="row">
                
					 <?php echo $this->fetch('menu_member.index.html'); ?>
                <div class="col-sm-9 page-content">
                   
                    <div class="inner-box">
                        <h2 class="title-2"><i class="icon-money"></i>รายละเอียดการสั่งซื้อ</h2>

						
                        <div style="clear:both"></div>

                        <div class="table-responsive">
							<div class="col-sm-8">
								<h4 class="text-uppercase">Address </h4>
								<address>
	                                        <p> <?php echo $this->_var['orders_address']['consignee']; ?> <br>
	                                            <?php echo $this->_var['orders_address']['address']; ?> <br>
	                                            <?php echo $this->_var['orders_address']['zipcode']; ?><br>
	                                            <br>
	                                            Phone Number: <?php echo $this->_var['orders_address']['phone_tel']; ?><br>
	
	                                            E-Mail: <?php echo $this->_var['orders']['email']; ?><br>
	                                            </p>
	                           </address>
							</div>
						 	<div class="col-md-4">
                                    <aside class="panel panel-body panel-details">
                                        <ul>
                                            <li>
                                                <p class=" no-margin "><strong>Bill NO.:</strong> #<?php echo $this->_var['orders']['order_sn']; ?></p>
                                            </li>
											 <li>
                                                <p class=" no-margin "><strong>Date:</strong> <?php echo local_date("Y-m-d",$this->_var['orders']['add_time']); ?></p>
                                            </li>
                                             
                                            <li>
                                                <p class="no-margin"><strong>Buyer:</strong> <?php echo $this->_var['orders']['buyer_name']; ?></p>
                                            </li>
                                            <li>
                                                <p class="no-margin"><strong>Payment:</strong><?php echo $this->_var['orders']['payment_name']; ?></p>
                                            </li>

                                            <li>
                                                <p class="no-margin"><strong>Shipping:</strong><?php echo $this->_var['orders_address']['shipping_name']; ?></p>
                                            </li>
                                           

                                        </ul>
                                    </aside>
                                     
                                </div>
								<form  method="post" >
								<input type="hidden" name="tid" value="<?php echo $this->_var['tid']; ?>">
                            <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo footable-loaded footable" data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                <tr>
                                    <th>เลือกจ่าย</th>
                                    <th>รูป</th>
                                    <th data-sort-ignore="true">สินค้า</th>
									 <th>Color</th>
									<th>Size</th>
                                    <th data-type="numeric">ราคา (บาท)</th>
									 <th data-type="numeric">จำนวน</th>
                                    <th>รวม</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php $_from = $this->_var['list_cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
                                <tr>
                                    <td><input type="checkbox"  name="items[]" value="<?php echo $this->_var['order']['rec_id']; ?>"></td>
                                    <td style="width:14%" class="add-img-td">
										<a href="ads-details.html"><img class="thumbnail  img-responsive" src="<?php echo $this->_var['order']['goods_image']; ?>" alt="img"></a></td>
                                    <td  class="ads-details-td">
                                        <div>
                                            <p><strong> <a href="<?php echo $this->_var['order']['adlink']; ?>" target="_blank" title="Brend New Nexus 4"><?php echo $this->_var['order']['goods_name']; ?></a> </strong></p>

                                            <p> <?php echo $this->_var['order']['goods_name_thai']; ?> </p>
                                        </div>
                                    </td>
									<td style="width:16%" class="price-td" align="center">
                                        <div><strong><img   src="<?php echo $this->_var['order']['color']; ?>" width="30"> </strong></div>
                                    </td>
									<td style="width:16%" class="price-td" align="center">
                                        <div><strong> <?php echo $this->_var['order']['size']; ?></strong></div>
                                    </td>
                                    <td style="width:16%" class="price-td">
                                        <div><strong> <?php echo $this->_var['order']['price_thai']; ?>  </strong></div>
                                    </td>
									<td style="width:16%" class="price-td" align="center">
                                        <div><strong> <?php echo $this->_var['order']['quantity']; ?> </strong></div>
                                    </td>	
									<td style="width:16%" class="price-td" align="center">
                                        <div><strong> <?php echo price_format($this->_var['order']['amount']); ?> </strong></div>
                                    </td>
                                    
                                </tr>
								 <?php endforeach; else: ?>
								<tr class="no_data">
									<td colspan="7">ไม่มีข้อมูลที่บันทึกไว้</td>
								</tr>
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
 								<tr>
									<td colspan="2"><?php if ($this->_var['orders']['status'] == '20'): ?><button class="btn  btn-success"  type="submit">ชำระตามที่เลือก</button><?php endif; ?></td>
									<td  colspan="5" align="right"><strong>ยอดรวมสินค้า: </strong></td>
                                     <td style="width:16%" class="price-td" align="center">
                                        <div><strong> <font color="Navy"><?php echo price_format($this->_var['orders']['order_amount']); ?></font> </strong></div>
                                    </td>
                                     
								<tr>
                                </tbody>
                            </table>

                                
 							</form>
                        </div>
						<?php if ($this->_var['orders']['status'] == '20'): ?>
						<form method="post" action="index.php?app=member&act=orderpaid">
							<input  type="hidden" name="orid" value="<?php echo $this->_var['tid']; ?>" >
						<button class="btn btn-lg btn-primary pull-right"  >จ่ายทั้งหมด</button>
						</form>
						<?php endif; ?>
                        <div style="clear:both"></div>

                    </div>
                </div>
		
                     
                
            </div>
            
        </div>
        
    </div>
    
     
 
<?php echo $this->fetch('main_footer.html'); ?>