<?
/**
 * @Author: winterswang
 * @Date:   2015-01-22 17:18:49
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-01-22 17:20:21
 */

//不同环境的后台IP、PORT配置
if($_SERVER['CRM2_DEV'] == "dev")
{
    define('IP_USER_VERSION', '172.23.183.33'); // 拉好友的版本信息
    define('IP_TTC_SERVER', '172.23.183.33'); // ttc的ip//
    define('IP_GROUPMSG_INFO', '172.27.192.252'); // 群发的svr
    define('IP_OIDIRTY_SERVER', '172.23.30.15'); // 脏词检查//
    define('IP_TOKEN_LOG', '172.23.154.97'); // token的日志//
    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器//
    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.146'); // 第三方加好友
    define('IP_REPORT_ANONYMOUS_IP', '10.128.1.53'); // 上报匿名聊天地理信息
    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问//
    define('IP_OPENAPI_SERVER', '10.128.0.228'); //第三方合作开发接口的后台服务器地址
    define('ID_ENV', 0); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
    define('IP_MOBILE_MSG_SERVER', '172.23.11.168'); // 发送短信的服务器，容灾备份机10.177.154.44
    define('IP_CRM_PHP_SERVER', '10.130.88.175'); // crm的PHPServer的ip//

    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录//

    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
    define('IP_WEB_INTERFACE', '10.128.1.53'); // web interface ip
    define('PORT_WEB_INTERFACE', 2200); // web interface port
}
else if($_SERVER['CRM2_DEV'] == "devnew")
{
    define('IP_USER_VERSION', '10.128.1.53');
    define('IP_TTC_SERVER', '10.128.1.53'); // ttc的ip
    define('IP_GROUPMSG_INFO', '172.27.192.252'); // 群发的svr
    define('IP_OIDIRTY_SERVER', '172.23.30.15'); // 脏词检查
    define('IP_TOKEN_LOG', '172.23.154.97'); // token的日志
    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器
    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.146'); // 第三方加好友
    define('IP_REPORT_ANONYMOUS_IP', '10.128.1.53'); // 上报匿名聊天地理信息
    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问
    define('IP_OPENAPI_SERVER', '10.128.0.228'); //第三方合作开发接口的后台服务器地址
    define('ID_ENV', 0); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
    define('IP_MOBILE_MSG_SERVER', '172.23.11.168'); // 发送短信的服务器，容灾备份机10.177.154.44
    define('IP_CRM_PHP_SERVER', '10.130.88.175'); // crm的PHPServer的ip

    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录
    define('REQUEST_WPA_CLICK', '172.23.30.116:30401'); //tmp 待INTERFACE上线后，再改回去

    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
    define('IP_WEB_INTERFACE', '10.128.1.53'); // web interface ip
    define('PORT_WEB_INTERFACE', 2200); // web interface port

    // 手机项目web interface
    define('IP_MOBILE_WEB_INTERFACE', '10.128.1.53'); // web interface ip
    define('PORT_MOBILE_WEB_INTERFACE', 2200); // web interface port
    
    //BOSSweb interface
    define('IP_BOSS_WEB_INTERFACE','10.137.146.115');//ip
    define('PORT_BOSS_WEB_INTERFACE',40001);//port
    
    //boss php server
    define('IP_GDT_PHPSERVER','10.130.88.175');//gdt php server ip

}
//else if($_SERVER['CRM2_DEV'] == "oa")
//{
//    define('IP_USER_VERSION', '10.130.87.102');
//    define('IP_TTC_SERVER', '10.130.89.28'); // ttc的ip
//    define('IP_GROUPMSG_INFO', '10.133.8.178'); // 群发的svr
//    define('IP_OIDIRTY_SERVER', '10.130.88.210'); // 脏词检查
//    define('IP_TOKEN_LOG', '10.134.9.168'); // token的日志
//    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器
//    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.200'); // 第三方加好友
//    define('IP_REPORT_ANONYMOUS_IP', '10.134.9.168'); // 上报匿名聊天地理信息
//    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问
//    define('IP_OPENAPI_SERVER', '10.134.9.143'); //第三方合作开发接口的后台服务器地址
//    define('ID_ENV', 2); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
//    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
//    define('IP_MOBILE_MSG_SERVER', '10.128.71.202'); // 发送短信的服务器，容灾备份机10.177.154.44
//    define('IP_CRM_PHP_SERVER', '10.130.3.49'); // crm的PHPServer的ip
//
//    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录
//
//    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
//    define('IP_WEB_INTERFACE', '10.177.154.43'); // web interface ip
//    define('PORT_WEB_INTERFACE', 2200); // web interface port
//
//    //BOSSweb interface
//    define('IP_BOSS_WEB_INTERFACE','10.177.154.49');//ip
//    define('PORT_BOSS_WEB_INTERFACE',40001);//port
//
//    //boss php server
//    define('IP_GDT_PHPSERVER','10.130.3.49');//gdt php server ip
//}
else if($_SERVER['CRM2_DEV'] == "oa")
{
    define('IP_USER_VERSION', '172.23.30.116');
    define('IP_TTC_SERVER', '172.23.30.116');
    define('IP_GROUPMSG_INFO', '172.27.192.252');
    define('IP_OIDIRTY_SERVER', '172.23.30.15');
    define('IP_TOKEN_LOG', '172.23.30.15');
    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器
    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.146');
    define('IP_REPORT_ANONYMOUS_IP', '10.128.64.110');
    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问ip
    define('IP_OPENAPI_SERVER', '10.128.0.228'); //第三方合作开发接口的后台服务器地址
    define('ID_ENV', 1); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
    define('IP_MOBILE_MSG_SERVER', '172.23.11.168'); // 发送短信的服务器，容灾备份机10.177.154.44
    define('IP_CRM_PHP_SERVER', '172.27.192.252'); // crm的PHPServer的ip

    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录
    define('REQUEST_WPA_CLICK', '172.23.30.116:30401'); //tmp 待INTERFACE上线后，再改回去

    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
    define('IP_WEB_INTERFACE', '172.23.11.168'); // web interface ip
    define('PORT_WEB_INTERFACE', 2200); // web interface port

    // 手机项目web interface
    define('IP_MOBILE_WEB_INTERFACE', '10.133.4.216'); // web interface ip
    define('PORT_MOBILE_WEB_INTERFACE', 2200); // web interface port

    //BOSSweb interface
    define('IP_BOSS_WEB_INTERFACE','10.177.154.49');//ip
    define('PORT_BOSS_WEB_INTERFACE',40001);//port

    //boss php server
    define('IP_GDT_PHPSERVER','172.27.192.252');//gdt php server ip
}

