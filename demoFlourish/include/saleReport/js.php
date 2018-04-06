<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=GLOBAL_PLUGINS?>jquery-validation<?=DS?>js<?=DS?>jquery.validate.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery.form.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>select2<?=DS?>select2.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>icheck<?=DS?>icheck.min.js<?=VERSION?>"></script>
<!-- <script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js" type="text/javascript"></script> -->
<script src="<?=GLOBAL_PLUGINS?>bootstrap-maxlength<?=DS?>bootstrap-maxlength.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootbox<?=DS?>bootbox.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>he<?=DS?>he.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>numeral.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>bootstrap-datepicker.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>locales<?=DS?>bootstrap-datepicker.es.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>highcharts<?=DS?>js<?=DS?>highcharts.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>highcharts<?=DS?>js<?=DS?>modules<?=DS?>exporting.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>icheck<?=DS?>icheck.min.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-toastr<?=DS?>toastr.min.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>moment.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>moment<?=DS?>es.js<?=VERSION?>" type="text/javascript"></script>
<?php if($subsection == 'report'):
?>
<script src="<?=GLOBAL_PLUGINS."datatables2" . DS . "datatables.min.js"?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS."datatables2" . DS . "plugins". DS . "bootstrap". DS . "datatables.bootstrap.js"?><?=VERSION?>" type="text/javascript"></script>
<!-- AmCharts -->
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>amcharts.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>serial.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>pie.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>plugins<?=DS?>export<?=DS?>export.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>themes<?=DS?>light.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>amcharts<?=DS?>v3<?=DS?>lang<?=DS?>es.js<?=VERSION?>"></script>
<!-- Fin AmCharts -->
<?php endif ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=GLOBAL_SCRIPTS?>metronic.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>layout.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>demo.js<?=VERSION?>" type="text/javascript"></script>
<!-- <script src="<?=GLOBAL_SCRIPTS?>datatable.js"></script> -->
<script src="<?=ADMIN_PAGES_SCRIPTS?>saleReport.js<?=VERSION?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
	Demo.init(); // init demo(theme settings page)
	// page functions
	SaleReport.init();
	<?php if ($subsection == 'outputInventory'): ?>
	SaleReport.outputInventory();
	<?php elseif ($subsection == 'commissionDriver'): ?>
	SaleReport.commissionDriver();
    <?php elseif ($subsection == 'saleDriver'): ?>
	SaleReport.saleDriver();
	<?php elseif ($subsection == 'report'): ?>
	SaleReport.report();
	<?php endif; ?>
});
</script>
