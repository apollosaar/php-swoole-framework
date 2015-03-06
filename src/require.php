<<<<<<< HEAD
<?php

// 定义SRC根目录
define('SRCPATH', dirname( __FILE__ ));
//auto_load
require_once SRCPATH . '/auto_load.php';
// //pb body file
// require_once SRCPATH . '/data/pb_proto_tencent.crm.spkey.php';
// //pb head file
// require_once SRCPATH . '/data/pb_proto_tencent.crm.test.head.php';
//udp server
require_once SRCPATH . '/serv/testUdpServ.php';
// //weblib
// require_once SRCPATH . '/weblib/require.php';
=======
<?php

// 定义SRC根目录
define('SRCPATH', dirname( __FILE__ ));

require_once SRCPATH . '/components/Controller.php';
require_once SRCPATH . '/serv/testHttpServ.php';



>>>>>>> 8964ab60c5a38870a8babcb47897ff5bcd2f23e1