else if($_SERVER['CRM2_DEV'] == "gtest")
{
    define('IP_USER_VERSION', '10.128.64.110');
    define('IP_TTC_SERVER', '10.128.64.110'); // ttc的ip
    define('IP_GROUPMSG_INFO', '172.27.192.252'); // 群发的svr
    define('IP_OIDIRTY_SERVER', '10.130.88.210'); // 脏词检查
    define('IP_TOKEN_LOG', '10.134.9.168'); // token的日志
    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器
    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.146'); // 第三方加好友
    define('IP_REPORT_ANONYMOUS_IP', '10.128.64.110'); // 上报匿名聊天地理信息
    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问
    define('IP_OPENAPI_SERVER', '10.128.0.228'); //第三方合作开发接口的后台服务器地址
    define('ID_ENV', 1); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
    define('IP_MOBILE_MSG_SERVER', '172.23.11.168'); // 发送短信的服务器，容灾备份机10.177.154.44
    define('IP_CRM_PHP_SERVER', '10.128.64.110'); // crm的PHPServer的ip

    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录

    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
    define('IP_WEB_INTERFACE', '172.23.11.168'); // web interface ip
    define('PORT_WEB_INTERFACE', 2200); // web interface port

    // 手机项目web interface
    define('IP_MOBILE_WEB_INTERFACE', '10.133.4.216'); // web interface ip
    define('PORT_MOBILE_WEB_INTERFACE', 2200); // web interface port
    
    //BOSSweb interface
    define('IP_BOSS_WEB_INTERFACE','10.134.9.146');//ip
    define('PORT_BOSS_WEB_INTERFACE',40001);//port
    
    //boss php server
    define('IP_GDT_PHPSERVER','10.128.64.110');//gdt php server ip
}
else if($_SERVER['CRM2_DEV'] == "g1")
{
    define('IP_USER_VERSION', '10.130.87.102');
    define('IP_TTC_SERVER', '10.130.89.28'); // ttc的ip
    define('IP_GROUPMSG_INFO', '10.133.8.178'); // 群发的svr
    define('IP_OIDIRTY_SERVER', '10.130.88.210'); // 脏词检查
    define('IP_TOKEN_LOG', '10.134.9.168'); // token的日志
    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器
    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.200'); // 第三方加好友
    define('IP_REPORT_ANONYMOUS_IP', '10.134.9.168'); // 上报匿名聊天地理信息
    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问
    define('IP_OPENAPI_SERVER', '10.134.9.143'); //第三方合作开发接口的后台服务器地址
    define('ID_ENV', 2); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
    define('IP_MOBILE_MSG_SERVER', '10.128.71.202'); // 发送短信的服务器，容灾备份机10.177.154.44
    define('IP_CRM_PHP_SERVER', '10.130.3.49'); // crm的PHPServer的ip

    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录

    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
    define('IP_WEB_INTERFACE', '10.177.154.43'); // web interface ip
    define('PORT_WEB_INTERFACE', 2200); // web interface port
    
    //BOSSweb interface
    define('IP_BOSS_WEB_INTERFACE','10.177.154.49');//ip
    define('PORT_BOSS_WEB_INTERFACE',40001);//port
    
    //boss php server
    define('IP_GDT_PHPSERVER','10.130.3.49');//gdt php server ip
}
else if($_SERVER['CRM2_DEV'] == "g2")
{
    // g2暂时不用，不配置ip
}
else if($_SERVER['CRM2_DEV'] == "g3")
{
    // g3 临时测试扩容和容灾
    define('IP_USER_VERSION', '10.130.87.102');
    define('IP_TTC_SERVER', '10.134.134.75'); // ttc的ip
    define('IP_GROUPMSG_INFO', '10.133.8.178'); // 群发的svr
    define('IP_OIDIRTY_SERVER', '10.130.88.210'); // 脏词检查
    define('IP_TOKEN_LOG', '10.134.9.168'); // token的日志
    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器
    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.200'); // 第三方加好友
    define('IP_REPORT_ANONYMOUS_IP', '10.130.89.28'); // 上报匿名聊天地理信息
    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问
    define('IP_OPENAPI_SERVER', '10.134.9.143'); //第三方合作开发接口的后台服务器地址
    define('ID_ENV', 2); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
    define('IP_MOBILE_MSG_SERVER', '10.128.71.202'); // 发送短信的服务器，容灾备份机10.177.154.44
    define('IP_CRM_PHP_SERVER', '10.130.3.49'); // crm的PHPServer的ip

    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录

    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
    define('IP_WEB_INTERFACE', '10.177.154.49'); // web interface ip
    define('PORT_WEB_INTERFACE', 2200); // web interface port
}
else if($_SERVER['CRM2_DEV'] == "g4")
{
    // g4暂时不用，不配置ip
}
else if($_SERVER['CRM2_DEV'] == "other")
{
    define('IP_USER_VERSION', '10.130.87.102');
    define('IP_TTC_SERVER', '10.130.89.28'); // ttc的ip
    define('IP_GROUPMSG_INFO', '10.133.8.178'); // 群发的svr
    define('IP_OIDIRTY_SERVER', '10.130.88.210'); // 脏词检查
    define('IP_TOKEN_LOG', '10.134.9.168'); // token的日志
    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器
    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.200'); // 第三方加好友
    define('IP_REPORT_ANONYMOUS_IP', '10.134.9.168'); // 上报匿名聊天地理信息
    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问
    define('IP_OPENAPI_SERVER', '10.134.9.143'); //第三方合作开发接口的后台服务器地址
    define('ID_ENV', 2); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
    define('IP_MOBILE_MSG_SERVER', '10.128.71.202'); // 发送短信的服务器，容灾备份机10.177.154.44
    define('IP_CRM_PHP_SERVER', '10.130.3.49'); // crm的PHPServer的ip
    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录
    define('REQUEST_WPA_CLICK', '10.136.160.157:30401');//tmp 待INTERFACE上线后，再改回去

    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
    define('IP_WEB_INTERFACE', '10.177.154.43'); // web interface ip
    define('PORT_WEB_INTERFACE', 2200); // web interface port

    // 手机项目web interface
    define('IP_MOBILE_WEB_INTERFACE', '10.177.154.49'); // web interface ip
    define('PORT_MOBILE_WEB_INTERFACE', 2200); // web interface port
    
    //BOSSweb interface
    define('IP_BOSS_WEB_INTERFACE','10.177.154.49');//ip
    define('PORT_BOSS_WEB_INTERFACE',40001);//port
    
    //boss php server
    define('IP_GDT_PHPSERVER','10.130.3.49');//gdt php server ip
}
else if($_SERVER['CRM2_DEV'] == "t1")
{
    define('IP_USER_VERSION', '172.23.11.170');
    define('IP_TTC_SERVER', '172.23.10.110'); // ttc的ip
    define('IP_GROUPMSG_INFO', '10.133.8.178'); // 群发的svr
    define('IP_OIDIRTY_SERVER', '10.130.88.210'); // 脏词检查
    define('IP_TOKEN_LOG', '10.134.9.168'); // token的日志
    define('IP_TOKEN_SERVER', '10.177.154.50'); // token trans svr 服务器
    define('IP_ADD_KFFRIEND_SERVER', '10.134.9.200'); // 第三方加好友
    define('IP_REPORT_ANONYMOUS_IP', '10.130.89.28'); // 上报匿名聊天地理信息
    define('IP_PIC_NUM_STATIC', '10.130.88.175'); // 图片限制的访问
    define('IP_OPENAPI_SERVER', '10.134.9.143'); //第三方合作开发接口的后台服务器地址
    define('ID_ENV', 2); //环境ID 用于php server 代理 0 =》 开发机 1 => oa机 2 =》 运营机
    //define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
    define('IP_MOBILE_MSG_SERVER', '10.128.71.202'); // 发送短信的服务器，容灾备份机10.177.154.44
    define('IP_CRM_PHP_SERVER', '10.130.3.49'); // crm的PHPServer的ip
    //define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录

    // web interface接入。 后续新增ip往后增加，非特殊情况svr的接入都走web interface
    define('IP_WEB_INTERFACE', '10.177.154.43'); // web interface ip
    define('PORT_WEB_INTERFACE', 2200); // web interface port
}

//大客户环境配置
define('VIP_ENV_FLAG', $_SERVER['CRM2_DEV'] == "vip" || $_SERVER['CRM2_DEV'] == "vip_oa" ? true : false);    //大客户环境标识

