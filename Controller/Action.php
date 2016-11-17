<?php

/**
 * @category   Zend
 * @package    Zend_Controller
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Opis_Controller_Action extends Zend_Controller_Action {

    protected $isPublic = true ;
    protected $request ;

//    public function __construct ( Zend_Controller_Request_Abstract $request , Zend_Controller_Response_Abstract $response , array $invokeArgs = array ( ) ) {
//
//        parent::__construct ( $request , $response , $invokeArgs ) ;
//
//    }

    /**
     * Pre-dispatch routines
     *
     * Called before action method. If using class with
     * {@link Zend_Controller_Front}, it may modify the
     * {@link $_request Request object} and reset its dispatched flag in order
     * to skip processing the current action.
     *
     * @return void
     */
    public function preDispatch ( ) {

		$this->view->controllerName = $this->_request->getControllerName ( ) ;
		$this->request = new Zend_Controller_Request_Http ( ) ;
		
        $request = $this->getRequest () ;
        $ModelUsuario = new Model_Usuario ( ) ;

        if ( $ModelUsuario->getUsuarioLogado () === false ) {
            if ( $request->getControllerName () . $request->getActionName () !== "loginform" ) {
                // se o usuario nao estiver logado e nao estiver na pagina de logion, redirecione-o
                if ( !$this->isPublic ) {
                    // Zend_View_Helper_Feedback::push( "Para acessar este conteúdo precisa estar logado", "alert-warning" ) ;
                    $this->redirect ( "/" ) ;
                }
            }
        } else {
            // disponibiliza os dados do usuario para ser usado na camada view
            $session = Zend_Registry::get ( "session" ) ;
            $this->view->usuarioLogado = $session->usuarioLogado ;
            unset ( $this->view->usuarioLogado['DS_SENHA'] ) ;
        }

        $this->view->controller="asdf";


    }


    public function setLogotipoImage ( ) {
    	
        $logotipo = "/assets/img/logo-imidiatv.png" ;
        


        Zend_Registry::get('app_logotipo');

    }

}
