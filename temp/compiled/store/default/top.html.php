<div id="nav">
    <div class="banner"><a href="<?php echo url('app=store&id=' . $this->_var['store']['store_id']. ''); ?>">
        <?php if ($this->_var['store']['store_banner']): ?>
        <img src="<?php echo $this->_var['store']['store_banner']; ?>" width="1000" height="120" />
        <?php else: ?>
        <img src="<?php echo $this->res_base . "/" . 'images/banner.jpg'; ?>"  />
        <?php endif; ?>
    </a></div>

    <ul>
        <li><a class="<?php if ($_GET['app'] == 'store' && $_GET['act'] == 'index'): ?>active<?php else: ?>normal<?php endif; ?>" href="<?php echo url('app=store&id=' . $this->_var['store']['store_id']. ''); ?>"><span>store_index</span></a></li>
        <?php if ($this->_var['store']['functions']['groupbuy'] && $this->_var['store']['enable_groupbuy']): ?>
        <li><a class="<?php if ($_GET['app'] == 'groupbuy' || $_GET['act'] == 'groupbuy'): ?>active<?php else: ?>normal<?php endif; ?>" href="<?php echo url('app=store&act=groupbuy&id=' . $this->_var['store']['store_id']. ''); ?>"><span>nav_groupbuy</span></a></li>
        <?php endif; ?>
        <?php $_from = $this->_var['store']['store_navs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'store_nav');if (count($_from)):
    foreach ($_from AS $this->_var['store_nav']):
?>
        <li><a class="<?php if ($_GET['app'] == 'store' && $_GET['act'] == 'article' && $_GET['id'] == $this->_var['store_nav']['article_id']): ?>active<?php else: ?>normal<?php endif; ?>" href="<?php echo url('app=store&act=article&id=' . $this->_var['store_nav']['article_id']. ''); ?>"><span><?php echo htmlspecialchars($this->_var['store_nav']['title']); ?></span></a></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <li><a class="<?php if ($_GET['app'] == 'store' && $_GET['act'] == 'credit'): ?>active<?php else: ?>normal<?php endif; ?>" href="<?php echo url('app=store&act=credit&id=' . $this->_var['store']['store_id']. ''); ?>"><span>credit_evaluation</span></a></li>
        <a class="collection" href="javascript:collect_store(<?php echo $this->_var['store']['store_id']; ?>)">collect_the_store</a>
    </ul>

    <div class="nav_bg"></div>
</div>