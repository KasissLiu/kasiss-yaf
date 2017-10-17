<?php
/**
 * 默认路由及跳转行为组件
* @author kasiss
*
*/
class InitDefaultPlugin extends \Yaf\Plugin_Abstract {

	public function routerStartup(\Yaf\Request_Abstract $request,\Yaf\Response_Abstract $response ){
//       
        // 启动默认路由设置
        preg_match('/(?<=\/{1})[\w\W]*(?=\?)/', $_SERVER['REQUEST_URI'],$matches);
	    if(!$matches || !$matches[0])
	    {
	        $config_app = \Yaf\Registry::get('config_app')->toArray();
	        $request->setModuleName($config_app['defaultModule']);
	        $request->setControllerName($config_app['defaultController']);
	        $request->setActionName($config_app['defaultAction']);
	    }
	}

	/**
	 * login check
	 * @param \Yaf\Request_Abstract $request
	 * @param \Yaf\Response_Abstract $response
	 */
	public function routerShutdown( \Yaf\Request_Abstract $request , \Yaf\Response_Abstract $response ){
	    //uri白名单
	    $module_name	=	strtolower($request->getModuleName());
	    $controller_name=	strtolower($request->getControllerName());
	    $action_name	=	strtolower($request->getActionName());
	       
	     
	    if($module_name=="interface"){
	         
	        if($controller_name!="test"){
	            //接口安全性认证
	            $key="h3h5vda44"; //key
	            $parameters=$_POST;
	             
	            $token=$parameters['token'];
	            unset($parameters['token']);
	            ksort($parameters);//排序参数
	            if($token!=md5($key.implode(':',$parameters))){
	                exit(api::json(1,"认证失败"));
	            }
	            
	        }
	    }
	    
	    
	}

	/**
	 * dispathLoop分发结束后
	 * @param \Yaf\Request_Abstract $request
	 * @param \Yaf\Response_Abstract $response
	 */
	public function dispatchLoopShutdown( \Yaf\Request_Abstract $request , \Yaf\Response_Abstract $response ){
		//销毁未释放的服务
	}


}