// BOSS用
if('other' === $_SERVER['CRM2_DEV']) // 运营
{
    $GLOBALS['DBPROXY_ENV_IP'] = array(
        '0' => '172.23.183.33', // dev
        '1' => '10.128.1.53', // devnew
        '2' => '172.23.30.116', // oa
        '3' => '10.128.64.110', // gtest oa2 oa'
        '10000' => '10.134.9.146', // vipoa
        '11' => '10.130.89.28', // g1
        '12' => '10.130.87.100', // g2
        '5000' => '172.23.10.110', // t1
        '10001' => '10.134.9.200', // vip1
    );
}
else // 测试
{
    $GLOBALS['DBPROXY_ENV_IP'] = array(
    	'0' => '172.23.183.33', // dev
        '1' => '10.128.1.53', // devnew
        '2' => '172.23.30.116', // oa
        '3' => '10.128.64.110', // gtest oa2 oa'
        '10000' => '10.134.9.146', // vipoa
        '11' => '10.130.89.28', // g1
        '12' => '10.130.87.100', // g2
        '5000' => '172.23.10.110', // t1
        '10001' => '10.134.9.200', // vip1
    );
}

//端口配置
define('PORT_USER_VERSION', 5558);   //拉取好友版本号列表
define('PORT_SEND_GROUPMSG', 6668);  //群发服务器
define('PORT_SEND_GROUPMSG_PRE', 10114);  //预览群发服务器
define('PORT_SEND_SURVEY', 6692);    //调查服务器
define('PORT_GROUPMSG_INFO', 30002); //群发数据
define('PORT_OIDIRTY_SERVER', 36500);//脏词检查
define('PORT_ADD_KFFRIEND_SERVER', 21242);   //第三方加好友
define('PORT_REPORT_ANONYMOUS_IP', 40012);   //上报匿名聊天地理信息
define('PORT_PIC_NUM_STATIC', 20060); // 图片限制的访问端口
define('PORT_OPENAPI_SERVER', 14004); // 第三方合作开放接口后台服务器访问端口
define('PORT_MOBILE_MSG_SERVER', 33585); // 发送短信的服务器端口
define('PORT_CRM_PHP_SERVER', 14001); // crm的PHPServer的port
define('PORT_PIC_PHP_SERVER', 14003); // crm的PHPServer的port

define('PORT_GDT_PHPSERVER',19002);//boss php server的port

//页面安全性检查配置
define('LOGIN_CHECK_ENABLED', 1);       //登录检查
define('PARAM_CHECK_ENABLED', 1);		//参数检查
define('PERMISSION_CHECK_ENABLED', 1);  //权限检查


//WEB页面引用脚本版本号
define('JS_VERSION_MAIN', 2.1);
define('JS_VERSION_TOKEN_MAIN', 1);
define('JS_VERSION_INCREMENT', 2.1);
define('JS_VERSION_SETPASSWORD',1);
define('JS_VERSION_TOKEN_CALIBRATE',1);
define('JS_VERSION_TOKEN_MANAGER',1);
define('CSS_VERSION_MAIN', 2);
define('CSS_VERSION_TOKEN_MAIN', 1);
define('CSS_VERSION_INCREMENT', 3);
define('CSS_VERSION_SETPASSWORD',1);
define('CSS_VERSION_TOKEN_CALIBRATE',1);
define('CSS_VERSION_TOKEN_MANAGER',1);

//静态资源
//define('FILE_SERVER_ROOT', 'http://static.crm2.qq.com/');  	//文件服务器根目录
//define('WEB_STATIC_SERVER_ROOT', 'http://static.b.qq.com/');  	//静态资源根目录
define('WEB_COMBO_STATIC_ROOT','http://combo.b.qq.com/crm/clientpage/v211/');//当前版本静态资源目录
define('WEB_STATIC_SERVER_ROOT','http://cdn.b.qq.com/');//静态资源根目录

define('WEB_STATIC_SERVER_ROOT_OTHER_CRM','http://combo.b.qq.com/');//other crm静态资源根目录

//WEB调试标志
define('WEB_DEBUG_FLAG', 999);

//文件名称
//define('FILENAME_DIRTYWORDS', 'CRM_Dirty_Words.txt');     //敏感字列表，已废弃
define('FILENAME_NOAPPROVEUIN', 'CRM_No_ApproveUin.txt');  	//不需要审核的企业号码列表
define('FILENAME_USERINFOTOFIX', 'CRM_UserInfo_ToFix.txt'); //不需要动态修复好友资料的企业QQ号码文件

//审核企业资料类型定义
define('COMPANY_BASICINFO', 1);
define('COMPANY_QQSHOWINFO', 2);

//服务器保存文件路径
define('FILE_SAVE_MOD', 256);  								//文件存放目录按主号取模模值
define('FILE_UPLOAD_CONTROL', 'fdata');     				//客户端上传文件的控件名称
define('FILE_MAX_SIZE', 2 * 1024 * 1024);        			//上传文件最大size
define('FILE_SAVE_PATH', $_SERVER["CRM_ROOT"] . '/../webcrm_fileserver/fileserver/upload/');  	//文件服务器根目录
define('FILE_MNT_PATH', $_SERVER["CRM_ROOT"] . '/nfs/hy_qqversionlist/');     //后台服务器MNT的根目录
define('FILE_QQLIST_PATH', $_SERVER["CRM_ROOT"] . '/nfs/increment_qqlist/');  //后台服务器MNT的上传QQList文件目录

//服务器保存文件类型定义
define('FILETYPE_COMMON_FASTREPLY', 1);         //公共快捷回复
define('FILETYPE_COMMON_FASTREPLY_INDEX', 2);   //公共快捷回复顺序
define('FILETYPE_LOCAL_FASTREPLY', 3);          //个人快捷回复
define('FILETYPE_LOCAL_FASTREPLY_INDEX', 4);    //个人快捷回复顺序
define('FILETYPE_COMPANY_FACE', 5);				//企业头像
define('FILETYPE_COMPANY_TIPSICON', 6);			//企业TIPs图片
define('FILETYPE_QQLIST', 7);         			//qqlist文件
define('FILETYPE_COMPANY_FACE_SMALL', 8);		//企业缩略头像
define('FILETYPE_LOCATION_LIST', 101);    		//省市信息文件
define('FILETYPE_INDUSTRY_LIST', 102);			//行业信息文件

//LOG级别
define('LOG_LEVEL_RELEASE', 1);        //发布
define('LOG_LEVEL_DEBUG', 2);          //调试
define('LOG_LEVEL_TRACE', 3);    	   //详细跟踪
define('LOG_LEVEL', LOG_LEVEL_DEBUG);  //当前级别

// 审核群发
define('GMS_APPROVE_NEW', 0);  //新建
define('GMS_APPROVE_INTIME', 1);  //审批通过待发送
define('GMS_APPROVE_UNPASSED', 2);  //审批未通过
define('GMS_APPROVE_ONTIME', 3);  //发送中
define('GMS_APPROVE_WAITING_PASS', 4);  //创建（未审批）
define('GMS_APPROVE_SUCCESS', 5);  //成功
define('GMS_APPROVE_CANCEL', 6);  //用户取消
define('GMS_APPROVE_FAILED', 8);  //余额不足失败

//群发/调查状态、频率、类型、请求
define('GMS_NEW', 0);      //新建
define('GMS_SENDING', 4);  //未审批
define('GMS_SUCCESS', 5);  //成功
define('GMS_FAILED', 8);   //失败

define('GMS_SENDING_RATE', 4);  //每秒n条

