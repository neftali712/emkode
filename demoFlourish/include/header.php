<?php
$information = Information::getAll(array('status=' => 1));
if ($information->count() > 0) foreach ($information as $info) $infoBusiness[$info->getType()] = $info->getDescription();
$today = new fDate('today');
$todayFormat = $today->format('d') . '-' . $months[$today->format('m')]['shortName'] . '-' . $today->format('Y');
$pendingPaymentEvents = Event::getPendingPaymentEvents();
$totalPendingPaymentEvents = $pendingPaymentEvents->count();
?>
<!DOCTYPE html>
<?php
switch ($browserType) {
	case 'Internet Explorer':
		switch ($browserVersion) {
			case 8: echo '<html lang="en" class="ie8 no-js">'; break;
			case 9: echo '<html lang="en" class="ie9 no-js">'; break;
			default: echo '<html lang="en">';
		}
	break;
	default: echo '<html lang="en" class="no-js">';
}
?>
<!-- BEGIN HEAD -->
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
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<!-- <body class="page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-header-fixed-mobile page-footer-fixed1"> -->
<body class="page-header-menu-fixed">
	<!-- BEGIN HEADER -->
	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
		<div class="page-header-top">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<!-- <a href="<?=HOME?>"><img src="<?=ADMIN_LAYOUT_IMG?>logo-emkode.png" style="margin-top: 19px;" alt="logo" class="logo-default"></a> -->
					<a href="<?=HOME?>"><img src="<?=ADMIN_LAYOUT_IMG?>logo-blue-hoki.png<?=VERSION?>" style="margin-top: 29px;" alt="logo" class="logo-default"></a>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler"></a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<?php if (DB == 'emkodeco_db_botanas_anita_test'): ?>
						<li class="dropdown dropdown-user dropdown-dark">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
								<span class="username username-hide-mobile sessionName" style="color: red;">*** Versi&oacute;n de prueba ***</span>
							</a>
						</li>
						<?php endif; ?>
						<?php // if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('event', 'add') || fAuthorization::checkACL('event', 'edit') || fAuthorization::checkACL('event', 'delete')): ?>
						<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('event', 'listEvent') || fAuthorization::checkACL('event', 'manageEvent')): ?>
						<!-- BEGIN TODO DROPDOWN -->
						<li class="dropdown dropdown-extended dropdown-dark dropdown-tasks" id="header_task_bar">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-calendar"></i>
							<?php if ($totalPendingPaymentEvents > 0) :?><span id="badgePendingEvents" class="badge badge-default"><?=$totalPendingPaymentEvents?></span><?php endif; ?>
							</a>
							<ul class="dropdown-menu extended tasks">
								<li class="external">
									<h3>Tienes <strong><?=$totalPendingPaymentEvents?></strong> pagos pendientes</h3>
									<a href="<?=$sections['general']['subsections']['paymentSchedule']['url']?>">ver todos</a>
								</li>
								<li>
									<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
										<?php
										if ($totalPendingPaymentEvents > 0):
											foreach ($pendingPaymentEvents as $pendingEventPayment):
												$idEvent = $pendingEventPayment->getIdEvent();
												$startDate = new fDate($pendingEventPayment->getStartDate());
												if ($startDate->gte($today)) {
													$statusClass = 'font-scheduled';
												} else {
													$statusClass = 'font-delayed';
												}
												$startDate = $months[$startDate->format('m')]['shortName'] . ' ' . $startDate->format('d') . ', ' . $startDate->format('Y');
										?>
										<li>
											<a href="<?=$sections['general']['subsections']['paymentSchedule']['url']?>">
												<span class="task">
													<span class="desc"><?=$pendingEventPayment->getTitle()?></span>
													<span class="percent <?=$statusClass?>"><?=$startDate?></span>
												</span>
											</a>
										</li>
											<?php endforeach; ?>
										<?php endif; ?>
									</ul>
								</li>
							</ul>
						</li>
						<!-- END TODO DROPDOWN -->
						<?php endif; ?>
						<li class="droddown dropdown-separator">
							<span class="separator"></span>
						</li>
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-user dropdown-dark">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="username username-hide-mobile sessionName"><?=$sessionAdmin['name']?></span>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="<?=$sections['profile']['subsections']['accountSettings']['url']?>">
									<i class="icon-user"></i> Mi perfil </a>
								</li>
								<?php // if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('event', 'add') || fAuthorization::checkACL('event', 'edit') || fAuthorization::checkACL('event', 'delete')): ?>
								<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('event', 'listEvent') || fAuthorization::checkACL('event', 'manageEvent')): ?>
								<li>
									<a href="<?=$sections['general']['subsections']['paymentSchedule']['url']?>">
									<i class="icon-calendar"></i> Calendario de pagos </a>
								</li>
								<?php endif; ?>
								<li class="divider">
								</li>
								<!--
								<li>
									<a href="extra_lock.html">
									<i class="icon-lock"></i> Bloquear pantalla </a>
								</li>
								-->
								<li>
									<a href="<?=LOGOUT?>">
									<i class="icon-key"></i> Salir </a>
								</li>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
		</div>
		<!-- END HEADER TOP -->
		<!-- BEGIN HEADER MENU -->
		<div class="page-header-menu">
			<div class="container-fluid">
				<!-- BEGIN HEADER SEARCH BOX
				<form class="search-form" action="#" method="GET">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Buscar..." name="query">
						<span class="input-group-btn">
						<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
						</span>
					</div>
				</form>
				     END HEADER SEARCH BOX -->
				<!-- OPEN PRODUCT LIST BUTTON -->
				<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('product', 'listProduct')):?>
				<div class="pull-right btn-list-product-menu">
					<div class="row">
						<div class="col-xs-12">
							<button type="button" class="btn blue-hoki pull-right" data-toggle="modal" data-target="#modalProductPriceList" title="Listar productos"><i class="fa fa-sticky-note-o"></i></button>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<!-- BEGIN MEGA MENU -->
				<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
				<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
				<div class="hor-menu ">
					<ul class="nav navbar-nav">
						<li <?php if ($section == 'home'): ?>class="active"<?php endif; ?>>
							<a href="<?=$sections['home']['url']?>"><?=$sections['home']['title']?></a>
						</li>
						<?php
						if (
							fAuthorization::checkAuthLevel('super') ||
							fAuthorization::checkACL('input', 'add') || fAuthorization::checkACL('input', 'edit') || fAuthorization::checkACL('input', 'delete') ||
							fAuthorization::checkACL('input', 'addPurchaseRequisition') || fAuthorization::checkACL('input', 'editPurchaseRequisition') || fAuthorization::checkACL('input', 'deletePurchaseRequisition') ||
							fAuthorization::checkACL('input', 'addPurchaseOrder') || fAuthorization::checkACL('input', 'editPurchaseOrder') || fAuthorization::checkACL('input', 'deletePurchaseOrder') ||
							// fAuthorization::checkACL('tax', 'add') || fAuthorization::checkACL('tax', 'edit') || fAuthorization::checkACL('tax', 'delete') ||
							fAuthorization::checkACL('invoice', 'invoiceView') || fAuthorization::checkACL('invoice', 'add') || fAuthorization::checkACL('invoice', 'edit') || fAuthorization::checkACL('invoice', 'delete') ||
							fAuthorization::checkACL('salesReceipt', 'add') || fAuthorization::checkACL('salesReceipt', 'edit') || fAuthorization::checkACL('salesReceipt', 'delete') ||
							// fAuthorization::checkACL('payment', 'add') || fAuthorization::checkACL('payment', 'edit') || fAuthorization::checkACL('payment', 'delete') ||
							fAuthorization::checkACL('payment', 'listAccount') || fAuthorization::checkACL('payment', 'makeDeposit') || fAuthorization::checkACL('payment', 'listAccountMovement') ||
							fAuthorization::checkACL('payment', 'makePaymentInvoiceInput') || fAuthorization::checkACL('payment', 'makePaymentInvoiceExpense') || fAuthorization::checkACL('payment', 'makePaymentSalesReceiptExpense') ||
							// fAuthorization::checkACL('event', 'add') || fAuthorization::checkACL('event', 'edit') || fAuthorization::checkACL('event', 'delete') ||
							fAuthorization::checkACL('event', 'listEvent') || fAuthorization::checkACL('event', 'manageEvent') ||
							fAuthorization::checkACL('account', 'add') || fAuthorization::checkACL('account', 'edit') || fAuthorization::checkACL('account', 'delete') ||
							fAuthorization::checkACL('supplier', 'add') || fAuthorization::checkACL('supplier', 'edit') || fAuthorization::checkACL('supplier', 'delete') ||
							fAuthorization::checkACL('creditor', 'add') || fAuthorization::checkACL('creditor', 'edit') || fAuthorization::checkACL('creditor', 'delete') ||
                            fAuthorization::checkACL('catalogAccount', 'manageCatalogAccount')||
                            fAuthorization::checkACL('socialReason', 'manageSocialReason') || fAuthorization::checkACL('invoice', 'confirmWarehouseEntry') ||
							fAuthorization::checkACL('invoice', 'ViewExpenses') || fAuthorization::checkACL('invoice', 'addExpenses') || fAuthorization::checkACL('invoice', 'editExpenses') ||
							fAuthorization::checkACL('invoice', 'deleteExpenses')
						):
						?>
						<li class="menu-dropdown mega-menu-dropdown mega-menu-full <?php if ($section == 'input' || $section == 'supplier' || $section == 'catalogAccount' || $section == 'creditor' || $section == 'account' || $section == 'general'): ?>active<?php endif; ?>">
							<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
							Compras <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="min-width: 710px">
								<li>
									<div class="mega-menu-content">
										<div class="row">
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('input', 'add') || fAuthorization::checkACL('input', 'edit') || fAuthorization::checkACL('input', 'delete') ||
												fAuthorization::checkACL('input', 'warehouse') ||
												fAuthorization::checkACL('input', 'addPurchaseRequisition') || fAuthorization::checkACL('input', 'editPurchaseRequisition') || fAuthorization::checkACL('input', 'deletePurchaseRequisition') ||
												fAuthorization::checkACL('input', 'addPurchaseOrder') || fAuthorization::checkACL('input', 'editPurchaseOrder') || fAuthorization::checkACL('input', 'deletePurchaseOrder')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Insumos</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('input', 'add') || fAuthorization::checkACL('input', 'edit') || fAuthorization::checkACL('input', 'delete')): ?>
													<li <?php if ($section == 'input' && $subsection == 'manageInput'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['input']['subsections']['manageInput']['url']?>" class="iconify">
														<i class="icon-basket"></i>
														Gesti&oacute;n de insumos </a>
													</li>
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('input', 'addPurchaseRequisition') || fAuthorization::checkACL('input', 'editPurchaseRequisition') || fAuthorization::checkACL('input', 'deletePurchaseRequisition') || fAuthorization::checkACL('input', 'addPurchaseOrder') || fAuthorization::checkACL('input', 'editPurchaseOrder') || fAuthorization::checkACL('input', 'deletePurchaseOrder')): ?>
													<li <?php if ($section == 'input' && $subsection == 'purchaseInput'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['input']['subsections']['purchaseInput']['url']?>" class="iconify">
														<i class="fa fa-truck"></i>
														Solicitar insumos </a>
													</li>
													<?php endif; ?>
													<!--
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('input', 'warehouse')): ?>
													<li <?php if ($section == 'input' && $subsection == 'warehouse'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['input']['subsections']['warehouse']['url']?>" class="iconify">
														<i class="icon-social-dropbox"></i>
														Almac&eacute;n </a>
													</li>
													<?php endif; ?>
													-->
												</ul>
											</div>
											<?php endif; ?>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('invoice', 'add') || fAuthorization::checkACL('invoice', 'edit') || fAuthorization::checkACL('invoice', 'delete') || fAuthorization::checkACL('invoice', 'confirmWarehouseEntry') ||
												fAuthorization::checkACL('salesReceipt', 'add') || fAuthorization::checkACL('salesReceipt', 'edit') || fAuthorization::checkACL('salesReceipt', 'delete') || fAuthorization::checkACL('invoice', 'invoiceView') ||
												fAuthorization::checkACL('invoice', 'ViewExpenses') || fAuthorization::checkACL('invoice', 'addExpenses') || fAuthorization::checkACL('invoice', 'editExpenses') ||
												fAuthorization::checkACL('invoice', 'deleteExpenses')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Compras</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('invoice', 'confirmWarehouseEntry') || fAuthorization::checkACL('invoice', 'invoiceView') || fAuthorization::checkACL('invoice', 'add') || fAuthorization::checkACL('invoice', 'edit') || fAuthorization::checkACL('invoice', 'delete')): ?>
													<li <?php if ($section == 'supplier' && $subsection == 'supplierInvoice'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['supplier']['subsections']['supplierInvoice']['url']?>" class="iconify">
														<i class="icon-notebook"></i>
														Insumos </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('invoice', 'ViewExpenses') || fAuthorization::checkACL('invoice', 'addExpenses') || fAuthorization::checkACL('invoice', 'editExpenses') || fAuthorization::checkACL('invoice', 'deleteExpenses')): ?>
													<li <?php if ($section == 'creditor' && $subsection == 'creditorInvoice'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['creditor']['subsections']['creditorInvoice']['url']?>" class="iconify">
														<i class="icon-notebook"></i>
														Gastos </a>
													</li>
													<?php endif; ?>
													<!--
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('salesReceipt', 'add') || fAuthorization::checkACL('salesReceipt', 'edit') || fAuthorization::checkACL('salesReceipt', 'delete')): ?>
													<li <?php if ($section == 'supplier' && $subsection == 'supplierSalesReceipt'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['supplier']['subsections']['supplierSalesReceipt']['url']?>" class="iconify">
														<i class="icon-notebook"></i>
														Remisiones de insumos </a>
													</li>
													<?php endif; ?>
													-->
                                                    <!--
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('invoice', 'add') || fAuthorization::checkACL('invoice', 'edit') || fAuthorization::checkACL('invoice', 'delete')): ?>
													<li <?php if ($section == 'account' && $subsection == 'expenseInvoice'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['account']['subsections']['expenseInvoice']['url']?>" class="iconify">
														<i class="icon-notebook"></i>
														Gastos </a>
													</li>
													<?php endif; ?>
                                                    -->
                                                    <!--
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('salesReceipt', 'add') || fAuthorization::checkACL('salesReceipt', 'edit') || fAuthorization::checkACL('salesReceipt', 'delete')): ?>
													<li <?php if ($section == 'account' && $subsection == 'expenseSalesReceipt'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['account']['subsections']['expenseSalesReceipt']['url']?>" class="iconify">
														<i class="icon-notebook"></i>
														Remisiones de gastos </a>
													</li>
													<?php endif; ?>
                                                    -->
												</ul>
											</div>
											<?php endif; ?>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												// fAuthorization::checkACL('payment', 'add') || fAuthorization::checkACL('payment', 'edit') || fAuthorization::checkACL('payment', 'delete') ||
												fAuthorization::checkACL('payment', 'listAccount') || fAuthorization::checkACL('payment', 'makeDeposit') || fAuthorization::checkACL('payment', 'listAccountMovement') ||
												fAuthorization::checkACL('payment', 'makePaymentInvoiceInput') || fAuthorization::checkACL('payment', 'makePaymentInvoiceExpense') || fAuthorization::checkACL('payment', 'makePaymentSalesReceiptExpense') ||
												// fAuthorization::checkACL('event', 'add') || fAuthorization::checkACL('event', 'edit') || fAuthorization::checkACL('event', 'delete')
												fAuthorization::checkACL('event', 'listEvent') || fAuthorization::checkACL('event', 'manageEvent')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Cuentas</h3>
													</li>
													<?php // if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('payment', 'add') || fAuthorization::checkACL('payment', 'edit') || fAuthorization::checkACL('payment', 'delete')): ?>
													<?php if (
														fAuthorization::checkAuthLevel('super') ||
														fAuthorization::checkACL('payment', 'listAccount') || fAuthorization::checkACL('payment', 'makeDeposit') || fAuthorization::checkACL('payment', 'listAccountMovement') ||
														fAuthorization::checkACL('payment', 'makePaymentInvoiceInput') || fAuthorization::checkACL('payment', 'makePaymentInvoiceExpense') || fAuthorization::checkACL('payment', 'makePaymentSalesReceiptExpense')
													): ?>
													<li <?php if ($section == 'account' && $subsection == 'transaction'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['account']['subsections']['transaction']['url']?>" class="iconify">
														<i class="icon-loop"></i>
														Transacciones </a>
													</li>
													<?php endif; ?>
													<?php // if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('event', 'add') || fAuthorization::checkACL('event', 'edit') || fAuthorization::checkACL('event', 'delete')): ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('event', 'listEvent')): ?>
													<li <?php if ($section == 'general' && $subsection == 'paymentSchedule'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['general']['subsections']['paymentSchedule']['url']?>" class="iconify">
														<i class="icon-calendar"></i>
														Calendario de pagos </a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('account', 'add') || fAuthorization::checkACL('account', 'edit') || fAuthorization::checkACL('account', 'delete') ||
												fAuthorization::checkACL('supplier', 'add') || fAuthorization::checkACL('supplier', 'edit') || fAuthorization::checkACL('supplier', 'delete') ||
												fAuthorization::checkACL('creditor', 'add') || fAuthorization::checkACL('creditor', 'edit') || fAuthorization::checkACL('creditor', 'delete') ||
                                                fAuthorization::checkACL('catalogAccount', 'manageCatalogAccount')||
                                                fAuthorization::checkACL('socialReason', 'manageSocialReason')
												// fAuthorization::checkACL('tax', 'add') || fAuthorization::checkACL('tax', 'edit') || fAuthorization::checkACL('tax', 'delete')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Altas</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('account', 'add') || fAuthorization::checkACL('account', 'edit') || fAuthorization::checkACL('account', 'delete')): ?>
													<li <?php if ($section == 'account' && $subsection == 'manageAccount'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['account']['subsections']['manageAccount']['url']?>" class="iconify">
														<i class="icon-credit-card"></i>
														Gesti&oacute;n de cuentas </a>
													</li>
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('supplier', 'add') || fAuthorization::checkACL('supplier', 'edit') || fAuthorization::checkACL('supplier', 'delete')): ?>
													<li <?php if ($section == 'supplier' && $subsection == 'manageSupplier'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['supplier']['subsections']['manageSupplier']['url']?>" class="iconify">
														<i class="icon-briefcase"></i>
														Gesti&oacute;n de proveedores </a>
													</li>
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('creditor', 'add') || fAuthorization::checkACL('creditor', 'edit') || fAuthorization::checkACL('creditor', 'delete')): ?>
													<li <?php if ($section == 'creditor' && $subsection == 'manageCreditor'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['creditor']['subsections']['manageCreditor']['url']?>" class="iconify">
														<i class="icon-briefcase"></i>
														Gesti&oacute;n de acreedores </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('catalogAccount', 'manageCatalogAccount')): ?>
													<li <?php if ($section == 'catalogAccount' && $subsection == 'manageCatalogAccount'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['catalogAccount']['subsections']['manageCatalogAccount']['url']?>" class="iconify">
														<i class="icon-credit-card"></i>
														Gesti&oacute;n de cat&aacute;logo de cuentas </a>
													</li>
													<?php endif; ?>

                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('socialReason', 'manageSocialReason')): ?>
													<li <?php if ($section == 'socialReason' && $subsection == 'manageSocialReason'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['socialReason']['subsections']['manageSocialReason']['url']?>" class="iconify">
														<i class="icon-user"></i>
														Gesti&oacute;n de razón social </a>
													</li>
													<?php endif; ?>

												</ul>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<?php endif; ?>
						<!-- NOMINA -->
						<?php
						if (
							fAuthorization::checkAuthLevel('super') ||
							fAuthorization::checkACL('paysheet', 'importPaysheetDoc') ||
							fAuthorization::checkACL('paysheet', 'addPaysheet') ||
							fAuthorization::checkACL('paysheet', 'viewTablePaysheet') ||
							fAuthorization::checkACL('paysheet', 'editPayshet') ||
							fAuthorization::checkACL('paysheet', 'deletePaysheet') ||
							fAuthorization::checkACL('paysheet', 'printPaysheet') ||
							fAuthorization::checkACL('paysheet', 'printCardPaysheet') ||
							fAuthorization::checkACL('paysheet', 'addDebt') ||
							fAuthorization::checkACL('paysheet', 'viewTableDebt') ||
							fAuthorization::checkACL('paysheet', 'viewEmployees') ||
							fAuthorization::checkACL('paysheet', 'addEmployee') ||
							fAuthorization::checkACL('paysheet', 'editEmployee') ||
							fAuthorization::checkACL('paysheet', 'deleteEmployee') ||
							fAuthorization::checkACL('paysheet', 'viewSalaryDetails')
						):
						?>
						<li class="menu-dropdown mega-menu-dropdown mega-menu-full <?php if ($section == 'paysheet'): ?>active<?php endif; ?>">
							<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
							Nómina <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="min-width: 710px">
								<li>
									<div class="mega-menu-content">
										<div class="row">
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('paysheet', 'importPaysheetDoc') ||
												fAuthorization::checkACL('paysheet', 'addPaysheet') ||
												fAuthorization::checkACL('paysheet', 'viewTablePaysheet') ||
												fAuthorization::checkACL('paysheet', 'editPayshet') ||
												fAuthorization::checkACL('paysheet', 'deletePaysheet') ||
												fAuthorization::checkACL('paysheet', 'printPaysheet') ||
												fAuthorization::checkACL('paysheet', 'printCardPaysheet') ||
												fAuthorization::checkACL('paysheet', 'addDebt') ||
												fAuthorization::checkACL('paysheet', 'viewTableDebt') ||
												fAuthorization::checkACL('paysheet', 'viewSalaryDetails')
											): ?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>N&oacute;mina</h3>
													</li>
													<?php if (
														fAuthorization::checkAuthLevel('super') ||
														fAuthorization::checkACL('paysheet', 'importPaysheetDoc') ||
														fAuthorization::checkACL('paysheet', 'addPaysheet') ||
														fAuthorization::checkACL('paysheet', 'viewTablePaysheet') ||
														fAuthorization::checkACL('paysheet', 'editPayshet') ||
														fAuthorization::checkACL('paysheet', 'deletePaysheet') ||
														fAuthorization::checkACL('paysheet', 'printPaysheet') ||
														fAuthorization::checkACL('paysheet', 'printCardPaysheet') ||
														fAuthorization::checkACL('paysheet', 'viewSalaryDetails')
													): ?>
													<li <?php if ($section == 'paysheet' && $subsection == 'managePaySheet'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['paysheet']['subsections']['managePaySheet']['url']?>" class="iconify">
														<i class="fa fa-credit-card"></i>
														N&oacute;mina </a>
													</li>
													<?php endif; ?>
													<?php if (
														fAuthorization::checkAuthLevel('super') ||
														fAuthorization::checkACL('paysheet', 'addDebt') ||
														fAuthorization::checkACL('paysheet', 'viewTableDebt')
													): ?>
													<li <?php if ($section == 'paysheet' && $subsection == 'manageDebt'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['paysheet']['subsections']['manageDebt']['url']?>" class="iconify">
														<i class="fa fa-money"></i>
														Deducciones </a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('paysheet', 'viewEmployees') ||
												fAuthorization::checkACL('paysheet', 'addEmployee') ||
												fAuthorization::checkACL('paysheet', 'editEmployee') ||
												fAuthorization::checkACL('paysheet', 'deleteEmployee')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Empleados</h3>
													</li>
													<?php if (
														fAuthorization::checkAuthLevel('super') ||
														fAuthorization::checkACL('paysheet', 'viewEmployees') ||
														fAuthorization::checkACL('paysheet', 'addEmployee') ||
														fAuthorization::checkACL('paysheet', 'editEmployee') ||
														fAuthorization::checkACL('paysheet', 'deleteEmployee')
													): ?>
													<li <?php if ($section == 'paysheet' && $subsection == 'Employee'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['paysheet']['subsections']['Employee']['url']?>" class="iconify">
														<i class="fa fa-building"></i>
														Gesti&oacute;n de Empleados</a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<?php endif; ?>
						<!-- FIN NOMINA -->
						<?php
						if (
							fAuthorization::checkAuthLevel('super') ||
							fAuthorization::checkACL('maintenanceInput', 'addMaintenanceInput') || fAuthorization::checkACL('maintenanceInput', 'editMaintenanceInput') || fAuthorization::checkACL('maintenanceInput', 'deleteMaintenanceInput')
						):
						?>
						<li class="menu-dropdown mega-menu-dropdown mega-menu-full <?php if ($section == 'maintenanceInput'): ?>active<?php endif; ?>">
							<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
							Mantenimiento <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="min-width: 710px">
								<li>
									<div class="mega-menu-content">
										<div class="row">
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('maintenanceInput', 'addMaintenanceInput') || fAuthorization::checkACL('maintenanceInput', 'editMaintenanceInput') || fAuthorization::checkACL('maintenanceInput', 'deleteMaintenanceInput')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Insumos de mantenimiento</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('maintenanceInput', 'addMaintenanceInput') || fAuthorization::checkACL('maintenanceInput', 'editMaintenanceInput') || fAuthorization::checkACL('maintenanceInput', 'deleteMaintenanceInput')): ?>
													<li <?php if ($section == 'maintenanceInput' && $subsection == 'maintenanceInput'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['maintenanceInput']['subsections']['maintenanceInput']['url']?>" class="iconify">
														<i class="icon-basket"></i>
														Gesti&oacute;n de insumos de mantenimiento</a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif;
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('maintenanceInput', 'createPreinvoiceMaintenanceInput')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Plantas</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('maintenanceInput', 'createPreinvoiceMaintenanceInput')): ?>
													<li <?php if ($section == 'maintenanceInput' && $subsection == 'preinvoiceInput'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['maintenanceInput']['subsections']['preinvoiceInput']['url']?>" class="iconify">
														<i class="icon-social-dropbox"></i>
														Almacén planta</a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<?php endif; ?>
						<?php
						if (
							fAuthorization::checkAuthLevel('super') ||
							fAuthorization::checkACL('product', 'add') || fAuthorization::checkACL('product', 'edit') || fAuthorization::checkACL('product', 'delete') || fAuthorization::checkACL('product', 'printBarcode') ||
							fAuthorization::checkACL('product', 'inventory') ||
							fAuthorization::checkACL('store', 'add') || fAuthorization::checkACL('store', 'edit') || fAuthorization::checkACL('store', 'delete') ||
							fAuthorization::checkACL('store', 'inventoryStore') ||
							fAuthorization::checkACL('store', 'warehouseStore') ||
							fAuthorization::checkACL('store', 'addProductionReport') ||
							fAuthorization::checkACL('store', 'approveCancelProductionReport')
						):
						?>
						<li class="menu-dropdown mega-menu-dropdown mega-menu-full <?php if ($section == 'product' || $section == 'store'): ?>active<?php endif; ?>">
							<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
							Producci&oacute;n <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="min-width: 710px">
								<li>
									<div class="mega-menu-content">
										<div class="row">
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
                                                fAuthorization::checkACL('product', 'add') || fAuthorization::checkACL('product', 'edit') || fAuthorization::checkACL('product', 'delete') || fAuthorization::checkACL('product', 'printBarcode') ||
												fAuthorization::checkACL('product', 'inventory')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Productos</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('product', 'add') || fAuthorization::checkACL('product', 'edit') || fAuthorization::checkACL('product', 'delete')): ?>
													<li <?php if ($section == 'product' && $subsection == 'manageProduct'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['product']['subsections']['manageProduct']['url']?>" class="iconify">
														<i class="icon-basket"></i>
														Gesti&oacute;n de productos </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('product', 'printBarcode')): ?>
													<li <?php if ($section == 'product' && $subsection == 'printBarcode'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['product']['subsections']['printBarcode']['url']?>" class="iconify">
														<i class="icon-printer"></i>
														Imprimir c&oacute;digos de barra </a>
													</li>
													<li <?php if ($section == 'product' && $subsection == 'printThermalLabel'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['product']['subsections']['printThermalLabel']['url']?>" class="iconify">
														<i class="icon-printer"></i>
														Imprimir etiquetas de exportaci&oacute;n </a>
													</li>
													<?php endif; ?>
													<!--
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('product', 'inventory')): ?>
													<li <?php if ($section == 'product' && $subsection == 'inventory'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['product']['subsections']['inventory']['url']?>" class="iconify">
														<i class="icon-note"></i>
														Inventario </a>
													</li>
													<?php endif; ?>
													-->
												</ul>
											</div>
											<?php endif; ?>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('store', 'add') || fAuthorization::checkACL('store', 'edit') || fAuthorization::checkACL('store', 'delete') ||
												fAuthorization::checkACL('store', 'inventoryStore') ||
												fAuthorization::checkACL('store', 'warehouseStore') ||
												fAuthorization::checkACL('store', 'warehouseStoreCloseDay') ||
												fAuthorization::checkACL('store', 'addProductionReport') ||
												fAuthorization::checkACL('store', 'approveCancelProductionReport')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Plantas</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('store', 'add') || fAuthorization::checkACL('store', 'edit') || fAuthorization::checkACL('store', 'delete')): ?>
													<li <?php if ($section == 'store' && $subsection == 'manageStore'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['store']['subsections']['manageStore']['url']?>" class="iconify">
														<i class="icon-basket-loaded"></i>
														Gesti&oacute;n de plantas </a>
													</li>
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('store', 'inventoryStore')): ?>
													<li <?php if ($section == 'store' && $subsection == 'inventoryStore'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['store']['subsections']['inventoryStore']['url']?>" class="iconify">
														<i class="icon-note"></i>
														Inventario planta </a>
													</li>
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('store', 'warehouseStore')): ?>
													<li <?php if ($section == 'store' && $subsection == 'warehouseStore'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['store']['subsections']['warehouseStore']['url']?>" class="iconify">
														<i class="icon-social-dropbox"></i>
														Almac&eacute;n planta </a>
													</li>
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('store', 'addProductionReport') || fAuthorization::checkACL('store', 'approveCancelProductionReport')): ?>
													<li <?php if ($section == 'store' && $subsection == 'productionByInput'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['store']['subsections']['productionByInput']['url']?>" class="iconify">
														<i class="fa fa-industry"></i>
														Reportes de producción </a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('store', 'warehouseStoreCloseDay')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Entrega de insumos</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('store', 'warehouseStoreCloseDay')): ?>
													<li <?php if ($section == 'store' && $subsection == 'deliverSupplies'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['store']['subsections']['deliverSupplies']['url']?>" class="iconify">
														<i class="icon-social-dropbox"></i>
														Entrega de insumos</a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<?php endif; ?>
						<?php
						if (
							fAuthorization::checkAuthLevel('super') ||
                            // fAuthorization::checkACL('cargo', 'cargo') ||
                            fAuthorization::checkACL('requisition', 'list') || fAuthorization::checkACL('requisition', 'add') || fAuthorization::checkACL('requisition', 'edit') || fAuthorization::checkACL('requisition', 'delete') || fAuthorization::checkACL('requisition', 'confirm') ||
                            fAuthorization::checkACL('creditCollection', 'listSaleReceivable') || fAuthorization::checkACL('creditCollection', 'credit') || fAuthorization::checkACL('creditCollection', 'listSalePaid') || fAuthorization::checkACL('creditCollection', 'seeCharge') ||
							fAuthorization::checkACL('client', 'add') || fAuthorization::checkACL('client', 'edit') || fAuthorization::checkACL('client', 'delete') ||
							fAuthorization::checkACL('saleReport', 'reportProduct') || fAuthorization::checkACL('requisition', 'refundApprove') || fAuthorization::checkACL('requisition', 'refund')

						):
						?>
                        <li class="menu-dropdown mega-menu-dropdown mega-menu-full <?php if ($section == 'cargo' || $section == 'requisition' || $section == 'creditCollection' || $section == 'saleReport' || $section == 'client'): ?>active<?php endif; ?>">
							<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
							Ventas <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="min-width: 710px">
								<li>
									<div class="mega-menu-content">
										<div class="row">
											<!--
                                            <?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('cargo', 'cargo')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Cargamentos</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('cargo', 'cargo')): ?>
													<li <?php if ($section == 'cargo' && $subsection == 'loadDriver'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['cargo']['subsections']['loadDriver']['url']?>" class="iconify">
														<i class="icon-pointer"></i>
														Cargar choferes </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('cargo', 'cargo')): ?>
													<li <?php if ($section == 'cargo' && $subsection == 'returnCargo'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['cargo']['subsections']['returnCargo']['url']?>" class="iconify">
														<i class="icon-share-alt"></i>
														Devoluci&oacute;n cargamentos </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('cargo', 'cargo')): ?>
													<li <?php if ($section == 'cargo' && $subsection == 'dailyCargo'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['cargo']['subsections']['dailyCargo']['url']?>" class="iconify">
														<i class="icon-screen-tablet"></i>
														Cargamentos diarios </a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
											-->
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('requisition', 'list') || fAuthorization::checkACL('requisition', 'add') || fAuthorization::checkACL('requisition', 'edit') || fAuthorization::checkACL('requisition', 'delete') ||
												fAuthorization::checkACL('requisition', 'confirm') || fAuthorization::checkACL('requisition', 'refund') || fAuthorization::checkACL('requisition', 'refundApprove')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Pedidos</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('requisition', 'list') || fAuthorization::checkACL('requisition', 'add') || fAuthorization::checkACL('requisition', 'edit') || fAuthorization::checkACL('requisition', 'delete')): ?>
													<!--<li <?php if ($section == 'requisition' && $subsection == 'manageRequisition'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['requisition']['subsections']['manageRequisition']['url']?>" class="iconify">
														<i class="icon-note"></i>
														Gesti&oacute;n de pedidos </a>
													</li>-->
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('requisition', 'list')): ?>
													<li <?php if ($section == 'requisition' && $subsection == 'provideDriver'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['requisition']['subsections']['provideDriver']['url']?>" class="iconify">
														<i class="fa fa-truck"></i>
														Cargar chofer </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('requisition', 'refund') || fAuthorization::checkACL('requisition', 'refundApprove')): ?>
													<li <?php if ($section == 'requisition' && $subsection == 'refund'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['requisition']['subsections']['refund']['url']?>" class="iconify">
														<i class="icon-note"></i>
														Devoluciones</a>
													</li>
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('requisition', 'confirm')): ?>
													<li <?php if ($section == 'requisition' && $subsection == 'confirmShipment'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['requisition']['subsections']['confirmShipment']['url']?>" class="iconify">
														<i class="fa fa-check"></i>
														Confirmar carga de chofer </a>
													</li>
													<?php endif; ?>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('requisition', 'list')): ?>
													<li <?php if ($section == 'creditCollection' && $subsection == 'saleManagement'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['creditCollection']['subsections']['saleManagement']['url']?>" class="iconify">
															<i class="icon-note"></i> Gestión de ventas
														</a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
                                            <?php
											if (
												fAuthorization::checkAuthLevel('super') ||
                                                fAuthorization::checkACL('creditCollection', 'listSaleReceivable') || fAuthorization::checkACL('creditCollection', 'credit')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Cr&eacute;dito y cobranza</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('creditCollection', 'listSaleReceivable')): ?>
													<li <?php if ($section == 'creditCollection' && $subsection == 'listSaleReceivable'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['creditCollection']['subsections']['listSaleReceivable']['url']?>" class="iconify">
														<i class="icon-notebook"></i>
														Listar ventas por cobrar </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('creditCollection', 'credit')): ?>
													<li <?php if ($section == 'creditCollection' && $subsection == 'credit'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['creditCollection']['subsections']['credit']['url']?>" class="iconify">
														<i class="icon-wallet"></i>
														Cr&eacute;ditos </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('creditCollection', 'listSalePaid') || fAuthorization::checkACL('creditCollection', 'seeCharge')): ?>
													<li <?php if ($section == 'creditCollection' && $subsection == 'listSalePaid'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['creditCollection']['subsections']['listSalePaid']['url']?>" class="iconify">
														<i class="icon-notebook"></i>
														Listar ventas cobradas </a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
                                                fAuthorization::checkACL('creditCollection', 'commissionDriver') ||
												fAuthorization::checkACL('creditCollection', 'saleDriver') ||
												fAuthorization::checkACL('creditCollection', 'saleCost') ||
                                                fAuthorization::checkACL('saleReport', 'reportProduct')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Reportes de ventas</h3>
													</li>
													<?php
                                                    if (
                                                        fAuthorization::checkAuthLevel('super') ||
                                                        fAuthorization::checkACL('saleReport', 'reportProduct')
                                                    ):
                                                    ?>
													<li <?php if ($section == 'saleReport' && $subsection == 'report'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['saleReport']['subsections']['report']['url']?>" class="iconify">
														<i class="icon-graph"></i>
														Reporte ventas </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('creditCollection', 'commissionDriver')): ?>
													<li <?php if ($section == 'saleReport' && $subsection == 'commissionDriver'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['saleReport']['subsections']['commissionDriver']['url']?>" class="iconify">
														<i class="icon-wallet"></i>
														Comisiones de choferes </a>
													</li>
													<?php endif; ?>
                                                    <?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('creditCollection', 'saleDriver') || fAuthorization::checkACL('creditCollection', 'saleCost')): ?>
													<li <?php if ($section == 'saleReport' && $subsection == 'saleDriver'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['saleReport']['subsections']['saleDriver']['url']?>" class="iconify">
														<i class="icon-wallet"></i>
														Relaci&oacute;n de ventas </a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('client', 'add') || fAuthorization::checkACL('client', 'edit') || fAuthorization::checkACL('client', 'delete')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Altas</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('client', 'add') || fAuthorization::checkACL('client', 'edit') || fAuthorization::checkACL('client', 'delete')): ?>
													<li <?php if ($section == 'client' && $subsection == 'manageClient'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['client']['subsections']['manageClient']['url']?>" class="iconify">
														<i class="icon-users"></i>
														Gesti&oacute;n de clientes </a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<?php endif; ?>
						<?php
						if (
							fAuthorization::checkAuthLevel('super') ||
							fAuthorization::checkACL('report', 'seeGeneralReport')
						):
						?>
						<li <?php if ($section == 'report'): ?>class="active"<?php endif; ?>>
							<a href="<?=$sections['report']['subsections']['dashboard']['url']?>">Reportes</a>
						</li>
						<?php endif; ?>
						<?php
						if (
							fAuthorization::checkAuthLevel('guest')
						):
						?>
						<li class="menu-dropdown mega-menu-dropdown mega-menu-full <?php if ($section == 'profile' || $section == 'administrator'): ?>active<?php endif; ?>">
							<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
							Administraci&oacute;n <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="min-width: 710px">
								<li>
									<div class="mega-menu-content">
										<div class="row">
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Perfil</h3>
													</li>
													<li <?php if ($section == 'profile' && ($subsection == 'overview' || $subsection == 'accountSettings' || $subsection == 'help')): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['profile']['subsections']['accountSettings']['url']?>" class="iconify">
														<i class="icon-user"></i>
														Mi perfil </a>
													</li>
													<!--
													<li <?php if ($section == 'profile' && $subsection == 'notification'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['profile']['subsections']['notification']['url']?>" class="iconify">
														<i class="icon-bell"></i>
														Notificaciones </a>
													</li>
													-->
												</ul>
											</div>
											<?php
											if (
												fAuthorization::checkAuthLevel('super') ||
												fAuthorization::checkACL('admin', 'add') || fAuthorization::checkACL('admin', 'edit') || fAuthorization::checkACL('admin', 'delete')
											):
											?>
											<div class="col-md-3">
												<ul class="mega-menu-submenu">
													<li>
														<h3>Administradores</h3>
													</li>
													<?php if (fAuthorization::checkAuthLevel('super') || fAuthorization::checkACL('admin', 'add') || fAuthorization::checkACL('admin', 'edit') || fAuthorization::checkACL('admin', 'delete')): ?>
													<li <?php if ($section == 'administrator' && $subsection == 'manageAdministrator'): ?>class="active"<?php endif; ?>>
														<a href="<?=$sections['administrator']['subsections']['manageAdministrator']['url']?>" class="iconify">
														<i class="icon-users"></i>
														Gesti&oacute;n de administradores </a>
													</li>
													<?php endif; ?>
												</ul>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<!-- END MEGA MENU -->
			</div>
		</div>
		<!-- END HEADER MENU -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN PAGE CONTAINER -->
	<div class="page-container">
		<!-- BEGIN PAGE HEAD -->
		<div class="page-head">
			<div class="container-fluid">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1><?=$sections[$section]['title']?> <small><?=$sections[$section]['subtitle']?></small></h1>
				</div>
				<!-- END PAGE TITLE -->
				<!-- BEGIN PAGE TOOLBAR -->
				<div class="page-toolbar">
					<!-- BEGIN THEME PANEL -->
					<!--<div class="btn-group btn-theme-panel">
						<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
						<i class="icon-settings"></i>
						</a>
						<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<h3>DISE&Ntilde;O</h3>
									<ul class="theme-settings">
										<li>
											Dise&ntilde;o
											<select class="theme-setting theme-setting-layout form-control input-sm input-small input-inline tooltips" data-original-title="Cambia el tipo de dise&ntilde;o" data-container="body" data-placement="left">
												<option value="boxed">En caja</option>
												<option value="fluid" selected="selected">Fluido</option>
											</select>
										</li>
										<li>
											Modo Top Men&uacute;
											<select class="theme-setting theme-setting-top-menu-mode form-control input-sm input-small input-inline tooltips" data-original-title="Habilita el top men&uacute; fijo" data-container="body" data-placement="left">
												<option value="fixed">Fijo</option>
												<option value="not-fixed" selected="selected">No fijo</option>
											</select>
										</li>
										<li>
											Modo Mega Men&uacute;
											<select class="theme-setting theme-setting-mega-menu-mode form-control input-sm input-small input-inline tooltips" data-original-title="Habilita el mega men&uacute; fijo" data-container="body" data-placement="left">
												<option value="fixed" selected="selected">Fijo</option>
												<option value="not-fixed">No fijo</option>
											</select>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>-->
					<!-- END THEME PANEL -->
				</div>
				<!-- END PAGE TOOLBAR -->
			</div>
		</div>
		<!-- END PAGE HEAD -->
		<!-- BEGIN PAGE CONTENT -->
		<div class="page-content">
			<div class="container-fluid">
				<!-- BEGIN PAGE BREADCRUMB -->
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<a href="<?=$sections['home']['url']?>"><?=$sections['home']['breadcrumbTitle']?></a><i class="fa fa-circle"></i>
					</li>
					<li <?php if ($subsection == ''): ?>class="active"<?php endif; ?>>
						<a href="<?=$sections[$section]['url']?>"><?=$sections[$section]['breadcrumbTitle']?></a>
						<?php if ($subsection != ''): ?><i class="fa fa-circle"></i><?php endif; ?>
					</li>
					<?php if ($subsection != ''): ?>
					<li class="active">
						<?=$sections[$section]['subsections'][$subsection]['breadcrumbTitle']?>
					</li>
					<?php endif; ?>
				</ul>
				<!-- END PAGE BREADCRUMB -->
