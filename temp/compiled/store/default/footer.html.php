<div id="footer">
    <p>
        <a href="index.php">index</a>
        <?php $_from = $this->_var['navs']['footer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');if (count($_from)):
    foreach ($_from AS $this->_var['nav']):
?>
        | <a href="<?php echo $this->_var['nav']['link']; ?>"<?php if ($this->_var['nav']['open_new']): ?> target="_blank"<?php endif; ?>><?php echo htmlspecialchars($this->_var['nav']['title']); ?></a>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </p>
    <?php echo sprintf('query_info', $this->_var['query_time'],$this->_var['query_count'],$this->_var['query_user_count']); ?>
    <?php if ($this->_var['gzip_enabled']): ?>gzip_enabled<?php else: ?>gzip_disabled<?php endif; ?>
    <?php if ($this->_var['memory_info']): ?><?php echo sprintf('memory_info', $this->_var['memory_info']); ?><?php endif; ?> <?php echo $this->_var['statistics_code']; ?><br />
    Powered by <a href="http://ecmall.shopex.cn/?pid=6&host=<?php echo $this->_var['site_domain']; ?>" target="_blank">ECMall <?php echo $this->_var['ecm_version']; ?></a> &copy; 2003-2012 <a href="http://www.shopex.cn" target="_blank">ShopEx Inc.</a>
</div>
<?php echo $this->_var['async_sendmail']; ?>
</body>
</html>