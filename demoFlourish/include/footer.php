			</div>
		</div>
		<!-- END PAGE CONTENT -->
	</div>
	<!-- END PAGE CONTAINER -->
	<!-- BEGIN PRE-FOOTER -->
	<!--
	<div class="page-prefooter">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12 footer-block">
					<h2>Acerca de</h2>
					<p>
						<?=$infoBusiness['aboutUs']?>
					</p>
				</div>
				<div class="col-md-4 col-sm-6 col-xs12 footer-block">
					<h2>Redes sociales</h2>
					<ul class="social-icons">
						<li>
							<a href="https://facebook.com/<?=$infoBusiness['facebook']?>" target="_blank" data-original-title="facebook" class="facebook"></a>
						</li>
						<li>
							<a href="https://twitter.com/<?=$infoBusiness['twitter']?>" target="_blank" data-original-title="twitter" class="twitter"></a>
						</li>
					</ul>
				</div>
				<div class="col-md-4 col-sm-6 col-xs12 footer-block">
					<h2>Contactos</h2>
					<address class="margin-bottom-40">
					Tel&eacute;fono: <?=$infoBusiness['phone']?><br>
					Correo electr&oacute;nico: <a href="mailto:<?=$infoBusiness['email']?>"><?=$infoBusiness['email']?></a>
					</address>
				</div>
			</div>
		</div>
	</div>
	-->
	<!-- END PRE-FOOTER -->
	<!-- START MODAL PRODUCT PRICE LIST -->
	<div class="modal fade-in" id="modalProductPriceList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		    	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel">Lista de productos</h4>
		      	</div>
			    <div class="modal-body">
			        <div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible1="1">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-striped table-hover table-bordered" id="tableModalProductList">
									<thead>
										<tr>
											<th>C&oacute;digo</th>
											<th>Descripci&oacute;n</th>
											<th>Precio local</th>
											<th>Precio foráneo</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
			    </div>
			    <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		</div>
	</div>
	<!-- END MODAL PRODUCT PRICE LIST -->
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="container-fluid">
			2016 &copy; <?=$infoBusiness['name']?><?php if (DB == 'emkodeco_db_botanas_anita_test'): ?> *** Versi&oacute;n de prueba ***<?php endif; ?>. Todos los derechos reservados.
		</div>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
	<!-- END FOOTER -->
	<!-- Refresh -->
	<div class="refresh">
		<div class="container-fluid text-center">
			<h4><b>Es recomendable recargar la página para su óptimo funcionamiento <a class="btn btn-info refresh_">Recargar</a> <a class="pull-right refresh-close" style="color:white;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></a></b></h4>
		</div>
	</div>
	<!-- END Refresh -->
	<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<?php if ($browserType == 'Internet Explorer' && $browserVersion == 9): ?>
	<script src="<?=GLOBAL_PLUGINS?>respond.min.js<?=VERSION?>"></script>
	<script src="<?=GLOBAL_PLUGINS?>excanvas.min.js<?=VERSION?>"></script>
	<?php endif; ?>
	<script src="<?=GLOBAL_PLUGINS?>jquery.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>jquery-migrate.min.js<?=VERSION?>" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?=GLOBAL_PLUGINS?>jquery-ui<?=DS?>jquery-ui-1.10.3.custom.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>bootstrap<?=DS?>js<?=DS?>bootstrap.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>bootstrap-hover-dropdown<?=DS?>bootstrap-hover-dropdown.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>jquery-slimscroll<?=DS?>jquery.slimscroll.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>jquery.blockui.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>jquery.cokie.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>uniform<?=DS?>jquery.uniform.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_SCRIPTS?>init.js<?=VERSION?>" type="text/javascript"></script>
	<!-- DATATABLE GLOBAL -->
	<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js<?=VERSION?>" type="text/javascript"></script>
	<script src="<?=GLOBAL_SCRIPTS?>datatable.js<?=VERSION?>"></script>
	<!-- END CORE PLUGINS section -->
	<?php include_once INCLUDES . $section . DS . 'js.php'; ?>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
