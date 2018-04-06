<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=GLOBAL_PLUGINS?>jquery-validation<?=DS?>js<?=DS?>jquery.validate.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery.form.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>select2<?=DS?>select2.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>icheck<?=DS?>icheck.min.js<?=VERSION?>"></script>
<?php if ($subsection == 'manageProduct'): ?>
<script src="<?=GLOBAL_SCRIPTS?>datatable.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>datatables.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>plugins<?=DS?>bootstrap<?=DS?>datatables.bootstrap.js<?=VERSION?>" type="text/javascript"></script>
<?php else: ?>
<!-- <script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js" type="text/javascript"></script> -->
<?php endif; ?>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-maxlength<?=DS?>bootstrap-maxlength.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootbox<?=DS?>bootbox.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>he<?=DS?>he.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>numeral.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-touchspin<?=DS?>bootstrap.touchspin.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-toastr<?=DS?>toastr.min.js<?=VERSION?>"></script>
<!--<script src="<?=GLOBAL_PLUGINS?>qz-print<?=DS?>js<?=DS?>deployJava.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=GLOBAL_SCRIPTS?>metronic.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>layout.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>demo.js<?=VERSION?>" type="text/javascript"></script>
<!-- <script src="<?=GLOBAL_SCRIPTS?>datatable.js"></script> -->
<script src="<?=ADMIN_PAGES_SCRIPTS?>product.js<?=VERSION?>" type="text/javascript"></script>
<?php if ($subsection == 'printBarcode' || $subsection == 'printThermalLabel'): ?>

<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>rsvp-3.1.0.min.js<?=VERSION?>"></script>
<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>sha-256.min.js<?=VERSION?>"></script>
<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>qz-tray.js<?=VERSION?>"></script>
<script src="<?=ADMIN_PAGES_SCRIPTS?>printer-load-driver.js<?=VERSION?>" type="text/javascript"></script>
<?php endif; ?>
<?php if($subsection == 'printThermalLabel'): ?>
<script src="<?=GLOBAL_PLUGINS . 'sprintf.min.js'?><?=VERSION?>" type="text/javascript"></script>
<?php endif; ?>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
	Demo.init(); // init demo(theme settings page)
	// page functions
	Product.init();
	<?php if ($subsection == 'manageProduct'): ?>
	Product.manageProduct();
	<?php elseif ($subsection == 'manageTax'): ?>
	Product.manageTax();
	<?php elseif ($subsection == 'printBarcode'): ?>
	Product.printBarcode();
	<?php elseif($subsection == 'printThermalLabel'): ?>
	Product.printThermalLabel();
	<?php elseif ($subsection == 'inventory'): ?>
	Product.inventory();
	<?php endif; ?>
});
</script>
