<?php if ($subsection == 'dashboard' || $subsection == 'clientsMap'): ?>
<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvwwLh8FwGHbTN6D80F9rZMNFNZdFw2kc">
	</script>
<?php endif; ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=GLOBAL_PLUGINS?>bootstrap-select<?=DS?>bootstrap-select.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>select2<?=DS?>select2.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>bootstrap-datepicker.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>locales<?=DS?>bootstrap-datepicker.es.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery-multi-select<?=DS?>js<?=DS?>jquery.multi-select.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>icheck<?=DS?>icheck.min.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery-validation<?=DS?>js<?=DS?>jquery.validate.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery-validation<?=DS?>js<?=DS?>additional-methods.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery.form.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>datatables.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>plugins<?=DS?>bootstrap<?=DS?>datatables.bootstrap.js<?=VERSION?>" type="text/javascript"></script>
<!-- <script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js" type="text/javascript"></script> -->
<script src="<?=GLOBAL_PLUGINS?>he<?=DS?>he.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>numeral.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>moment.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS . 'moment' . DS . 'es.js'?><?=VERSION?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=GLOBAL_SCRIPTS?>metronic.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>layout.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>demo.js<?=VERSION?>" type="text/javascript"></script>
<!-- <script src="<?=GLOBAL_SCRIPTS?>datatable.js"></script> -->
<script src="<?=GLOBAL_PLUGINS . 'bootbox' . DS . 'bootbox.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS . 'counterup' . DS . 'waypoints.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS . 'counterup' . DS . 'jquery.counterup.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS . 'sprintf.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_PAGES_SCRIPTS?>report.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>ladda-bootstrap<?=DS?>dist<?=DS?>spin.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>ladda-bootstrap<?=DS?>dist<?=DS?>ladda.jquery.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>ladda-bootstrap<?=DS?>dist<?=DS?>ladda.min.js<?=VERSION?>" type="text/javascript"></script>

<!-- AmCharts -->
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>amcharts.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>serial.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>pie.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>plugins<?=DS?>export<?=DS?>export.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>themes<?=DS?>light.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>lang<?=DS?>es.js<?=VERSION?>"></script>
<!-- Fin AmCharts -->

<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
	Demo.init(); // init demo(theme settings page)
	// page functions
	Report.init();
	<?php if ($subsection == 'dashboard'): ?>
	Report.dashboard();
	<?php elseif ($subsection == 'purchaseOrder'): ?>
	Report.purchaseOrder();
	<?php elseif ($subsection == 'clientsMap'): ?>
	Report.clientsMap();
    <?php elseif ($subsection == 'purchases'): ?>
	Report.purchases();
	<?php elseif ($subsection == 'expenses'): ?>
	Report.expenses();
	<?php elseif ($subsection == 'accounts'): ?>
	Report.accounts();
	<?php elseif($subsection == 'storeInventory'): ?>
	Report.storeInventory();
	<?php elseif($subsection == 'storeWarehouse'): ?>
	Report.storeWarehouse();
	<?php elseif($subsection == 'orders'): ?>
	Report.orders();
	<?php elseif($subsection == 'creditCollection'): ?>
	Report.creditCollection();
	<?php elseif($subsection == 'saleReportDriver'): ?>
	Report.saleReportDriver();
	<?php elseif($subsection == 'summaryClient'): ?>
	Report.summaryClient();
	<?php elseif($subsection == 'clientTopReport'): ?>
	Report.clientTopReport();
	<?php endif; ?>
});
</script>
