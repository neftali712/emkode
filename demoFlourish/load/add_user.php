<?php
if (!isset($isIncluded) || !$isIncluded) include_once '../bootstrap/init.php';
try {

    $id = fRequest::get('id','integer');
    $username = fRequest::get('user','string');
    $password = fRequest::get('password','string');
    $email = fRequest::get('email','string');
    $number = fRequest::get('number','string');
    $street = fRequest::get('street','string');
    $city = fRequest::get('city','string');
    $code = fRequest::get('code','string');


    fORMDatabase::retrieve()->execute('BEGIN');

    try {
        $user = new User($id);

    } catch (\Exception $e) {
        $user = new User();
    }
        $user->setUser($username);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->store();
        $UsuarioId=$user->getIdUser();
    try {
      //$address = Address::getObject(array('id_user=' => $UsuarioId ));
      $address = new Address($UsuarioId);
    } catch (\Exception $e) {
      $address = new Address();
    }
    $address->setNumber($number);
    $address->setStreet($street);
    $address->setCity($city);
    $address->setCode($code);
    $address->setIdUser($UsuarioId);
    $address->store();




    fORMDatabase::retrieve()->execute('COMMIT');



	/* Success task */
	if (empty($data['messages']['error'])) $data['status'] = 1;
	$data['messages']['success']['debtPay'] = 'Se usuario se a registrado satisfactoriamente.';

	if (!isset($isAjax) || !$isAjax) fURL::redirect($_SERVER['HTTP_REFERER'] . '?success=getFoodDebt');
} catch(Exception $e) {
	//fORMDatabase::retrieve()->query('ROLLBACK');
	$data['messages']['error']['unknown'] = 'Error desconocido. Por favor cont&aacute;ctanos para solucionar tu problema.';
	 $data['messages']['error']['unknown'] = $e->getMessage();
	if (!isset($isAjax) || !$isAjax) fURL::redirect($_SERVER['HTTP_REFERER'] . '?error=unknown');
}