// define('GMS_TO_FRIEND_ALL', 0);    //发给所有好友
define('GMS_TO_FRIEND_GROUPS', 0); //发给分组好友
define('GMS_TO_ADMIN', 1);         //发给管理员

define('GMS_RT_SENDGROUPMSG', 1);              //请求群发
define('GMS_RT_CALCULATEGROUPMSGNUMBER', 2);   //请求计算群发数
define('GMS_RT_TOPUP', 3);                     //请求充值
define('GMS_RT_GETCARDBALANCE', 4);            //请求群发卡余额
define('GMS_RT_SENDSURVEY', 5);                //请求调查
define('GMS_RT_GETSURVEYFEEDBACK', 6);         //请求调查反馈结果
define('GMS_RT_CANCEL', 7);         //取消群发
define('GMS_RT_SURVEY_CANCEL', 8);         //取消调查
define('GMS_RT_GET_LAST_GROUPMSG', 9); // 请求最近一条群发记录
define('GMS_RT_GET_LAST_SURVEY', 10); // 请求最近一条调查记录

define('EN_UNUSED_NUM', 0);  //不必填写内容，填0补位
define('EN_UNUSED_STR', ''); //不必填写内容，填空补位

//错误码定义
define('EN_SUCCESS', 0); 					//成功
define('EN_FAIL', 1); 						//失败
define('EN_TIMEOUT', 2); 					//超时
define('EN_PARAM_ERROR', 3); 				//请求参数错误
define('EN_NODATA', 4); 					//没有请求数据
define('EN_NOUPDATE', 5); 					//请求内容没有更新
define('EN_DIRTYWORDS', 6); 				//内容含有敏感字
define('EN_GROUPMSG_BALANCE_NOTENOUGH', 7); //群发余额不足
define('EN_GROUPMSG_CARDINFO_ERROR', 8); 	//卡号或卡密错误
define('EN_GROUPMSG_VCODE_ERROR', 9); 		//验证码错误
define('EN_KFUIN_NOTEXIST', 10); 			//主号不存在
define('EN_ERROR_DOMAIN', 11); 				//主号域名错误
define('EN_APPROVING', 12); 				//资料正在审核中
define('EN_FILE_FORMAT_ERROR', 13); 		//格式不对
define('EN_FILE_OVERSIZE', 14);  			//文件过大
define('EN_FILE_EXT_ERROR', 15); 			//类型不对
define('EN_FILE_CREATE_DIR_FAIL', 16); 		//新建目录失败
define('EN_FILE_NO_UPLOAD', 17); 			//没有上传文件
define('EN_FILE_UPEXT_ERROR', 18); 			//upext不正确
define('EN_GROUP_NAME_EXIST', 19); 			//分组名已经存在
define('EN_PART_SUCCESS', 20); 				//部分成功
define('EN_MAX_GROUP_NUMBER', 21);			//分组数目已达到最大值
define('EN_LOGIN_CHECK_FAIL', 22);			//登录检查失败
define('EN_PERMISSION_CHECK_FAIL', 23);		//权限检查失败
define('EN_ADMINQQ_CHECK_FAIL', 27);		//关联QQ检查失败
define('EN_QF_INCORRECT', 28);				//群发定时时间不正确
define('EN_NUMBER_LIMITED', 29);       		//次数受限
define('EN_INCORRECT_SN', 30);              // 无效的Token序列号
define('EN_TOKEN_BINDED', 31);              // 该令牌已经被绑定到其他工号
define('EN_TOKEN_NOTBINDED', 32);           // 帐号尚未绑定企业QQ令牌
define('EN_TOKEN_CODE_USED', 33);           // 动态密码已经使用过1次
define('EN_TOKEN_CODE_ERROR', 34);          // 动态密码错误
define('EN_TOKEN_UNBINDED', 35);            // 该令牌未被绑定到工号
define('EN_TOKEN_NEED', 36);                // 敏感操作需要验证token
define('EN_SET_SECURITY_HIGH_UNBIND', 37);  // 未绑定时设置安全等级为高
define('EN_UNBIND_SECURITY_HIGH', 38);      // 安全级别为高时主号做解绑操作
define('EN_NOT_CRM_TOKEN', 39);             // 非企业QQ的令牌
define('EN_QF_HAS_SENT', 40);               // 群发已经被其他工号发送
define('EN_DC_HAS_SENT', 41);               // 调查已经被其他工号发送
define('EN_TOKEN_NOT_OPEN', 42);            // 主号令牌关联尚未开启
define('EN_KFUIN_HAS_BIND_TOKEN', 43);      // 工号已经绑定Token
define('EN_CONTENT_FORMAT_ERROR', 44);      // 内容中含有xml非法字符
define('EN_NOT_LATEST_INFO', 45);      	    // 客户端设置资料的时间戳不是最新
define('EN_CAN_NOT_CANCEL', 46);      	    // 调查，群发无法取消，因为状态已被更改为不能取消状态
define('EN_BATCH_FRIEND_ERR_CODE', 47);           // 导好友通用错误信息
define('EN_LIXIAN_DOWNLOAD_EXPIRE', 48);    // 离线文件已经过期
define('EN_LIXIAN_DOWNLOAD_NOT_EXIST', 49);    // 离线文件不存在
define('EN_LIXIAN_MSG_INVALID', 50); // 离线短信，手机绑定的验证码无效
define('EN_LIXIAN_MSG_EXPIRE', 51); // 离线短信，手机绑定的验证码试用10次无效
define('EN_LIXIAN_MSG_CLOSE', 52); // 离线短信，暂时不开放
define('EN_LIXIAN_MSG_REQUEST_LIMIT', 53); // 请求过于频繁
define('EN_LIXIAN_MSG_NO_BIND', 54); // 没有绑定
define('EN_LIXIAN_MSG_NO_BIND', 55); // 已经绑定
define('EN_VISITOR_INVITED', 56); // 邀请会话失败，该访客已经邀请过
define('EN_TOKEN_BINDHIS_EXCEED',57);//令牌绑定达到历史最大值

//调用DBProxy、后台程序接口命令号
define('CMD_SEND_GROUPMSG', 0);
define('CMD_SEND_SURVEY', 1);              	   	//发送调查，弃用，走定时发送，不需要通知server
define('CMD_GET_SURVEY_FEEDBACK', 2);          	//获取调查结果
define('CMD_SEND_SURVEY_TO_ADMIN', 3);         	//获取调查预览
define('CMD_GET_SURVEY_STATUS', 4);            	//获取最后调查状态，弃用， 走DBProxy的cmd=40038的命令
define('CMD_GET_SURVEY_FEEDBACK_LIST', 5);     	//获取调查列表

define('CMD_CHECK_DIRTYWORD', 1);     			//检查敏感词
define('CMD_CHECK_DIRTYWORD_ACK', 3);     		//检查敏感词回包
define('CMD_CHECK_DIRTYURL', 2);     			//检查敏感URL
define('CMD_CHECK_DIRTYURL_ACK', 4);     		//检查敏感URL回包

define('CMD_GET_USER_VERSION_LIST', 1);     	//拉取好友资料版本号列表

define('CMD_GET_WAITCASE', 49);					//拉取未接入会话列表

define('CMD_GET_QQHYGROUP_INFO', 10000);		//拉取普通qq好友分组信息
define('CMD_BATCH_IMPORT_HY', 10001); 			//批量导入好友

