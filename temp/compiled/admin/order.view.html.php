<?php echo $this->fetch('header.html'); ?>
<?php echo $this->fetch('_menu_top.html'); ?> 
<?php echo $this->fetch('_menu_left.html'); ?> 

      
      <div class="content-wrapper">
        
        <section class="content-header">
          <h1>
            Invoice
            <small>#<?php echo $this->_var['order']['order_sn']; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Invoice</li>
          </ol>
        </section>

         

        
        <section class="invoice">
          
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i>
                <small class="pull-right">Date: <?php echo local_date("Y-m-d",$this->_var['order']['add_time']); ?></small>
              </h2>
            </div>
          </div>
          
          <div class="row invoice-info">
          
            <div class="col-sm-4 invoice-col">
              Address Customer
              <address>
                <strong><?php echo htmlspecialchars($this->_var['order_extm']['consignee']); ?></strong><br>
                <?php echo htmlspecialchars($this->_var['order_extm']['address']); ?><br>
				<b>Phone</b>:<?php echo htmlspecialchars($this->_var['order_extm']['phone_tel']); ?>
              </address>
            </div>
			  <div class="col-sm-4 invoice-col">
               
              <address>
                <strong></strong><br>
                 
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              <b>Invoice #<?php echo $this->_var['order']['order_sn']; ?></b><br>
              <br>
              <b>Order ID:</b> <?php echo $this->_var['order']['order_id']; ?><br>
              <b>Payment Due:</b> <?php echo local_date("Y-m-d",$this->_var['order']['add_time']); ?><br>
              <b>Account:</b> <?php echo htmlspecialchars($this->_var['order']['buyer_name']); ?>
            </div>
          </div>

          
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
					<th>Link</th>
                   
                    <th>Product</th>
                    
                    <th>Color</th>
					<th>Size</th>	
					 <th>Qty</th>
					<th>Price</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
				<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                  <tr>
					
                    <td><a href='<?php echo $this->_var['goods']['link']; ?>' target="_blank"  class='btn btn-xs btn-success'>Go taobao<a></td>
                    <td><?php echo htmlspecialchars($this->_var['goods']['goods_name_thai']); ?></td>
                    <td><a href="<?php echo $this->_var['goods']['color']; ?>" target="_blank"><img   src="<?php echo $this->_var['goods']['color']; ?>" width="30"> <a></td>
					<td><?php echo $this->_var['goods']['size']; ?> </td>
					<td><?php echo htmlspecialchars($this->_var['goods']['quantity']); ?></td>
					<td><?php echo price_format($this->_var['goods']['price']); ?></td>
                    <td><?php echo price_format($this->_var['goods']['goods_total']); ?></td>
                     
                  </tr>
                   
				 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row">
            
            <div class="col-xs-6">
              <p class="lead">Payment Methods: <?php echo $this->_var['order']['payment_name']; ?></p>
              <img src="../../dist/img/credit/visa.png" alt="Visa">
              <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
              <img src="../../dist/img/credit/american-express.png" alt="American Express">
              <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
              </p>
            </div>
            <div class="col-xs-6">
              <p class="lead">Amount Due 2/22/2014</p>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td><?php echo price_format($this->_var['order']['goods_amount']); ?></td>
                  </tr>
                  <tr>
                    <th>Tax (0)</th>
                    <td>0.00</td>
                  </tr>
                  
                  <tr>
                    <th>Total:</th>
                    <td><?php echo price_format($this->_var['order']['order_amount']); ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          
          <div class="row no-print">
            <div class="col-xs-12">
              <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
               
            </div>
          </div>
        </section>
        <div class="clearfix"></div>
      </div>
 
 
 
<?php echo $this->fetch('footer.html'); ?>

 
         
         