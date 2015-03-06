<?php
/**
 * @Author: markyuan
 * @Date:   2015-02-28 19:13:26
 * @Last Modified by:   markyuan
 * @Last Modified time: 2015-02-28 19:13:26
 */
class Router {


    public static function urlrouter_rewrite(&$uri,$verb=null)  //默认为
    {
        $rewrite = Config::getConfig('Rewrite');
        var_dump($rewrite);
        if (empty($rewrite) or !is_array($rewrite))
        {
            return false;
        }
        $match = array();
        //$uri_for_regx = '/'.$uri;
        $uri_for_regx = $uri;
        foreach($rewrite as $rule)
        {
            var_dump($rule);
           // 'regx' => '^/(<controller>\w+)/(<action>\w+)\.html$',  //这种是默认格式 其余都转到get里面
            //如果设置了规则，并且传进来的不同 则pass 如果未设置，则不需要考虑
            if(isset($rule['verb']) && ($verb !=$rule['verb'])){
                continue;
            }
            $mvc=$rule['mvc'];

            $mvcArr=explode('/',$mvc);
            if(count($mvcArr)<2){  //如果小于2 则返回false
               return false;
            }
            echo 'mvc  is *******************'.PHP_EOL;
            var_dump($mvcArr);
            $mvc=array();
            $mvc['controller']=$mvcArr[0];  //获取了controller 和 action
            $mvc['action']=$mvcArr[1];
            var_dump($mvc);
            $tmp=array();
            if(preg_match_all('/<\w+>/', $rule['regx'], $match)){
                foreach($match[0] as $k => $v ){  //赋值到get参数内 按照顺序筛选出来 赋值出来key值
                    $tmp[]=trim($v,'<>');
                }
            };
            var_dump($tmp);
            echo 'origin regx is *******************'.$rule['regx'].PHP_EOL;

            $regx=preg_replace('/<\w+>/','', $rule['regx']); //获得实际的正则表达式
            var_dump($tmp);
            echo ' regx after process *******************'.$regx.PHP_EOL;

            if (preg_match('#'.$regx.'#i', $uri_for_regx, $match))
            {
                var_dump($match);
                //如果设置了mvc 则走指定的controller
                foreach($tmp as $k=>$v){
                     if($v=='controller'){
                         $mvc['controller']=$match[$k + 1].'Controller';  //获取了controller 和 action
                         continue;
                     }
                    if($v=='action'){
                        $mvc['action']=$match[$k + 1];
                        continue;
                    }
                    //如果不是controller 也不是 action 则放入get参数中
                    $tmpGet[$v] = $match[$k + 1];
                   // $_GET[$v] = $match[$k + 1];
                };
                //合并默认参数------------》以后面一个为准
                echo 'begin test data*111******************'.PHP_EOL;
                var_dump($mvc['get']);
                var_dump($rule['default']);


                if(empty($tmpGet)){
                    if(empty($rule['default'])){  //如果default也是空 那么就不管了

                    }else{
                        $mvc['get']=$rule['default'];
                    }
                }else {
                    if(empty($rule['default'])){  //如果default也是空 那么就不管了
                        $mvc['get']=$tmpGet;
                    }else{
                        $mvc['get']=array_merge($rule['default'],$tmpGet); //以tmpGet去覆盖default
                    }
                }
//                $tmpGet=array();
//                if(!empty($rule['default'])){
//                    $tmpGet=$rule['default'];
//                };
//                if(!empty($rule['default']))
//                $mvc['get']=array_merge($rule['default'],$mvc['get']);
//                echo 'begin test data*  after merge******************'.PHP_EOL;
//                var_dump($mvc['get']);
                //$_GET=array_merge($rule['default'],$_GET);
                return $mvc;
            }
        }
        return false;
    }


//    public static function urlrouter_rewrite(&$uri)
//    {
//        $rewrite = Config::getConfig('Rewrite');
//        var_dump($rewrite);
//        if (empty($rewrite) or !is_array($rewrite))
//        {
//            return false;
//        }
//        $match = array();
//        //$uri_for_regx = '/'.$uri;
//        $uri_for_regx = $uri;
//        foreach($rewrite as $rule)
//        {
//            if (preg_match('#'.$rule['regx'].'#i', $uri_for_regx, $match))
//            {
//                var_dump($match);
//                if(!isset($rule['mvc'])){  //如果没有设置mvc 则表明按照正常的逻辑来
//                    return array('controller'=>$match[1].'Controller','action'=>$match[2]);
//                }
//                //如果设置了mvc 则走指定的controller
//                if (isset($rule['get']))
//                {
//                    $p = explode(',', $rule['get']);
//                    foreach ($p as $k => $v)
//                    {
//                        if (isset($match[$k + 1]))
//                        {
//                            $_GET[$v] = $match[$k + 1];
//                        }
//                    }
//                }
//                return $rule['mvc'];
//            }
//        }
//        return false;
//    }
}
?>