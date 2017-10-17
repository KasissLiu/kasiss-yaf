<?php

/**
 * @author kasiss
 * @date Jul 24, 2016
 * demo
 */
 class IndexController extends Yaf\Controller_Abstract
 {
     
     public function indexAction()
     {
         //在model层 进行业务逻辑处理 
         $content = \Model\Sample::indexSample();
         //调用已经注册为视图的 smarty引擎
         $view = $this->getView();
         $view->assign('content',$content);
         $view->display();
     }
     
     public function sampleAction()
     {
         Common_LoggerModel::debugLogger("sample", "test",array("data1"=>1,"datas"=>"hello"));
           throw new Exception("hello",1234);
                 
     }
     
     
 }