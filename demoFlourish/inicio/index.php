<?php
include_once '../bootstrap/init.php';
// fAuthorization::requireLoggedIn();
// if (!fAuthorization::checkAuthLevel('guest')) fURL::redirect(LOGOUT);
// if ($lock == 'locked') fURL::redirect(LOCK_SCREEN);
$section = 'home';
$subsection = '';
//include_once HEADER;
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title><?=$sections[$section]['pageTitle']?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="" name="description">
	<meta content="" name="author">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
	<link href="<?=GLOBAL_PLUGINS?>font-awesome<?=DS?>css<?=DS?>font-awesome.min.css<?=VERSION?>" rel="stylesheet" type="text/css"/>
	<link href="<?=GLOBAL_PLUGINS?>simple-line-icons<?=DS?>simple-line-icons.min.css<?=VERSION?>" rel="stylesheet" type="text/css"/>
	<link href="<?=GLOBAL_PLUGINS?>bootstrap<?=DS?>css<?=DS?>bootstrap.min.css<?=VERSION?>" rel="stylesheet" type="text/css"/>
	<link href="<?=GLOBAL_PLUGINS?>uniform<?=DS?>css<?=DS?>uniform.default.css<?=VERSION?>" rel="stylesheet" type="text/css"/>
	<link href="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.css<?=VERSION?>" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<?php include_once INCLUDES . $section . DS . 'css.php'; ?>
	<!-- BEGIN THEME STYLES -->
	<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
	<link href="<?=GLOBAL_CSS?>components-rounded.css<?=VERSION?>" id="style_components" rel="stylesheet" type="text/css">
	<link href="<?=GLOBAL_CSS?>plugins.css<?=VERSION?>" rel="stylesheet" type="text/css">
	<link href="<?=ADMIN_LAYOUT_CSS?>layout.css<?=VERSION?>" rel="stylesheet" type="text/css">
	<link href="<?=ADMIN_LAYOUT_CSS?>themes<?=DS?>blue-steel.css<?=VERSION?>" rel="stylesheet" type="text/css" id="style_color">
	<link href="<?=ADMIN_LAYOUT_CSS?>custom.css<?=VERSION?>" rel="stylesheet" type="text/css">
	<!-- END THEME STYLES -->
	<link href="<?=ADMIN_LAYOUT_IMG?>favicon.ico<?=VERSION?>" rel="shortcut icon"/>
