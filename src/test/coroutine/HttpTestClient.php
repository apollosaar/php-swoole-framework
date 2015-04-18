<?php
/**
 * @Author: winterswang
 * @Date:   2015-04-14 11:53:50
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-04-17 17:26:18
 */

require_once 'TestClient.php';
class HttpTestClient extends TestClient{

    // * Request vars:
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
    public $content = '';
    public $errormsg;
    // * Tracker variables:
    public $redirect_count = 0;
	
    public function __construct($host, $port=80) {
       
        $bits = parse_url($host);
        if(isset($bits['scheme']) && isset($bits['host'])) {
            $host   = $bits['host'];
            $scheme = isset($bits['scheme']) ? $bits['scheme'] : 'http';
            $port   = isset($bits['port']) ? $bits['port'] : 80;
            $path   = isset($bits['path']) ? $bits['path'] : '/';
            
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

	public function setHeader($header = array()){

        foreach($header as $key => $value) {
            $this->request_headers[$key] = $value;
        }
	}

	/**
	 * [get get,post,put,delete都是封装数据给对象实例，然后yeild回协程调度里，再执行sendData函数，完成发包]
	 * @param  [type] $url     [description]
	 * @param  array  $request [description]
	 * @return [type]          [description]
	 */
	public function get($url,$request = array()){

        $this->orig_path = $this->path;
        if(!empty($this->path))
            $this->path .= $path;
        else
            $this->path = $path;
        $this->method = 'GET';
        if ($data) $this->path .= '?'.http_build_query($data);
        $this->setRequestHeaders($headers);

		yield $this;
	}

	public function post($url,$data){

        $orig_path = $this->path;
        if(!empty($this->path))
            $this->path .= $path;
        else
            $this->path = $path;
        $this->method = 'POST';
        $this->setRequestHeaders($headers);
        $this->buildQuery($data);

		yield $this;
	}

	public function put(){

		yield $this;
	}

	public function delete(){

		yield $this;
	}

	public function getHeader(){

	}

    public function setAuthorization($username, $password) {

        $this->username = $username;
        $this->password = $password;
    }

    public function setUserAgent($string) {
        // Sets the user agent string to be used in the request.
        // Default is "Incutio HttpClient v$version".
        $this->user_agent = $string;
    }

    public function setCookies($array, $replace = false) {

        if ($replace || !is_array(@$this->cookies[$this->host]))
            $this->cookies[$this->host] = array();
        $this->cookies[$this->host] = ( $array + $this->cookies[$this->host] );
    }

    public function buildQuery($data) {
        if(is_string($data)) {
            $this->postdata = $data;
            return true;
        } else if(is_object($data) || is_array($data)){
            $this->postdata = http_build_query($data);
            return true;
        } else {
            trigger_error("HttpClient::postdata : '".gettype($data)."' is not valid post data.", E_USER_ERROR);
            return false;
        }
    }

    public function buildRequest() {
        // Constructs the headers of the HTTP request.
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
        $request = implode("\r\n", $headers)."\r\n\r\n".$this->postdata;
        return $request;
    }

    public function setScheme($scheme) {
        // Manually set the path (not usually needed).
        switch($scheme) {
            case 'https':
                $this->scheme = $scheme;
                $this->port = 443;
                break;
            case 'http':
            default:
                $this->scheme = 'http';
        }
    }

    public function setPath($path) {
        // Manually set the path (not usually needed).
        $this->path = $path;
    }

    public function setMethod($method) {
        // Manually set the request method (not usually needed).
        if (!in_array($method, array("GET","POST","PUT","DEL"."ETE"))) trigger_error("HttpClient::setMethod() : '$method' is not a valid method", E_USER_ERROR);
        $this->method = $method;
    }
    
	/**
	 * [sendData 基于IP,PORT完成发包，只是包相对于纯TCP，做了一层协议包装]
	 * @return [type] [description]
	 */
	public function sendData(callable $callback){

        $client = new  swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

        $client->on("connect", function($cli){
            $cli->send($this ->data);
        });

        $client->on('close', function($cli){
        });

        $client->on('error', function($cli) use($callback){
            $cli ->close();
            call_user_func_array($callback, array('r' => 1, 'key' => $this ->key,  'error_msg' => 'conncet error'));
        });

        $client->on("receive", function($cli, $data) use($callback){
            $cli->close();
            call_user_func_array($callback, array('r' => 0, 'key' => $this ->key, 'data' =>$data));
        });

        if($client->connect($this ->ip, $this ->port, $this ->timeout)){

            if (intval($this ->timeout) >0) {
                swoole_timer_after(intval($this ->timeout) * 1000, function() use($client,$callback){
                    if ($client ->isConnected()) {
                        $client ->close();
                        call_user_func_array($callback, array('r' => 2 ,'key' => '', 'httpClient' => $this));
                    }
                });
            }
        }
	}

	/**
	 * [packRsp http存在大包需要多次合包的情况，可以理解为特殊的multicall的实现]
	 * @return [type] [description]
	 */
	public function packRsp(){

        //TODO sendData的回调函数
        //收到回调，解包
        //拼包，根据两个指标 trunk_length or header[content-length]
        //如果拼完，返回给协程调度
        //没有，return，继续等包
	}
}
?>