<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=GLOBAL_PLUGINS?>jquery-validation<?=DS?>js<?=DS?>jquery.validate.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery.form.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-select<?=DS?>bootstrap-select.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>select2<?=DS?>select2.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>bootstrap-datepicker.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>locales<?=DS?>bootstrap-datepicker.es.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery-multi-select<?=DS?>js<?=DS?>jquery.multi-select.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>icheck<?=DS?>icheck.min.js<?=VERSION?>"></script>
<!-- <script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js" type="text/javascript"></script> -->
<script src="<?=GLOBAL_PLUGINS?>bootstrap-maxlength<?=DS?>bootstrap-maxlength.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootbox<?=DS?>bootbox.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>he<?=DS?>he.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>numeral.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-toastr<?=DS?>toastr.min.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>moment.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS . 'moment' . DS . 'es.js'?><?=VERSION?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=GLOBAL_SCRIPTS?>metronic.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>layout.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>demo.js<?=VERSION?>" type="text/javascript"></script>
<!-- <script src="<?=GLOBAL_SCRIPTS?>datatable.js"></script> -->
<script src="<?=ADMIN_PAGES_SCRIPTS?>requisition.js<?=VERSION?>" type="text/javascript"></script>
<?php if ($subsection == 'manageRequisition' || $subsection == 'refund' || $subsection == 'provideDriver'): ?>

<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>rsvp-3.1.0.min.js<?=VERSION?>"></script>
<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>sha-256.min.js<?=VERSION?>"></script>
<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>qz-tray.js<?=VERSION?>"></script>
<script src="<?=ADMIN_PAGES_SCRIPTS?>printer-load-driver.js<?=VERSION?>" type="text/javascript"></script>
<?php endif; 
if ($subsection == 'provideDriver'): ?>
<script src="<?=GLOBAL_PLUGINS . 'mousetrap'. DS . 'mousetrap.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS . 'mousetrap'. DS . 'mousetrap-bind-dictionary.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS . 'sprintf.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<?php endif; ?>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
	Demo.init(); // init demo(theme settings page)
	// page functions
	Requisition.init();
	<?php if ($subsection == 'manageRequisition'): ?>
	Requisition.manageRequisition();
    <?php elseif ($subsection == 'refund'): ?>
	Requisition.refund();
	<?php elseif ($subsection == 'provideDriver'): ?>
	Requisition.manageProvideDriver();
	<?php elseif($subsection == 'confirmShipment'): ?>
	Requisition.manageConfirmShipment();
	<?php endif; ?>
});
</script>