define('CMD_GET_COMPANY_STATUS_CONFIG', 10011);	//拉取在线状态配置
define('CMD_GET_COMPANY_WELCOME_INFO', 10012);	//拉取自动欢迎语
define('CMD_GET_COMPANY_AUTOREPLY_INFO', 10013);//拉取自动回复语
define('CMD_GET_ROLE_INFO', 10014);				//拉取角色信息
define('CMD_GET_KFEXTGROUP_INFO', 10015);		//拉取工号分组信息
define('CMD_GET_KFEXT_INFO', 10016);			//拉取工号信息
define('CMD_GMS_GET_FRIENDGROUP_LIST', 10017);	//拉取好友分组列表
define('CMD_GMS_CHECK_GROUPMSG_STATUS', 10018);	//拉取群发状态
define('CMD_GMS_GET_GROUPMSG_NUMBER', 10019);	//计算群发条数
define('CMD_GET_COMPANY_INFO', 10020);			//拉取企业资料
define('CMD_GET_COMPANY_CONTACT_INFO', 10021);	//拉取企业联系人资料
define('CMD_GMS_GET_GROUPMSG_BALANCE', 10022);	//拉取群发余额
define('CMD_GMS_GET_CARDBALANCE', 10025);		//拉取群发卡余额
define('CMD_GET_COMPANY_INFO_APPROVE', 10026);	//拉取审核中的企业信息
define('CMD_GET_HYGROUP_INFO',10027);			//拉取好友分组请求
define('CMD_GET_BASE_USERINFO', 10030);			//拉取好友基本资料
define('CMD_GET_DETAIL_USERINFO', 10031);		//拉取好友详细资料
define('CMD_GET_FBASEFLAG', 10036); 			//拉取客服信息表中的FBaseFlag
define('CMD_GET_APPOINTED_KF', 10038);			//拉取指定客服信息
define('CMD_GET_EXCLUSIVE_KF', 10039);			//拉取独占客服信息
define('CMD_GET_LAST_SURVEY', 10041);			//拉取最近一条调查记录
define('CMD_GET_TOKEN_TYPE', 10057);           // 判断是否为企业令牌
define('CMD_DELETE_HYGROUP_INFO',20011);		//删除好友分组请求
define('CMD_NEW_HYGROUP_INFO', 30011);			//新建好友分组请求
define('CMD_SET_COMPANY_STATUS_CONFIG', 40011);	//设置企业在线状态
define('CMD_SET_COMPANY_WELCOME_INFO', 40012);	//设置自动欢迎语
define('CMD_SET_COMPANY_AUTOREPLY_INFO', 40013);//设置自动回复语
define('CMD_SET_ROLE_INFO', 40014);				//设置角色信息
define('CMD_SET_KFEXTGROUP_INFO', 40015);		//设置工号分组
define('CMD_SET_KFEXT_INFO', 40016);			//设置工号信息
define('CMD_GMS_TOPUP_GROUPMSG', 40017);		//群发充值
define('CMD_GMS_INSERT_GROUPMSG_RECORD', 40018);//创建群发记录
define('CMD_GMS_CHARGE_GROUPMSG', 40019);		//群发扣费
define('CMD_SET_COMPANY_INFO', 40020);			//设置企业资料
define('CMD_SET_COMPANY_CONTACT_INFO', 40021);	//设置企业联系人资料
define('CMD_SET_COMPANY_INFO_APPROVE', 40022);	//提交企业资料审核
define('CMD_RENAME_HYGROUP_INFO', 40023);		//更新好友分组请求
define('CMD_APPROVE', 40024);					//审核通过
define('CMD_COMPANY_SET_SUPERPASS', 40025);		//设置超级密码
define('CMD_COMPANY_SET_EXTPASS', 40026);		//设置工号密码
define('CMD_COMPANY_SET_OTHERPASS', 40027);		//设置其它工号密码
define('CMD_SET_DETAIL_USERINFO', 40028);		//设置好友详细信息
define('CMD_SET_BASE_USERINFO', 40029);			//设置好友基本信息
define('CMD_SET_FBASEFLAG', 40030); 			//设置客服信息表中的FBaseFlag
define('CMD_GMS_INSERT_SURVEY_RECORD', 40031);	//设置其它工号密码
define('CMD_SET_APPOINTED_KF', 40032);			//设置指定客服信息
define('CMD_SET_EXCLUSIVE_KF', 40033);			//设置独占客服信息
define('CMD_RESET_SUPER_PWD', 40034);			//Boss系统重置超级密码
define('CMD_RESET_ADMIN_PWD', 40035);			//Boss系统重置1001工号密码
define('CMD_MODIFY_EXPIRATION_TIME', 40036);     // Boss系统修改过期时间
define('CMD_CANCEL_QF', 40037);                  // 取消群发
define('CMD_CANCEL_DC', 40038);                  // 取消群发

define('CMD_CONVERT_KFUIN_TO_800_NAME', 6);      // 主号转化成 800/400 靓号
define('CMD_CONVERT_800_NAME_TO_KFUIN', 7);      // 800/400 靓号 转化成主号

define('CMD_CHECK_DIRTY_WORD', 1);           	//检查敏感词
define('CMD_CHECK_DIRTY_URL', 2);				//检查敏感URL

define('CMD_REPORT_ANONYMOUS_IP', 0);           //上报匿名聊天地理信息

//提供Boss CGI系统配置
define('APPROVE_SUCCESS', 1);
define('APPROVE_FAILED', 0);
define('PWD_TYPE_SUPER', 0);
define('PWD_TYPE_ADMIN', 1);
$GLOBALS['IP_BOSSSERVER'] = array("172.23.30.15", "172.16.1.238", "10.8.1.68", "10.8.1.100", "10.130.88.175", "10.130.88.210", "172.27.192.252"); //BOSS服务器IP

//企业账户中心 CGI系统配置
$GLOBALS['IP_ACSERVER'] = array("10.133.3.149", "10.185.3.77", "121.14.79.74","121.14.78.249","112.90.141.64", "112.90.141.62", "10.133.8.176", "10.130.88.175", "172.27.192.252", "10.128.70.46", "10.130.3.49"); //企业账户中心服务器IP

//?????
define('CRM_LOGIN_KEY', '0123456789abcdef');

/*版本号*/
$GLOBALS['crm_js_version'] = JS_VERSION_MAIN;
$GLOBALS['crm_css_version'] = CSS_VERSION_MAIN;

// CRM1.0 Tip 图片同步路径
define('CRM1_FACE_PIC_FOR_PORTAL_PATH', '/data/wwwroot/htdocs/logo/');


$GLOBALS['crm_support_image_format'] = array(
	"jpg" => 1,
	"jpeg" => 1,
	"bmp" => 1,
	"png" => 1,
	"gif" => 1,
);