</head>
<body>
    <div class="row">
    	<div class="col-md-12">
    		<form id="formUser" class="form-horizontal" action="<?=ACTION_DO?>" method="post">
    			<div class="portlet light">
    				<div class="portlet-title">
    					<div class="actions btn-set">
    						<button id="buttonGoToListSocialReason" class="btn purple-plum btn-circle listar"><i class="fa fa-angle-left"></i> Ir a listado</button>
    						<button type="submit" class="btn green-haze btn-circle"><i class="fa fa-save"></i> Guardar</button>
    					</div>
    				</div>
    				<div id="messages"></div>
    				<div class="portlet-body">
    					<div class="tabbable">
    						<div class="tab-content no-space">
    							<div class="tab-pane active" id="tab_general">
    								<div class="form-body form">
    									<div class="row">
                                            <div class="col-md-6">
    											<div class="form-group">
    												<label class="col-md-2 control-label">Usuario: <span class="required"> * </span></label>
    												<div class="col-md-10">
    													<div class="input-icon right">
    														<i class="fa"></i>
    														<input id="user" type="text" class="form-control" name="user" placeholder="" autocomplete="off">
    													</div>
    												</div>
    											</div>
    										</div>
    										<div class="col-md-6">
    											<div class="form-group">
    												<label class="col-md-2 control-label">Password: <span class="required"> * </span></label>
    												<div class="col-md-10">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input style="text-transform: uppercase;" id="password" type="password" class="form-control" name="password" placeholder="" autocomplete="off">
                                                        </div>
    												</div>
    											</div>
    										</div>
    									</div>
                                        <div class="row">
                                            <div class="col-md-6">
    											<div class="form-group">
    												<label class="col-md-2 control-label">Email: <span class="required"> * </span></label>
    												<div class="col-md-10">
    													<div class="input-icon right">
    														<i class="fa"></i>
    														<input id="email" type="text" class="form-control" name="email" placeholder="" autocomplete="off">
    													</div>
    												</div>
    											</div>
    										</div>
                                        </div>
																				<div class="row">
																						<div class="col-md-6">
													<div class="form-group">
														<label class="col-md-2 control-label">Numero: <span class="required"> * </span></label>
														<div class="col-md-10">
															<div class="input-icon right">
																<i class="fa"></i>
																<input id="number" type="text" class="form-control" name="number" placeholder="" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
																				</div>
																				<div class="row">
																						<div class="col-md-6">
													<div class="form-group">
														<label class="col-md-2 control-label">Calle: <span class="required"> * </span></label>
														<div class="col-md-10">
															<div class="input-icon right">
																<i class="fa"></i>
																<input id="street" type="text" class="form-control" name="street" placeholder="" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
																				</div>
																				<div class="row">
																						<div class="col-md-6">
													<div class="form-group">
														<label class="col-md-2 control-label">Ciudad: <span class="required"> * </span></label>
														<div class="col-md-10">
															<div class="input-icon right">
																<i class="fa"></i>
																<input id="city" type="text" class="form-control" name="city" placeholder="" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
																				</div>
																				<div class="row">
																						<div class="col-md-6">
													<div class="form-group">
														<label class="col-md-2 control-label">Código Postal: <span class="required"> * </span></label>
														<div class="col-md-10">
															<div class="input-icon right">
																<i class="fa"></i>
																<input id="code" type="text" class="form-control" name="code" placeholder="" autocomplete="off">
															</div>
														</div>
													</div>
												</div>
																				</div>

    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    				<!-- modal -->
    				<div id="modalListSocialReason" class="modal fade" tabindex="-1" aria-hidden="true">
    					<div class="modal-dialog modal-lg">
    						<div class="modal-content">
    							<div class="modal-header">
    								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    								<h4 class="modal-title">Lista de usuarios</h4>
    							</div>
    							<div class="modal-body">
    								<div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible1="1">
    									<div class="row">
    										<div class="col-md-12">
    											<table class="table table-striped table-hover table-bordered" id="tableListSocialReason">
    												<thead>
    													<tr>
    														<th>Usuario</th>
    														<th>Correo</th>

    													</tr>
    												</thead>
    												<tbody id="cuerpo">
															<?php
															$user = User::getAll(array());
															if ($user->count() >0):
																# code...
																$ciudad;
																foreach ($user as $usuario):
																	echo '
																	<tr>
							                     <td>'.$usuario->getUser().'
							                      </td>
																		<td>'.$usuario->getEmail().'
		 					                      </td>
							                      <td>
							                        <button class="btn btn-warning editar" data-id="'.$usuario->getIdUser().'">editar</button>

																		</td>
							                      <td>
	            												<button type="button" class="btn btn-danger eliminar" data-id="'.$usuario->getIdUser().'">Eliminar</button>
							                      </td>
							                    </tr>
																	';
													  endforeach;
														endif;
															?>

														</tbody>
    											</table>
    										</div>
    									</div>
    								</div>
    							</div>
    							<div class="modal-footer">
    								<button type="button" data-dismiss="modal" class="btn default">Cerrar</button>
    							</div>
    						</div>
    					</div>
    				</div>
    				<!-- /.modal -->
    			</div>
    			<input id="whatToDo" type="hidden" name="whatToDo" value="add_user" />
					<input id="id" type="hidden" name="id" value="" />


    			<!-- <input id="requestToken" type="hidden" name="requestToken" value="<?=fRequest::generateCSRFToken(HOME)?>" /> -->
    		</form>
    	</div>
    </div>

    <!-- BEGIN CORE PLUGINS -->
	<script src="<?=GLOBAL_PLUGINS?>jquery.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>jquery-migrate.min.js<?=VERSION?>" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?=GLOBAL_PLUGINS?>jquery-ui<?=DS?>jquery-ui-1.10.3.custom.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>bootstrap<?=DS?>js<?=DS?>bootstrap.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>bootstrap-hover-dropdown<?=DS?>bootstrap-hover-dropdown.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>jquery-slimscroll<?=DS?>jquery.slimscroll.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>jquery.blockui.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>jquery.cokie.min.js<?=VERSION?>" type="text/javascript"></script>
    <script src="<?=GLOBAL_PLUGINS?>jquery.form.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>uniform<?=DS?>jquery.uniform.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_SCRIPTS?>init.js<?=VERSION?>" type="text/javascript"></script>
	<!-- DATATABLE GLOBAL -->
	<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_SCRIPTS?>datatable.js<?=VERSION?>"></script>
	<!-- END CORE PLUGINS section -->
	<?php //include_once INCLUDES . $section . DS . 'js.php'; ?>
    <script src="../assets/admin/pages/scripts/app.js<?=VERSION?>"></script>
    <script src="../assets/global/scripts/metronic.js<?=VERSION?>"></script>
    <script src="../assets/global/scripts/init.js<?=VERSION?>"></script>
    <script src="../assets/global/scripts/datatable.js<?=VERSION?>"></script>

	<!-- END JAVASCRIPTS -->
</body>


<?php //include_once FOOTER; ?>
