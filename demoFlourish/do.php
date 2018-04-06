<?php
include_once 'bootstrap/init.php';
//fAuthorization::requireLoggedIn();
fJSON::sendHeader();
fORMJSON::extend();
if (!fRequest::isPost()) fURL::redirect(HOME);
try{
    $isIncluded = true;
    // $do = fRequest::encode('whatToDo', 'string');
    $whatToDo = explode(',', fRequest::encode('whatToDo', 'string'));
	$data = array('status' => 0, 'messages' => array('success' => array(), 'error' => array()), 'url' => '', 'requestToken' => '');
    $isAjax = fRequest::encode('isAjax', 'boolean');

    foreach ($whatToDo as $do) {
        switch ($do) {

			/**
             * Account
             */
             case 'add_user':
                require_once LOAD. 'add_user.php';
             break;
             case 'delete_user':
                require_once LOAD. 'delete_user.php';
                break;
            case 'edit_user':
               require_once LOAD. 'edit_user.php';
               break;

            default: $data['messages']['error']['noTask'] = 'No se encontr&oacute; la tarea.'; break;

        }
    }
} catch(Exception $e) {
    $data['messages']['error']['unknown'] = 'Error desconocido. Por favor cont&aacute;ctanos para solucionar tu problema.';
	//$data['messages']['error']['unknown'] = $e->getMessage();
}

if ($isAjax) echo fJSON::encode($data);
?>
