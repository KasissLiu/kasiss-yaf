<?php

/**
 * @author kasiss
 * @date Jul 24, 2016
 * 注册的本地类库 按照 文件夹_..._文件命名
 */

namespace Db;

class Sample
{
    private $db = null;
    private $tbl_name = '';//注册 数据表名称
    
    public function __construct()
    {
        $this->db= \Server::get(\Server::mysql); //获取数据库链接实例
    }
    
    
    public function get_data()
    {
        return "Yaf!";
    }
    
}