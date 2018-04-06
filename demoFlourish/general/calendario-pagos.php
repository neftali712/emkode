<?php
include_once '../bootstrap/init.php';
fAuthorization::requireLoggedIn();
// if (!fAuthorization::checkAuthLevel('super') && (!fAuthorization::checkAuthLevel('guest') || (!fAuthorization::checkACL('event', 'add') && !fAuthorization::checkACL('event', 'edit') && !fAuthorization::checkACL('event', 'delete')))) fURL::redirect(LOGOUT);
if (!fAuthorization::checkAuthLevel('super') && (!fAuthorization::checkAuthLevel('guest') || (!fAuthorization::checkACL('event', 'listEvent') && !fAuthorization::checkACL('event', 'manageEvent')))) fURL::redirect(LOGOUT);
// if ($lock == 'locked') fURL::redirect(LOCK_SCREEN);
$section = 'general';
$subsection = 'paymentSchedule';
$sections[$section]['pageTitle'] .= ' | ' . $sections[$section]['subsections'][$subsection]['title'];
$sections[$section]['url'] = $sections[$section]['subsections'][$subsection]['url'];
include_once HEADER;
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-calendar font-blue-steel"></i>
					<span class="caption-subject font-blue-steel bold uppercase"><?=$sections[$section]['subsections'][$subsection]['title']?></span>
					<span class="caption-helper"><?=$sections[$section]['subsections'][$subsection]['subtitle']?></span>
				</div>
			</div>
			<div class="portlet-body">
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_paytments_scheduled" data-toggle="tab">
								Pagos programados
							</a>
						</li>
						<li id="description_tab">
							<a href="#tab_payments_made" data-toggle="tab">
								Pagos efectuados
							</a>
						</li>
					</ul>
					<div class="tab-content no-space">
						<div class="tab-pane active" id="tab_paytments_scheduled">
							<div class="row">
								<div class="col-md-12">
									<div id="messages"></div>
									<div class="portlet box blue-hoki calendar">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-calendar"></i><?=$sections[$section]['subsections'][$subsection]['title']?>
											</div>
										</div>
										<div class="portlet-body">
											<div class="row">
												<div class="col-md-3">
													<div class="row">
														<div class="col-md-12">
															<h3 class="event-form-title">Pagos facturas proveedores</h3>
															<div class="external-events">
																<form class="inline-form">
																	<select id="invoice_id_supplier" class="table-group-action-input form-control select2 select2-matcher" name="invoice_id_supplier">
																		<option value="">Seleccionar...</option>
																		<?php
																		$suppliers = Supplier::getAll(array('status=' => 1), array('name' => 'ASC'));
																		if ($suppliers->count() > 0):
																			foreach ($suppliers as $supplier):
																		?>
																		<option value="<?=$supplier->getIdSupplier()?>" data-tag="<?=$supplier->getCorporateName()?>"><?=$supplier->getName()?></option>
																			<?php endforeach; ?>
																		<?php endif; ?>
																	</select>
																</form>
																<hr/>
																<div id="supplierInvoicePaymentEvent"></div>
																<hr class="visible-xs"/>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<h3 class="event-form-title">Pagos remisiones proveedores</h3>
															<div class="external-events">
																<form class="inline-form">
																	<select id="sales_receipt_id_supplier" class="table-group-action-input form-control select2 select2-matcher" name="sales_receipt_id_supplier">
																		<option value="">Seleccionar...</option>
																		<?php
																		$suppliers = Supplier::getAll(array('status=' => 1), array('name' => 'ASC'));
																		if ($suppliers->count() > 0):
																			foreach ($suppliers as $supplier):
																		?>
																		<option value="<?=$supplier->getIdSupplier()?>" data-tag="<?=$supplier->getCorporateName()?>"><?=$supplier->getName()?></option>
																			<?php endforeach; ?>
																		<?php endif; ?>
																	</select>
																</form>
																<hr/>
																<div id="supplierSalesReceiptPaymentEvent"></div>
																<hr class="visible-xs"/>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-9 col-sm-12">
													<div id="paymentCalendar" class="fullcalendar has-toolbar"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_payments_made">
							<div class="row">
								<div class="col-md-12">
									<div id="messages"></div>
									<div class="portlet box blue-hoki calendar">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-calendar"></i><?=$sections[$section]['subsections'][$subsection]['title']?>
											</div>
										</div>
										<div class="portlet-body">
											<div class="row">
												<div class="col-md-3">
												</div>
												<div class="col-md-9 col-sm-12">
													<div id="paymentCalendarMade" class="fullcalendar has-toolbar"></div>
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
			<div id="modalSupplierInvoicePaymentEvent" class="modal fade" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Informaci&oacute;n de pago factura proveedor</h4>
						</div>
						<div class="modal-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible1="1">
								<div class="row">
									<div class="col-md-3">
										<ul class="ver-inline-menu tabbable margin-bottom-10">
											<li class="active">
												<a data-toggle="tab" href="#tab_invoie">
												<i class="fa fa-book"></i> Factura </a>
												<span class="after">
												</span>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_invoice_supplier">
												<i class="fa fa-briefcase"></i> Proveedor </a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="tab-content">
											<div id="tab_invoie" class="tab-pane active">
												<div id="accordionInvoices" class="panel-group">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionInvoices" href="#accordionInvoice">
															<span id="invoice_num"></span></a>
															</h4>
														</div>
														<div id="accordionInvoice" class="panel-collapse collapse in">
															<div class="panel-body">
																<div class="row">
																	<div class="col-md-6">
																		<label><strong>Total: </strong><span id="invoice_amount"></span></label>
																	</div>
																	<div class="col-md-6">
																		<label><strong>Descuento: </strong><span id="invoice_discount"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-6">
																		<label><strong>Fecha llegada: </strong><span id="invoice_arrival_date"></span></label>
																	</div>
																	<div class="col-md-6">
																		<label><strong>Fecha pago: </strong><span id="invoice_payment_date"></span></label>
																	</div>
																</div>
																<br />
																<div class="row">
																	<div class="col-md-6">
																		<label><strong>PDF: </strong><span id="invoice_pdf"></span></label>
																	</div>
																	<div class="col-md-6">
																		<label><strong>XML: </strong><span id="invoice_xml"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-6">
																		<label><strong>Vouchers: </strong><span id="invoice_vouchers"></span></label>
																	</div>
																	<div class="col-md-6">
																		<label><strong>NC: </strong><span id="invoice_credit_notes"></span></label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="tab_invoice_supplier" class="tab-pane">
												<div id="accordionInvoiceSuppliers" class="panel-group">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionInvoiceSuppliers" href="#accordionInvoiceSupplier">
															<span id="invoice_supplier_name"></span> </a>
															</h4>
														</div>
														<div id="accordionInvoiceSupplier" class="panel-collapse collapse in">
															<div class="panel-body">
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>R. social: </strong><span id="invoice_supplier_corporate_name"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>RFC: </strong><span id="invoice_supplier_rfc"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Referencia: </strong><span id="invoice_supplier_reference"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Cuenta: </strong><span id="invoice_supplier_bank_account"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Clabe: </strong><span id="invoice_supplier_clabe"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Cr&eacute;dito: </strong><span id="invoice_supplier_credit_day"></span></label> d&iacute;as
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Tel&eacute;fono: </strong><span id="invoice_supplier_phone"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Comentarios: </strong><span id="invoice_supplier_comment"></span></label>
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
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn default">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /.modal -->
			<!-- modal -->
			<div id="modalSupplierSalesReceiptPaymentEvent" class="modal fade" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Informaci&oacute;n de pago remisi&oacute;n proveedor</h4>
						</div>
						<div class="modal-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible1="1">
								<div class="row">
									<div class="col-md-3">
										<ul class="ver-inline-menu tabbable margin-bottom-10">
											<li class="active">
												<a data-toggle="tab" href="#tab_sales_receipt">
												<i class="fa fa-book"></i> Remisi&oacute;n </a>
												<span class="after">
												</span>
											</li>
											<li>
												<a data-toggle="tab" href="#tab_supplier">
												<i class="fa fa-briefcase"></i> Proveedor </a>
											</li>
										</ul>
									</div>
									<div class="col-md-9">
										<div class="tab-content">
											<div id="tab_sales_receipt" class="tab-pane active">
												<div id="accordionSalesReceipts" class="panel-group">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionSalesReceipts" href="#accordionSalesReceipt">
															<span id="sales_receipt_num"></span></a>
															</h4>
														</div>
														<div id="accordionSalesReceipt" class="panel-collapse collapse in">
															<div class="panel-body">
																<div class="row">
																	<div class="col-md-6">
																		<label><strong>Total: </strong><span id="sales_receipt_amount"></span></label>
																	</div>
																	<div class="col-md-6">
																		<label><strong>Descuento: </strong><span id="sales_receipt_discount"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-6">
																		<label><strong>Fecha llegada: </strong><span id="sales_receipt_arrival_date"></span></label>
																	</div>
																	<div class="col-md-6">
																		<label><strong>Fecha pago: </strong><span id="sales_receipt_payment_date"></span></label>
																	</div>
																</div>
																<br />
																<div class="row">
																	<div class="col-md-6">
																		<label><strong>PDF: </strong><span id="sales_receipt_pdf"></span></label>
																	</div>
																	<div class="col-md-6"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="tab_supplier" class="tab-pane">
												<div id="accordionSalesReceiptSuppliers" class="panel-group">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionSalesReceiptSuppliers" href="#accordionSalesReceiptSupplier">
															<span id="sales_receipt_supplier_name"></span> </a>
															</h4>
														</div>
														<div id="accordionSalesReceiptSupplier" class="panel-collapse collapse in">
															<div class="panel-body">
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>R. social: </strong><span id="sales_receipt_supplier_corporate_name"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>RFC: </strong><span id="sales_receipt_supplier_rfc"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Referencia: </strong><span id="sales_receipt_supplier_reference"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Cuenta: </strong><span id="sales_receipt_supplier_bank_account"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Clabe: </strong><span id="sales_receipt_supplier_clabe"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Cr&eacute;dito: </strong><span id="sales_receipt_supplier_credit_day"></span></label> d&iacute;as
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Tel&eacute;fono: </strong><span id="sales_receipt_supplier_phone"></span></label>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<label><strong>Comentarios: </strong><span id="sales_receipt_supplier_comment"></span></label>
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
		<input id="requestToken" type="hidden" name="requestToken" value="<?=fRequest::generateCSRFToken(GENERAL . 'calendario-pagos' . DS)?>" />
	</div>
</div>
<script>
	var today = new Date(<?=$today->format('Y')?>, <?=$today->format('m') - 1?>, <?=$today->format('d')?>);
</script>
<!-- END PAGE CONTENT INNER -->
<?php include_once FOOTER; ?>