// 群发图片表情相关
$GLOBALS['CRM_FACE'] = array(
    'text' => array('/微笑', '/撇嘴', '/色', '/发呆', '/得意', '/流泪', '/害羞', '/闭嘴', '/睡', '/大哭', '/尴尬', '/发怒', '/调皮', '/呲牙', '/惊讶', '/难过', '/酷', '/冷汗', '/抓狂', '/吐', '/偷笑', '/可爱', '/白眼', '/傲慢', '/饥饿', '/困', '/惊恐', '/流汗', '/憨笑', '/大兵', '/奋斗', '/咒骂', '/疑问', '/嘘', '/晕', '/折磨', '/衰', '/骷髅', '/敲打', '/再见', '/擦汗', '/抠鼻', '/鼓掌', '/糗大了', '/坏笑', '/左哼哼', '/右哼哼', '/哈欠', '/鄙视', '/委屈', '/快哭了', '/阴险', '/亲亲', '/吓', '/可怜', '/菜刀', '/西瓜', '/啤酒', '/篮球', '/乒乓', '/咖啡', '/饭', '/猪头', '/玫瑰', '/凋谢', '/示爱', '/爱心', '/心碎', '/蛋糕', '/闪电', '/炸弹', '/刀', '/足球', '/瓢虫', '/便便', '/月亮', '/太阳', '/礼物', '/拥抱', '/强', '/弱', '/握手', '/胜利', '/抱拳', '/勾引', '/拳头', '/差劲', '/爱你', '/NO', '/OK', '/爱情', '/飞吻', '/跳跳', '/发抖', '/怄火', '/转圈', '/磕头', '/回头', '/跳绳', '/挥手', '/激动', '/街舞', '/献吻', '/左太极', '/右太极'),
    'hex' => array(   0x4f,     0x42,     0x43,  0x44,      0x45,    0x46,     0x47,    0x48,      0x49,   0x4a,     0x4b,    0x4c,     0x4d,    0x4e,      0x41,     0x73,    0x74,   0xa1,     0x76,     0x77,   0x8a,     0x8b,    0x8c,     0x8d,     0x8e,    0x8f,   0x78,     0x79,     0x7a,     0x7b,     0x90,     0x91,     0x92,    0x93,   0x94,   0x95,    0x96,    0x97,    0x98,     0x99,     0xa2,     0xa3,     0xa4,    0xa5,       0xa6,      0xa7,       0xa8,      0xa9,     0xaa,     0xab,     0xac,      0xad,      0xae,    0xaf,   0xb0,     0xb1,     0x61,     0xb2,    0xb3,     0xb4,     0x80,    0x81,   0x7c,     0x62,     0x63,     0x64,     0x65,    0x66,     0x67,     0x9c,     0x9d,     0x9e,   0x5e,    0xb6,      0x89,    0x6e,     0x6b,     0x68,     0x7f,    0x6f,   0x70,   0x88,     0xa0,     0xb7,    0xb8,     0xb9,     0xba,    0xbb,     0xbc,   0xbd,   0x5c,     0x56,     0x58,     0x5a,     0x5b,    0xbe,     0xbf,     0xc0,     0xc1,     0xc2,     0xc3,    0xc4,    0xc5,      0xc6,       0xc7,),
    'bin' => array(),
);

// TLV Tag Type
define('TLV_TAG_TYPE_SIGNED_INT', 1);
define('TLV_TAG_TYPE_UNSIGNED_INT', 2);
define('TLV_TAG_TYPE_STRING', 3);
define('TLV_TAG_TYPE_ARRAY', 4);
define('TLV_TAG_TYPE_OTHER', 5);
define('TLV_TAG_TYPE_SIGNED_8BIT_ARRAY', 6);
define('TLV_TAG_TYPE_SIGNED_16BIT_ARRAY', 7);
define('TLV_TAG_TYPE_SIGNED_32BIT_ARRAY', 8);
define('TLV_TAG_TYPE_SIGNED_64BIT_ARRAY', 9);
define('TLV_TAG_TYPE_UNSIGNED_8BIT_ARRAY', 10);
define('TLV_TAG_TYPE_UNSIGNED_16BIT_ARRAY', 11);
define('TLV_TAG_TYPE_UNSIGNED_32BIT_ARRAY', 12);
define('TLV_TAG_TYPE_UNSIGNED_64BIT_ARRAY', 13);


//encode define
define('ENCODE_UTF_8', 0);
define('ENCODE_GBK', 1);

// pack & unpack format code
define('F_NULL_PADDED_STRING', 'a'); // NUL-padded string
define('F_SPACE_PADDED_STRING', 'A'); // SPACE-padded string
define('F_LOW_NIBBLE_HEX_STRING', 'h'); // Hex string, low nibble first
define('F_HIGH_NIBBLE_HEX_STRING', 'H'); // Hex string, high nibble first
define('F_SIGNED_CHAR', 'c'); // signed char
define('F_UNSIGNED_CHAR', 'C'); // unsigned char
define('F_MO_SIGNED_SHORT', 's'); // signed short (always 16 bit, machine byte order)
define('F_MO_UNSIGNED_SHORT', 'S'); // unsigned short (always 16 bit, machine byte order)
define('F_BE_UNSIGNED_SHORT', 'n'); // unsigned short (always 16 bit, big endian byte order)
define('F_LE_UNSIGNED_SHORT', 'v'); // unsigned short (always 16 bit, little endian byte order)
define('F_MO_SIGNED_INTEGER', 'i'); // signed integer (machine dependent size and byte order)
define('F_MO_UNSIGNED_INTEGER', 'I'); // unsigned integer (machine dependent size and byte order)
define('F_MO_SIGNED_LONG', 'l'); // signed long (always 32 bit, machine byte order)
define('F_MO_UNSIGNED_LONG', 'L'); // unsigned long (always 32 bit, machine byte order)
define('F_BE_UNSIGNED_LONG', 'N'); // unsigned long (always 32 bit, big endian byte order)
define('F_LE_UNSIGNED_LONG', 'V'); // unsigned long (always 32 bit, little endian byte order)
define('F_MO_FLOAT', 'f'); // float (machine dependent size and representation)
define('F_MO_DOUBLE', 'd'); // double (machine dependent size and representation)
define('F_NULL', 'x'); // NUL byte
define('F_BACK', 'X'); // Back up one byte
define('F_NULL_FILL', '@'); // NUL-fill to absolute position
define('F_ARRAY', 'array'); // our defined array
define('F_UNSIGNED_LONG_64', 'un64'); // unsigned 64bit int
define('F_SIGNED_LONG_64', 'n64'); // signed 64bit int
define('F_SIGNED_8BIT_ARRAY', '8bit_array');
define('F_SIGNED_16BIT_ARRAY', '16bit_array');
define('F_SIGNED_32BIT_ARRAY', '32bit_array');
define('F_SIGNED_64BIT_ARRAY', '64bit_array');
define('F_UNSIGNED_8BIT_ARRAY', 'u_8bit_array');
define('F_UNSIGNED_16BIT_ARRAY', 'u_16bit_array');
define('F_UNSIGNED_32BIT_ARRAY', 'u_32bit_array');
define('F_UNSIGNED_64BIT_ARRAY', 'u_64bit_array');

// tag range value define
define('TLV_TAG_SIGNED_INT_VALUE_BEGIN', 1); // signed int begin
define('TLV_TAG_SIGNED_INT_VALUE_END', 30); // signed int end
define('TLV_TAG_UNSIGNED_INT_VALUE_BEGIN', 31); // unsigned int begin
define('TLV_TAG_UNSIGNED_INT_VALUE_END', 130); // unsigned int end
define('TLV_TAG_STRING_VALUE_BEGIN', 131); // string begin
define('TLV_TAG_STRING_VALUE_END', 200); // string end
define('TLV_TAG_ARRAY_VALUE_BEGIN', 201); // array begin
define('TLV_TAG_ARRAY_VALUE_END', 230); // array end
define('TLV_TAG_SIGNED_8BIT_ARRAY_VALUE', 231);
define('TLV_TAG_SIGNED_16BIT_ARRAY_VALUE', 232);
define('TLV_TAG_SIGNED_32BIT_ARRAY_VALUE', 233);
define('TLV_TAG_SIGNED_64BIT_ARRAY_VALUE', 234);
define('TLV_TAG_UNSIGNED_8BIT_ARRAY_VALUE', 235);
define('TLV_TAG_UNSIGNED_16BIT_ARRAY_VALUE', 236);
define('TLV_TAG_UNSIGNED_32BIT_ARRAY_VALUE', 237);
define('TLV_TAG_UNSIGNED_64BIT_ARRAY_VALUE', 238);
define('TLV_TAG_OTHER_VALUE_BEGIN', 239); // other begin
define('TLV_TAG_OTHER_VALUE_END', 255); // other end

