<?php
/**
 * @Author: winterswang
 * @Date:   2015-04-20 14:17:01
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-05-01 18:12:01
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/lib/Swoole/require.php';
require_once 'TestClient.php';

class HttpTestClient extends TestClient{

    public $host, $port, $path;
    public $scheme;
    public $method;
    public $postdata = '';
    public $cookies = array();
    public $referer;
    public $accept = 'text/xml,application/xml,application/xhtml+xml,text/html,text/plain,image/png,image/jpeg,image/gif,*/*';
    public $accept_encoding = 'gzip';
    public $accept_language = 'en-us';
    public $user_agent = 'Incutio HttpClient v0.9d';
    public $request_headers = array();
    // * Options:
    public $timeout = 20;
    public $use_gzip = true;
    public $persist_cookies = true;
    public $persist_referers = false;
    public $debug = false;
    public $handle_redirects = true;
    public $max_redirects = 5;
    public $headers_only = false;
    public $strict_redirects = false;
    // * Basic authorization variables:
    public $username, $password;
    // * Response vars:
    public $status;
    public $headers = array();
    public $rspHeaders = array();
    public $content = '';
    public $request = '';
    public $errormsg;
    // * Tracker variables:
    public $redirect_count = 0;
    public $callback;

    public function __construct($host){

        date_default_timezone_set('asia/shanghai');
        $bits = parse_url($host);
        if(isset($bits['scheme']) && isset($bits['host'])) {
            $host = $bits['host'];
            $scheme = isset($bits['scheme']) ? $bits['scheme'] : 'http';
            $port = isset($bits['port']) ? $bits['port'] : 80;
            $path = isset($bits['path']) ? $bits['path'] : '/';
            
            if (isset($bits['query']))
                $path .= '?'.$bits['query'];
        }
        $this->host = $host;
        $this->port = $port;
        if(isset($bits['scheme']) && isset($bits['host'])) {
            $this->setScheme($scheme);
            $this->setPath($path);
            $this->setMethod("GET");
        }
    }

    public function setRequestHeaders($array) {
        foreach($array as $key => $value) {
            $this->request_headers[$key] = $value;
        }
    }

    public function setMethod($method) {
        // Manually set the request method (not usually needed).
        if (!in_array($method, array("GET","POST","PUT","DEL"."ETE"))){
        	$this ->log(__METHOD__. ' valid method : '.$method);
        	return false;
        }
        $this->method = $method;
        return true;
    }

    public function setPath($path) {
        // Manually set the path (not usually needed).
        $this->path = $path;
    }

    public function setUserAgent($string) {
        // Sets the user agent string to be used in the request.
        // Default is "Incutio HttpClient v$version".
        $this->user_agent = $string;
    }

    public function setAuthorization($username, $password) {
        // Sets the HTTP authorization username and password to be used in requests.
        // Warning: don't forget to unset this in subsequent requests to other servers!
        $this->username = $username;
        $this->password = $password;
    }

    public function setScheme($scheme) {
        // Manually set the path (not usually needed).
        switch($scheme) {
            case 'https':
                $this->scheme = $scheme;
                //TODO 暂不支持
                // $this->port = 443;
                break;
            case 'http':
            default:
                $this->scheme = 'http';
        }
    }

    public function buildRequest(){

        $headers = array();
        $headers[] = "{$this->method} {$this->path} HTTP/1.0"; // * Using 1.1 leads to all manner of problems, such as "chunked" encoding
        $headers[] = "Host: {$this->host}";
        if ($this->referer)
            $headers[] = "Referer: {$this->referer}";
        // * Cookies:
        if (@$this->cookies[$this->host]) {
            $cookie = 'Cookie: ';
            foreach ($this->cookies[$this->host] as $key => $value) {
                $cookie .= "$key=$value; ";
            }
            $headers[] = $cookie;
        }
        // * Basic authentication:
        if ($this->username && $this->password)
            $headers[] = 'Authorization: BASIC '.base64_encode($this->username.':'.$this->password);
        // * If this is a POST, set the content type and length:
        if(!empty($this->request_headers)) {
            foreach($this->request_headers as $key => $val) {
                if($val===false) {
                    // do nothing
                } else {
                    $headers[] = $key.': '.$val;
                }
            }
        }
        if ($this->use_gzip && !isset($this->request_headers['Accept-encoding']))
            $headers[] = "Accept-encoding: {$this->accept_encoding}";
        // If it is a POST, add Content-Type.
        if (!isset($this->request_headers['Content-Type']) &&
            $this->method == 'POST') {
            $headers[] = "Content-Type: application/x-www-form-urlencoded";
        }
        if (!isset($this->request_headers['User-Agent']))
            $headers[] = "User-Agent: {$this->user_agent}";
        if (!isset($this->request_headers['Accept']))
            $headers[] = "Accept: {$this->accept}";
        if (!isset($this->request_headers['Accept-language']))
            $headers[] = "Accept-language: {$this->accept_language}";
        if ($this->postdata && !isset($this->request_headers['Content-Length'])) {
            $headers[] = 'Content-Length: '.strlen($this->postdata);
        }
        $this ->request = implode("\r\n", $headers)."\r\n\r\n".$this->postdata; 	
    }

    public function buildQuery($data) {
        
        if(is_string($data)) {
            $this->postdata = $data;
            return true;
        } else if(is_object($data) || is_array($data)){
            $this->postdata = http_build_query($data);
            return true;
        } else {
            //trigger_error("HttpClient::postdata : '".gettype($data)."' is not valid post data.", E_USER_ERROR);
            return false;
        }
    }

    public function get($path, $data = null, $headers=array()){

        $this->orig_path = $this->path;
        if(!empty($this->path))
            $this->path .= $path;
        else
            $this->path = $path;
        $this->method = 'GET';
        if ($data) $this->path .= '?'.http_build_query($data);
        $this->setRequestHeaders($headers);
        $this->buildRequest();

        $res = (yield $this);
        //$this ->log(__METHOD__." GET RESULT = ". print_r($res,true));
        yield $res;
    }

    public function post($path, $data, $headers=array()){

        $this ->orig_path = $this->path;
        if(!empty($this->path))
            $this->path .= $path;
        else
            $this->path = $path;
        $this->method = 'POST';
        $this->setRequestHeaders($headers);
        $this->buildQuery($data);
        $this->buildRequest();

        $res = (yield $this);
        //$this ->log(__METHOD__." POST RESULT = ". print_r($res,true));
        yield $res;
    }

    public function sendData(callable $callback){

        $client = new  swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

        $client->on("connect", function($cli){
            $cli->send($this ->request);
        });

        $client->on('close', function($cli){
        });

        $client->on('error', function($cli) use($callback){
            $cli ->close();
            call_user_func_array($callback, array('r' => 1, 'key' => $this ->key,  'error_msg' => 'conncet error'));
        });

        $client->on("receive", function($cli, $data) use($callback){
            call_user_func_array(array($this, 'packRsp'), array('r' => 0, 'key' => $client, 'data' =>$data));
        });

        $this ->callback = $callback;
        if($client->connect($this ->host, $this ->port, $this ->timeout)){

            if (intval($this ->timeout) >0) {
                swoole_timer_after(intval($this ->timeout) * 1000, function() use($client,$callback){
                    if ($client ->isConnected()) {
                        $client ->close();
                        call_user_func_array($callback, array('r' => 2 ,'key' => '', 'error_msg' => 'timeout'));
                    }
                });
            }
        }
    }

    public function packRsp($r,$k,$data){

        //echo __METHOD__."r = $r k = $k  data === ".print_r($data,true); 
    	if ($r != 0) {
    		//LOG
    		return;
    	}

        $this ->content .= $data;

    	if (empty($this ->rspHeaders)) {
    		$this ->parseHeader($data);
    	}
    	
        $body_length = strlen($this ->content);
        //判断包是否收全
        //Content-Length
        if (isset($this ->respHeader['Content-Length']) && $body_length == $this ->respHeader['Content-Length']) {
            $this ->log(__METHOD__. "callback = ".print_r($this ->callback,true));
            $this ->log(__METHOD__." pack finish body === ".$this ->content);
            call_user_func_array($this ->callback, array('r' => 0, 'key' => '', 'data' =>$this ->content));
            //TODO 合包完成，回调
        }else{
            $log = 'header content-lengh = '.$this ->respHeader['Content-Length'] . ' content length == '. strlen($this ->content);
            $this ->log($log);
        }

        //chunked 
        if (isset($this->respHeader['Transfer-Encoding']) and $this->respHeader['Transfer-Encoding'] == 'chunked') {

            //以\r\n分割为两个数组，第一部分是字节长，第二部分为body
            //字节长不为零，合并body，字节长为零，合并body，返回
            $parts = explode("\r\n", $data, 2);

            if (intval($parts[0]) != 0 && isset($parts[1])) {
                $this ->content .= $parts[1];
                $log = 'chunked packing content  == '. $this ->content."\n";
                $this ->log($log);
            }
            else{
                $log = 'chunked pack finish content  == '. $this ->content."\n";
                $this ->log($log);
                call_user_func_array($this ->callback, array('r' => 0, 'key' => '', 'data' =>$this ->content));                
            }
        }

    }

    private function parseHeader($data){

    	$parts = explode("\r\n\r\n", $data, 2);
		$headerLines = explode("\r\n", $parts[0]);
		list($this ->rspHeaders['method'], $this ->rspHeaders['uri'], $this ->rspHeaders['protocol']) = explode(' ', $headerLines[0], 3);

        $this->respHeader =  \Swoole\Http\Parser::parseHeaderLine($headerLines);

        if (isset($parts[1])) {
            $this ->content = $parts[1];
        }

        //print_r($this ->respHeader);
        $this ->log(__METHOD__." header == ".print_r($this ->respHeader,true));
    }

    public function test($r, $k, $data){
        echo " r = $r k = $k data = ". print_r($data,true);
    }

	/**
	 * [log 简单的LOG]
	 * @param  [type] $log [description]
	 * @return [type]      [description]
	 */
	public function log($log){
        $time = date('Y-m-d H:i:s');
        error_log($time . $log . PHP_EOL, 3, '/tmp/'.__CLASS__.'.log');
	}

}