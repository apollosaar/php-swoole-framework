<?php

class testUdpServ extends Swoole\Network\Protocol\BaseServer{


    public function onReceive($server, $fd, $fromId, $data) {

    	//TODO
    	//接受客户端【企业QQ】推送来的UDP数据
    	//验证数据，解数据
    	//检查号码的类型，如果是工号@主号的形式，走逻辑1，如果是靓号，走逻辑2
    	//逻辑1，验证号码是否属于某区间【参考之前的业务逻辑】
    	//逻辑2，验证号码是否换回主号【tlv协议】
        $spk_ReqBody = new Tencent\Crm\Spkey\ReqBody();
        $spk_ReqBody -> parseFromString($data);
        var_dump($spk_ReqBody);

        //回包
        $spk_ResBody = new Tencent\Crm\Spkey\RspBody();
        $spk_ResBody ->setUint32Status(1);
        $spk_ResBody ->setStrMsg('test');
        $data = $spk_ResBody ->serializeToString();
        $this->server->send($fd, $data);
    }
}