// sequence begin range value
define('SEQ_SIGNED_INT_VALUE_BEGIN', 0);
define('SEQ_UNSIGNED_INT_VALUE_BEGIN', 30);
define('SEQ_STRING_VALUE_BEGIN', 130);
define('SEQ_ARRAY_VALUE_BEGIN', 200);

// tlv CMD_FLAG_BEGIN & CMD_FLAG_END
define('CMD_FLAG_BEGIN', 0x1FCA55AB);
define('CMD_FLAG_END', 0x2CBD8996);

// 敏感词 敏感ur相关定义
define('DIRTY_WORD_LEVEL_ONE', 1);
define('DIRTY_WORD_LEVEL_TWO', 2);
define('DIRTY_WORD_LEVEL_THREE', 3);

define('DIRTY_URL_LEVEL_ZERO', 0);
define('DIRTY_URL_LEVEL_ONE', 1);
define('DIRTY_URL_LEVEL_TWO', 2);

define('DIRTY_MODULE_QF', 1);
define('DIRTY_MODULE_DC', 2);
define('DIRTY_MODULE_QF_BOSS', 3);
define('DIRTY_MODULE_DC_BOSS', 4);
define('DIRTY_MODULE_QF_SVR', 5);
define('DIRTY_MODULE_DC_SVR', 6);
define('DIRTY_MODULE_KFSHOW', 7);
define('WPA_MODULE_COUNT', 8);
define('COMMON_MODULE_MONITOR', 9);
define('WPA_MODULE_COUNT_PAIPAI', 10);
define('WPA_MODULE_LOADING', 11);
/* 企业互通查找企业上报 */
define('ENT_COM_SEARCH', 12);

class CRMMonitorConst
{
	const CMD = 1;
	const SUB_CMD = 0;
	const KFUIN = 938065861;
	const KFEXT = 1001;
	const EXTUIN = 1495009688;

    const TYPE_ADD = 0;
    const TYPE_SET = 1;
    const TYPE_MSG = 2;

    const PTLOGIN_JUMP_SUCCESS = 117833;            //Ptlogin跳转成功
    const PTLOGIN_JUMP_FAIL = 117834;               //Ptlogin跳转失败
    const PTLOGIN_VERIFY_SUCCESS = 117835;          //Ptlogin验证skey成功
    const PTLOGIN_VERIFY_FAIL = 117836;             //Ptlogin验证skey失败，细化为以下四种情况：
    const VERIFY_EMPTY_COOKIE = 104055;             //verify 时候cookie中uin或者skey失败
    const VERIFY_FAILED = 104056;                   //verify 时候校验失败
    const VERIFY_GET_QQUIN_FAILED = 104057;         //verify 获取企业工号对应QQ号失败
    const VERIFY_QQUIN_UNEQ_COOKIEUIN = 104058;     //verify QQ号不等于COOKIE中QQ号
    const TOKEN_GET_SKEY_SUCCESS = 117837;          //获取Token卡skey成功
    const TOKEN_GET_SKEY_FAIL = 117838;             //获取Token卡skey失败
    const TOKEN_VERIFY_SUCCESS = 117839;            //登录验证Token卡通过
    const TOKEN_VERIFY_FAIL = 117840;               //登录验证Token卡失败
    const TOKEN_BIND_VERIFY_SUCCESS = 117841;       //绑定前验证Token卡通过
    const TOKEN_BIND_VERIFY_FAIL = 117842;          //绑定前验证Token卡失败
    const TOKEN_BIND_SUCCESS = 117843;              //绑定Token卡成功
    const TOKEN_BIND_FAIL = 117844;                 //绑定Token卡失败
    const TOKEN_UNBIND_SUCCESS = 117845;            //解绑Token卡成功
    const TOKEN_UNBIND_FAIL = 117846;               //解绑Token卡失败
    const TOKEN_CHANGE_SUCCESS = 117847;            //更换Token卡成功
    const TOKEN_CHANGE_FAIL = 117848;               //更换Token卡失败
    const DIRTY_CHECK_SUCCESS = 117849;             //敏感词检查调用成功
    const DIRTY_CHECK_FAIL = 117850;                //敏感词检查调用失败
    const DIRTY_CHECK_HIT = 117851;                 //敏感词检查命中
	const USERINFO_GET_GROUP_SUCCESS = 118210; 		//拉取好友分组成功
	const USERINFO_GET_GROUP_FAIL = 118211; 		//拉取好友分组失败
	const USERINFO_GET_VERSION_SUCCESS = 118212; 	//拉取版本号列表成功
	const USERINFO_GET_VERSION_FAIL = 118213;		//拉取版本号列表失败
	const USERINFO_GET_BASE_SUCCESS = 118214;		//拉取简单资料成功，保留
	const USERINFO_GET_BASE_FAIL = 118215;			//拉取简单资料失败，保留
	const USERINFO_GET_DETAIL_SUCCESS = 118216;		//拉取详细资料成功，保留
	const USERINFO_GET_DETAIL_FAIL = 118217;		//拉取详细资料失败，保留
	const MSG_SEND_CLICK_NUM = 139094;		//点击“创建群发”的次数
	const MSG_MODIFY_AND_RESEDNG_CLICK_NUM = 139095;		//点击“修改并重新发送”的次数
	const MSG_MODIFY_CLICK_NUM = 139096;		//点击“立即修改”的次数
	const MSG_REFRESH_CLICK_NUM = 139097;		//点击“刷新”的次数
	const MSG_CANCEL_CLICK_NUM = 139098;		//点击“取消群发”的次数
	const MSG_RESEND_CLICK_NUM = 139115;		//点击“重新发送”的次数

    const MONITOR_IP = '127.0.0.1';
    const MONITOR_PORT = 2013;
}

// token操作常量
class CRMTokenConst
{
    const QTKN_SRV_PORT = 32102; // token svr 端口

    const CMD_GET_KF_TOKEN_STATUS = 10045; // 得到Token验证所需要的信息，包括主号关联状态，主号业务状态，工号Token状态，工号Token序列号
    const CMD_GET_KF_INFO_STATUS_BY_SN = 10047; // 根据sn获得绑定的主号工号
    const CMD_BIND_TOKEN = 40039; // token绑定
    const CMD_UNBIND_TOKEN = 40040; // token解绑
    const CMD_SET_KFUIN_TOKEN_STATUS = 40041; // 设置主号Token相关字段信息，包括主号关联状态，主号业务状态
    const CMD_SET_KFEXT_TOKEN_STATUS = 40042; // 设置工号Token相关字段信息，包括工号绑定状态，工号绑定的sn
    const CMD_CHANGE_TOKEN = 40043; // token更换
    const CMD_UPDATE_TOKEN_TIME = 40046; // token校准
    const CMD_GET_TOKEN_TYPE = 10057; // 判断是否为企业令牌

    const QTKN_OP_VERIFY_PREBIND_REQ = 109; // token操作标识：绑定前验证
    const QTKN_OP_VERIFY_REQ = 110; // token操作标识：绑定后验证
    const SEC_SAFE_SYSID_QQTOKEN = 41; // qq令牌

    const PKG_MAGIC_BEGIN = 0x02; // token请求包的包头开始标识
    const PKG_MAGIC_END = 0x03; // token请求包的包头结束标识

