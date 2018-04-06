<?php

try {

    $id = fRequest::get('idE','integer');

    $user = new User($id);

    $address = Address::getObject( array('id_user=' => $id));

    $data['user'] = fJSON::decode($user->toJSON());

    $data['address'] = fJSON::decode($address->toJSON());




    fORMDatabase::retrieve()->execute('BEGIN');


    fORMDatabase::retrieve()->execute('COMMIT');

    /* Success task */
  	if (empty($data['messages']['error'])) $data['status'] = 1;
  	$data['messages']['success']['debtPay'] = 'carga completa';

  	if (!isset($isAjax) || !$isAjax) fURL::redirect($_SERVER['HTTP_REFERER'] . '?success=getFoodDebt');
  } catch(Exception $e) {
  	//fORMDatabase::retrieve()->query('ROLLBACK');
  	$data['messages']['error']['unknown'] = 'Error desconocido. Por favor cont&aacute;ctanos para solucionar tu problema.';
  	 $data['messages']['error']['unknown'] = $e->getMessage();
  	if (!isset($isAjax) || !$isAjax) fURL::redirect($_SERVER['HTTP_REFERER'] . '?error=unknown');
  }
