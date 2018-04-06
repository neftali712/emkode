<?php

try {

    $id = fRequest::get('id','integer');
    echo $id;
    fORMDatabase::retrieve()->execute('BEGIN');
        $user = new User($id);
        $user -> delete();

    fORMDatabase::retrieve()->execute('COMMIT');



    /* Success task */
  	if (empty($data['messages']['error'])) $data['status'] = 1;
  	$data['messages']['success']['debtPay'] = 'El usuario se a eliminado satisfactoriamente.';

  	if (!isset($isAjax) || !$isAjax) fURL::redirect($_SERVER['HTTP_REFERER'] . '?success=getFoodDebt');
  } catch(Exception $e) {
  	//fORMDatabase::retrieve()->query('ROLLBACK');
  	$data['messages']['error']['unknown'] = 'Error desconocido. Por favor cont&aacute;ctanos para solucionar tu problema.';
  	 $data['messages']['error']['unknown'] = $e->getMessage();
  	if (!isset($isAjax) || !$isAjax) fURL::redirect($_SERVER['HTTP_REFERER'] . '?error=unknown');
  }
