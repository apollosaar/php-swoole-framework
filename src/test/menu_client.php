<?php
/**
 * @Author: winterswang
 * @Date:   2015-02-11 10:54:25
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-02-12 17:29:09
 */

$json = '{"button_info":[{"auth_type":1,"file_id":2,"key":"V1003_PAY_MOBILE","name":"tet","sub_button":[],"type":2,"url":"http://s.p.qq.com/pub/jump?url=http%3A%2F%2Fchong.qq.com%2Fmobile%2Fmobile.shtml%3Fvb2ctag%3D4_2048_1_2207&k=3355812671&st=5&fid=2&puin=2711679534"},{"file_id":3,"name":"TIPS","sub_button":[{"file_id":4,"key":"V1001_PASSWORD_SECURITY","name":"tet","sub_button":[],"type":1},{"file_id":5,"key":"V1001_TRANSACTION_SECURITY","name":"test","sub_button":[],"type":1},{"file_id":6,"key":"V1001_OVERALL_SAFETY","name":"test","sub_button":[],"type":1}]},{"file_id":7,"name":"test","sub_button":[{"file_id":8,"key":"V1002_MOBILE_LOSE","name":"test","sub_button":[],"type":1},{"file_id":9,"key":"V1002_QQ_STEALED","name":"QQ","sub_button":[],"type":1}]}],"max_id":9}';
$json = ' {"button":[{"type":"click","name":"test","key":"V1001_TODAY_MUSIC"},{"name":"test","sub_button":[{"type":"view","name":"test","url":"http://www.soso.com/"},{"type":"view","name":"test","url":"http://v.qq.com/"},{"type":"click","name":"hheee","key":"V1001_GOOD"}]}]}';
$result = array('button' => array());
$jsonArr = json_decode($json);
transArray($result['button'],$jsonArr ->button);
print_r($result);

function transArray(&$result ,$arr,$file_id =2){
	if (is_array($arr)) {
		foreach ($arr as $key => $button) {
			$bt = array();
			$bt['file_id'] = $file_id ++;
			$bt['type'] = $button ->type;
			$bt['url'] = isset($button ->url) ? $button ->url : '';
			$bt['name'] = $button ->name;
			$bt['key'] = isset($button ->key) ? $button ->key : '';
			if (! empty($button ->sub_button)) {
				transArray($bt['sub_button'],$button ->sub_button,$file_id);
			}
			else{
				$bt['sub_button'] = array();
			}
			$result[] = $bt;
		}
	}
}

?>