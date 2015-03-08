<?php
class testHttpServ extends Swoole\Network\Protocol\BaseServer{


    public   $env=array();
    private  $root_path;

    //为了协程，去除
    public function onRequest($request, $response) {

        $verb=$request->server['request_method'];
        $uri=$request->server['request_uri'];
        echo 'first *******************'.PHP_EOL;
        $mvc=Router::urlrouter_rewrite($uri,$verb);
        if($mvc==false){
            //todo 抛出404错误
            $response->status(404);
            $response->end("<h1>Hello Swoole. 404~~~~~~~~ #".rand(1000, 9999)."</h1>");
        }
        //url rewrite is
        echo '=Router::urlrouter_rewrite result is *******************'.PHP_EOL;
        var_dump($mvc);
        if(!method_exists($mvc['controller'],$mvc['action'])){ //查看是否存在
            //todo 抛出404错误
            $response->status(404);
            $response->end("<h1>Hello Swoole. no such controller 404~~~~~~~~ #".rand(1000, 9999)."</h1>");
        };

        //合并get post cookie这些参数参数 统一并到 $requestData里面，传入controller
        echo 'begin test data*111******************'.PHP_EOL;
//        var_dump($mvc['get']);
//        if( !empty($request->get)  ){
//            $requestData['get']=array_merge($mvc['get'],$request->get);//合并get参数
//        }


        if(empty($mvc['get'])){
            if(empty($request->get)){  //如果default也是空 那么就不管了

            }else{
                $requestData['get']=$request->get;
            }
        }else {
            if(empty($request->get)){  //如果default也是空 那么就不管了
                $requestData['get']=$mvc['get'];
            }else{
                $requestData['get']=array_merge($mvc['get'],$request->get); //以tmpGet去覆盖default
            }
        }


        echo 'SECOND merger*******************'.PHP_EOL;
        var_dump($_GET);
        if( !empty($request->post['data']) ){
            $requestData['post']=$request->post['data'];  //合并post参数
        }
        if( !empty($request->post['cookie']) ){
            $requestData['cookie']=$request->post['cookie'];  //合并post参数
        }
        $requestData['total']=$request;



        //进行热更新，如果修改时间大于加载时间，则进行重新载入
        if (extension_loaded('runkit'))
        {
            $this->root_path = dirname(dirname(__FILE__));
            $controller_file=$this->root_path.'/controller/'.$mvc['controller'].'.php';
            clearstatcache();
            $fstat = stat($controller_file);
            //修改时间大于加载时的时间
            if($fstat['mtime'] > $this->env['controllers'][$mvc['controller']]['time'])
            {
                runkit_import($controller_file, RUNKIT_IMPORT_CLASS_METHODS|RUNKIT_IMPORT_OVERRIDE);
                $this->env['controllers'][$mvc['controller']]['time'] = time();
            }
        }

        $controller = new $mvc['controller']($this->server,$requestData);
        $ret=$controller->{$mvc['action']}();
   //     $response->header('Connection', 'Keep-Alive');
        $response->end("<h1>Hello Swoole. #".rand(1000, 9999).' and return is '.print_r($ret,true)."</h1>");
    }
}