    const OP_TOKEN_VERIFY = 1; // token验证操作标识
    const OP_TOKEN_BIND = 2; // token绑定操作标识
    const OP_TOKEN_UNBIND = 3; // token解绑操作标识
    const OP_TOKEN_CHANGE = 4; // token更换操作标识

    const TYPE_VERIFY = 0; // 绑定后验证的打包标识
    const TYPE_PREBIND_VERIFY = 1; // 绑定前验证的打包

    const STATUS_SUPER = 0; // 超级态
    const STATUS_UNBIND = 1; // 未绑定
    const STATUS_BIND = 2; // 已绑定

    const SECURITY_LEVEL_LOW = 0; // 安全等级低
    const SECURITY_LEVEL_MEDIUM = 1; // 安全等级中
    const SECURITY_LEVEL_HIGH = 2; // 安全等级高

    const ASSOCIATE_STATUS_OPEN = 1; // 主号关联开关开
    const ASSOCIATE_STATUS_CLOSED = 0; // 主号关联开关关

    const SET_ASSOCIATE = 0x01; // 设置关联开关
    const SET_SECURITY_LEVEL = 0x02; // 设置安全级别
    const SET_ASSOCIATE_AND_SECURITY_LEVEL = 0x03; // 设置关联开发和安全级别

    const UNBIND_TYPE_DEFAULT = 0; // 解绑类型 默认0 以后扩充

    /* token卡的log */
    const TOKEN_LOG_BOSS = 1;       //token的log来源是crm
    const TOKEN_LOG_CRM = 2;       //token的log来源是crm
    const TOKEN_LOG_WEB = 3;       //token的log来源是b.qq.com

    const TOKEN_LOG_CHANGE = 250;          // 更换token卡
    const TOKEN_LOG_BIND = 251;          // 绑定token卡
    const TOKEN_LOG_UNBIND = 252;        // 解绑token卡
    const TOKEN_LOG_SUPER = 253;         // 工号1001设置超级态
    const TOKEN_LOG_UNSUPER = 254;       // 工号1001取消超级态
    const TOKEN_LOG_SAFETY_LEVEL = 255;  // 设置安全级别

    const ENCRYPTION_KEY = '_9f1s_0&R3Ad2!#Z'; // skey加密的密钥

    const DBPROXY_TYPE = 0; // DBPROXY
    const MYSQL_TYPE = 1; // MYSQL

    const EN_TLV_PACK_FAIL = 1; // tlv pack出错
    const EN_UDP_SOCKET_FAIL = 2; // udp socket 出错
    const EN_TLV_UNPACK_FAIL = 3; // tlv unpack出错

    const SET_SUPPER_STATUS = 0; // 设置超级态
    const CANCEL_SUPPER_STATUS = 1; // 取消超级态
}

//大客户配置
define('VIP_BizID_CRM', '1002');
define('VIP_BizID_MeiLinKai', '2');
define('VIP_BizID_DX', '10');
define('VIP_BizID_DX_TEST', '1003');
define('VIP_BizID_IMC', '11');
define('VIP_BizID_GX', '12');
define('VIP_BizID_GX_TEST1', '1011');
define('VIP_BizID_GX_TEST2', '1012');
define('VIP_BizID_GX_TEST3', '1013');
define('VIP_BizID_GX_TEST4', '1014');
define('VIP_BizID_GX_TEST5', '1015');
define('VIP_BizID_IMC_DEV', '1016');
define('VIP_BizID_IMC_OA', '1017');
define('VIP_BizID_GHZQ', '13');
define('VIP_BizID_QQ114', '15');
define('VIP_BizID_PingAn', '21');
$GLOBALS['VIP_CONFIG']= array(
    VIP_BizID_CRM => array(
            'uin' => '938075245',
            'url' => 'http://crm2.qq.com/page/vippage/aio_test.html',
            'key' => '',
            'ip'  => ''
    ),
    VIP_BizID_PingAn => array(
            'uin' => '938048186',
            'url' => 'http://stg.pa18.com/ebusiness/auto/partner/qq/pingan_proxy.html',
            'key' => '',
            'ip'  => ''
    ),
    VIP_BizID_MeiLinKai => array(
            'uin' => '',
            'url' => 'http://www.meikailin.com/page/vippage/test_addfriend.htm',
            'key' => '',
            'ip'  => ''
    ),
    VIP_BizID_DX => array(
            'uin' => '800010000',
            'url' => 'http://im.189.cn/qkf/',
            'key' => '',
            'ip'  => ''
    ),
    VIP_BizID_DX_TEST => array(
            'uin' => '1530552248',
            'url' => 'http://im.189.cn/qkf/',
            'key' => '',
            'ip'  => ''
    ),
    VIP_BizID_IMC => array(
            'uin' => '40012345',
            'url' => 'http://kf.qq.com/im/imc/mini_imc_sidebar.html',
            'key' => '',
            'ip'  => ''
    ),
    VIP_BizID_GX => array(
            'uin' => '1835997760',
            'url' => 'http://183.62.138.121:18080/qq/proxy.htm',
            'key' => '',
            'ip'  => ''
    ),
	VIP_BizID_GX_TEST1 => array(
            'uin' => '2453288157',
            'url' => 'http://qq.im-cc.com/interface/distrubite1',
            'key' => '',
            'ip'  => ''
    ),
	VIP_BizID_GX_TEST2 => array(
            'uin' => '2660425417',
            'url' => 'http://qq.im-cc.com/interface/distrubite2',
            'key' => '',
            'ip'  => ''
    ),
	VIP_BizID_GX_TEST3 => array(
            'uin' => '1874368479',
            'url' => 'http://qq.im-cc.com/interface/distrubite3',
            'key' => '',
            'ip'  => ''
    ),
	VIP_BizID_GX_TEST4 => array(
            'uin' => '2579010347',
            'url' => 'http://qq.im-cc.com/interface/distrubite4',
            'key' => '',
            'ip'  => ''
    ),
	VIP_BizID_GX_TEST5 => array(
            'uin' => '2691650150',
            'url' => 'http://qq.im-cc.com/interface/distrubite5',
            'key' => '',
            'ip'  => ''
    ),
    VIP_BizID_IMC_DEV => array(
        'uin' => '1103277150',
        'url' => 'http://kf.qq.com/im/imc/mini_imc_selfhelp.html',
        'key' => '',
        'ip'  => ''
    ),
    VIP_BizID_IMC_OA => array(
        'uin' => '954489912',
        'url' => 'http://kf.qq.com/im/imc/mini_imc_selfhelp.html',
        'key' => '',
        'ip'  => ''
    ),
    VIP_BizID_GHZQ => array(
        'uin' => '800095563',
        'url' => 'http://qq.ghzq.com.cn',
        'key' => '',
        'ip'  => ''
    ),
    VIP_BizID_QQ114 => array(
        'uin' => '800000114',
        'url' => 'http://qq114.sz118114.com/trans',
        'key' => '',
        'ip'  => ''
    ),
);

/** 第三方合作开发接口相关常量 **/
define('OPENAPI_TLV_TIMEOUT', 4); //向后台发包超时时间
define('COMMON_ENCODE_KEY', '9_&Afs_B#1!KR3*d'); //通用加密密钥

// ta搜索引擎对应关系
$GLOBALS['TA_SEO_CONF'] = array(
    '1' => '谷歌',
    '2' => '搜搜',
    '3' => '百度',
    '4' => '搜狗',
    '5' => '雅虎',
    '6' => '微软必应',
    '7' => '网易有道',
    '8' => '狗狗',
);

?>