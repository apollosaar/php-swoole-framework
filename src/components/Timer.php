<?php
/**
 * @Author: winterswang
 * @Date:   2015-03-04 16:20:14
 * @Last Modified by:   winterswang
 * @Last Modified time: 2015-03-05 09:55:55
 */

class Timer {

	public static $timerArr = array();
	public static $countArr = array();

	/**
	 * [addTimer 添加定时器捆绑，同一个时间间隔，只需绑定一个函数]
	 * @param [type] $interval [description]
	 * @param array  $class    [description]
	 */
	public static function addTimer($interval,$class = array()){
		// 查找是否已存在关键字，没有就加入
		if (array_key_exists($interval, self::$timerArr)) {
			return false;
		}
		self::$timerArr[$interval] = $class;
		self::$countArr[$interval] = 0;
	}

	/**
	 * [delTimer 删除定时器捆绑，删除的是时间点和函数的映射关系，定时器的删除不在这里]
	 * @param  [type] $interval [description]
	 * @return [type]           [description]
	 */
	public static function delTimer($interval){
		// 查找是否已存在关键字，有就删除
		if (! array_key_exists($interval, self::$timerArr)) {
			return false;
		}
		unset(self::$timerArr[$interval]);
		unset(self::$countArr[$interval]);
	}

	/**
	 * [getFun 获取当前定时器时间间隔下的回调函数]
	 * @param  [type] $interval [description]
	 * @return [type]           [description]
	 */
	public static function getFun($interval){
		// 查找是否已存在关键字，有就返回
		if (array_key_exists($interval, self::$timerArr)) {
			$cc = self::$timerArr[$interval];
			if (is_object($cc[0]) && method_exists($cc[0], $cc[1])) {
				self::$countArr[$interval] ++;
				return $cc;
			}
		}
		return false;
	}

	public static function getCount($interval){
		return self::$countArr[$interval];
	}
}
?>