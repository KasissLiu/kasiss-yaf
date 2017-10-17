<?php

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:\Yaf\Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends \Yaf\Bootstrap_Abstract{   

    /**
     * 初始化一些必要的常量
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initSysConst(\Yaf\Dispatcher $dispatcher)
    {
        $config_const = new \Yaf\Config\Ini(APP_PATH . '/conf/application.ini','const');
        $consts = $config_const->const->toArray();
        foreach($consts as $key=>$val)
        {
            !defined($key) && define($key, $val);
        }
    }
    
	/**
	 * 定义本地类库路径，并注册本地类前缀以实现自动加载
	 * 由于文档不完整，目前只找到这唯一一种定义本地类库的方法
	 * @return [type] [description]
	 */
	public function _initRegisterLocalNamespace(\Yaf\Dispatcher $dispatcher)
	{
		$loader = \Yaf\Loader::getInstance();
		$loader->setLibraryPath(APP_APPLICATION.'/locallibrary');
		$loader->registerLocalNamespace(array("Model","Db"));
		 
	}
	
	
	/**
	 * 初始化加载composer包管理内的类
	 */
	public function _initLoadComposer(\Yaf\Dispatcher $dispatcher)
	{   
	    if(file_exists(APP_PATH."/vendor/autoload.php"))
            include_once (APP_PATH."/vendor/autoload.php"); 
	}
	
	/**
	 * 注册插件
	 * @param \Yaf\Dispatcher $dispatcher
	 */
    public function _initPlugin(\Yaf\Dispatcher $dispatcher)
    {   
        
        //注册默认行为插件
        $InitDefaultPlugin = new InitDefaultPlugin();
        $dispatcher->registerPlugin($InitDefaultPlugin);
        
        //注册Smarty插件
        $InitSmartyPlugin = new InitSmartyPlugin();
        $dispatcher->registerPlugin($InitSmartyPlugin);
        
    }
    
    /**
     * 注册配置文件 
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initConfig(\Yaf\Dispatcher $dispatcher)
    {   
    	//base配置
    	$config_base = new \Yaf\Config\Ini(APP_PATH . '/conf/application.ini', 'base');
    	\Yaf\Registry::set('config_base', $config_base);
    	
    	$config_app = new \Yaf\Config\Ini(APP_PATH . '/conf/application.ini','product');
    	\Yaf\Registry::set('config_app', $config_app->application);
    	 
   
    }
    
    
    public static function _initServerConfig(){
        //mysql 配置
        if(isset($_SERVER['DB_MYSQL_HOST']) && $_SERVER['DB_MYSQL_HOST']){
            $config_mysql['source']='mysql';
            $config_mysql['mysql']['host']=$_SERVER['DB_MYSQL_HOST'];
            $config_mysql['mysql']['port']=$_SERVER['DB_MYSQL_PORT'];
            $config_mysql['mysql']['username']=$_SERVER['DB_MYSQL_USER'];
            $config_mysql['mysql']['password']=$_SERVER['DB_MYSQL_PASSWD'];
            $config_mysql['mysql']['db']=$_SERVER['DB_MYSQL_DBNAME'];
            $config_mysql['mysql']['charset']=$_SERVER['DB_MYSQL_CHARSET'];
            
            $options = \Yaf\Registry::set("config_mysql",$config_mysql);
        }
    }  
    
    //设置默认路由
    public function _initDefaultModule(\Yaf\Dispatcher $dispatcher)
    {
//         $dispatcher->setDefaultModule("sample")->setDefaultController("index")->setDefaultAction("index");
    }
}

