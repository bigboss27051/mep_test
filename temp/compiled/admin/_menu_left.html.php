 
      <aside class="main-sidebar">
        
        <section class="sidebar">
          
           
           
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo $this->_var['menus_left']['Dashboard']; ?> treeview">
			  <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>  </i>
              </a>
               
            </li>
		 
            <li class="<?php echo $this->_var['menus_left']['Downline']; ?> editpass">
              <a href="<?php echo url('app=user&act=editpassadmin'); ?>">
                <i class="fa fa-key"></i>
                <span>Edit Password</span>
                
              </a>
               
            </li>
              <li class="<?php echo $this->_var['menus_left']['Downline']; ?> editpass">
              <a href="<?php echo url('app=user'); ?>">
                <i class="fa fa-users"></i>
                <span> Member</span>
                
              </a>
               
            </li>
              <li class="<?php echo $this->_var['menus_left']['Downline']; ?> editpass">
              <a href="<?php echo url('app=items'); ?>">
                <i class="fa fa-dropbox"></i>
                <span> สินค้าโชว์หน้าแรก</span>
                
              </a>
               
            </li>
            <li class="<?php echo $this->_var['menus_left']['Downline']; ?> editpass">
              <a href="<?php echo url('app=order'); ?>">
                <i class="fa fa-file-text"></i>
                <span>Orders</span>
                
              </a>
               
            </li>
            
			<li class="<?php echo $this->_var['menus_left']['Downline']; ?> editpass">
              <a href="#">
                <i class="fa  fa-sliders"></i>
                <span>ตั้งค่าขนส่ง</span>
                
              </a>
               
            </li>
				<li class="<?php echo $this->_var['menus_left']['E-wallet']; ?> treeview">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>Wallet</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo url('app=ewallet'); ?>"><i class="fa fa-file-text-o"></i> Wallet </a></li>
                <li><a href="<?php echo url('app=ewallet&act=add'); ?>"><i class="fa fa-file-text-o"></i> เติม Wallet</a></li>
                
				
              </ul>
            </li>
            
            <li>
              <a href="<?php echo url('app=default&act=logout'); ?>">
                <i class="fa fa-power-off"></i> <span>Sign Out</span>
               
              </a>
            </li>
            
             
          </ul>
        </section>
        
      </aside>