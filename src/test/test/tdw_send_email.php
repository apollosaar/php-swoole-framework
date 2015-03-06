<?php
/**
 * @Author: winterswang
 * @Date:   2015-01-26 17:38:59
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-01-29 15:48:17
 */

require "/opt/wwwroot/ea.crm2.qq.com/lib/weblib/notify/require.php";

$contents = getTdwResult();
sendEmail($contents);
var_dump($contents);

/**
 * [getPVSql]
 * @param  [type] $startDate [description]
 * @param  [type] $endDate   [description]
 * @return [type]            [description]
 */
function getSql($startDate,$endDate){
	$sqlArr = array();
	$count = intval($endDate) - intval($startDate);
	for ($i=0; $i <$count ; $i++) {
		$startTime = $startDate*100+$i*100;
		$endTime = $startTime +100;
		$sqlArr[] = "SELECT act_type,count(*) as cnt from login_pv WHERE app_id='101163115' AND report_type in(2,3)  AND imp_date>='{$startTime}' and imp_date<'{$endTime}' group by act_type;".PHP_EOL;
		$sqlArr[] = "SELECT count(distinct uin) as cnt from login_pv WHERE app_id='101163115' AND report_type in(2,3)  AND imp_date>='{$startTime}' and imp_date<'{$endTime}' group by act_type;".PHP_EOL;
	}
	return $sqlArr;
}

/**
 * [getSqlResult get result by sql]
 * @param  [type] $sqlArr [description]
 * @return [type]         [description]
 */
function getSqlResult($sqlArr){
	$conn = mysql_connect("10.134.132.211:3306", "read_user", "read_user");
	if (!isset($conn)) {
		error_log(__METHOD__." get conn failed sqlArr = print_r($sqlArr,true)",3,'/tmp/tdw_send_email.log');
	}
	mysql_select_db("tdw_out_db", $conn);

	$result = array();
	foreach ($sqlArr as $key => $sql) {
		$res = array();
		$query = mysql_query($sql,$conn);
		while($row = mysql_fetch_array($query,MYSQL_BOTH)){
			$res[] = $row['cnt'];
		}
		$result[] = $res;
	}
	return $result;
}

/**
 * [getSqlLastday]
 * @return [type] [description]
 */
function getSqlLastday(){
	//TODO 小心月份的最后一天（暂时不用担心）
	$lastDay = date('Ymd',strtotime('yesterday'));
	return getSql($lastDay,intval($lastDay) +1);
}

/**
 * [getTDWResult description]
 * @return [type] [description]
 */
function getTdwResult(){
	//get sql
	$sqlArr = getSqlLastday();
	//get result
	$res = getSqlResult($sqlArr);
	//make contents
	if (empty($res) && count($res) >1) {
		error_log(__METHOD__." getSqlResult is print_r($res,true)",3,'/tmp/tdw_send_email.log');
		return false;
	}
	$lastDay = date('Ymd',strtotime('yesterday'));
	$contents = "$lastDay 数据分析：H5打开的PV：{$res[0][0]} 点击登录的PV：{$res[0][1]}  登录成功的PV：{$res[0][2]} ";
	$contents .= "登录成功的UV：{$res[1][0]}";
	return $contents;
}

/**
 * [sendEmail description]
 * @param  [type] $contents [description]
 * @return [type]           [description]
 */
function sendEmail($contents){

	$notify = new WebTOFNotify();
	$Receiver = "ansongu@tencent.com;betadwang@tencent.com;monicalulu@tencent.com;chalesi@tencent.com";
	$res = $notify ->SendMail('winterswang@tencent.com', $Receiver, '中信联合登录数据统计', $contents,$CC='winterswang@tencent.com');
	if ($res) {
		error_log(__METHOD__." send email successful the contents is : $contents".PHP_EOL,3,'/tmp/tdw_send_email.log');
	}else{
		error_log(__METHOD__." send email failed the contents is : $contents".PHP_EOL,3,'/tmp/tdw_send_email.log');
	}
}


?>