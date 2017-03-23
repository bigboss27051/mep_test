<?php

 
define('REWRITE_RULE_FN', '[FN]');

 
class BaseRewrite extends Object
{
     
    var $_rewrite_maps  = array();

    
    var $_rewrite_rules = array();

   
    function get($query, $rewrite_name = null)
    {
        $rewrite  = '';

	 
        if (empty($query))
        {
            return '';
        }
 
        $url_params = is_array($query) ? $query : $this->_get_params($query);
	 
        $rewrite_name = empty($rewrite_name) ? $this->_get_rule_by_param($url_params) : $rewrite_name;
        $rewrite_rule = $this->_get_rule($rewrite_name);

        if (!empty($rewrite_rule))
        {
            $pattern = $this->_get_replace_pattern($url_params);
            $rewrite = str_replace($pattern, $url_params, $rewrite_rule['rewrite']);
        }
        else
        {
            return false;
        }

        return $rewrite;
    }

     
    function _get_params($query_string)
    {
        $return = array();
        if (!empty($query_string))
        {
            $tmp = explode('&', $query_string);
            foreach ($tmp as $tmp_item)
            {
                $q = explode('=', $tmp_item);
                $return[$q[0]] = $q[1];
            }
        }
	  
        return $return;
    }

    /**
     *    获取规则信息
     *
     *    @author    Garbin
     *    @param     string $rule_name
     *    @return    array
     */
    function _get_rule($rule_name)
    {
        return isset($this->_rewrite_rules[$rule_name]) ? $this->_rewrite_rules[$rule_name] : null;
    }

    /**
     *    通过规则地图获取规则名称
     *
     *    @author    Garbin
     *    @param     array $url_params
     *    @return    string
     */
    function _get_rule_by_param($url_params)
    {


        $key = $this->_get_mapkey($url_params);
	 
		

        return $this->_get_rule_by_mapkey($key, $url_params);
    }

    function _get_mapkey($url_params)
    {
        $key = '';
        $app = isset($url_params['app']) ? $url_params['app'] : null;
        $query = '';
        unset($url_params['app']);
        $query_keys = array_keys($url_params);
        if (!empty($query_keys))
        {
            sort($query_keys);
            $query = implode('_', $query_keys);
        }
        if ($app)
        {
            $key = $app;
            $key .= ($query) ? '_' . $query : '';
        }
        else
        {
            $key = $query;
        }

	 
        return $key;
    }

    function _get_rule_by_mapkey($key, $url_params = array())
    {
        $rule_name = isset($this->_rewrite_maps[$key]) ? $this->_rewrite_maps[$key] : '';
        if ($rule_name == REWRITE_RULE_FN)
        {
            $method_name = 'rule_' . $key;
            $rule_name = $this->$method_name($url_params);
        }

        return $rule_name;
    }

    /**
     *    获取规则项目
     *
     *    @author    Garbin
     *    @param     array $url_params
     *    @return    array
     */
    function _get_replace_pattern($url_params)
    {
        $return = array();
        if (!empty($url_params))
        {
            foreach ($url_params as $key => $value)
            {
                $return[] = '%' . $key . '%';
            }
        }

        return $return;
    }
}

?>
