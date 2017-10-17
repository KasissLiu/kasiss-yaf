<?php

/**
 * @author kasiss
 * @date Jul 24, 2016
 * demo
 * 注册的本地类库 按照 文件夹_..._文件命名
 */
namespace Model;


class Sample
{
    //注册一个获取数据表实例的方法，可以统一从此处调用
    public static function getSampleTable()
    {
        return new \Db\Sample();
    }
    //业务逻辑 处理方法
    public static function indexSample()
    {
        $db = self::getSampleTable(); //获取数据表操作实例
        $data = $db->get_data();    //调用具体db层方法 对数据库内数据进行操作
        return $data;   //返回数据
    }
}