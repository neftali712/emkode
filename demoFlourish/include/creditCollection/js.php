<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=GLOBAL_PLUGINS?>jquery-validation<?=DS?>js<?=DS?>jquery.validate.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery.form.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>select2<?=DS?>select2.min.js<?=VERSION?>" type="text/javascript"></script>
<?php if ($subsection == 'credit' || $subsection == 'listSalePaid'): ?>
<script src="<?=GLOBAL_SCRIPTS?>datatable.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>datatables.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>plugins<?=DS?>bootstrap<?=DS?>datatables.bootstrap.js<?=VERSION?>" type="text/javascript"></script>
<?php elseif($subsection== 'saleManagement'): ?>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-toastr<?=DS?>toastr.min.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS. 'sprintf.min.js' ?><?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS. 'jquery-inputmask' . DS . 'jquery.inputmask.bundle.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS. 'mousetrap' . DS . 'mousetrap.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS. 'mousetrap' . DS . 'mousetrap-bind-dictionary.min.js' ?><?=VERSION?>" type="text/javascript"></script>
<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>rsvp-3.1.0.min.js<?=VERSION?>"></script>
<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>sha-256.min.js<?=VERSION?>"></script>
<script type="text/javascript" src="<?=GLOBAL_PLUGINS?>qz-tray-v2<?=DS?>qz-tray.js<?=VERSION?>"></script>
<script src="<?=ADMIN_PAGES_SCRIPTS?>printer-load-driver.js<?=VERSION?>" type="text/javascript"></script>
<?php else: ?>
<!-- <script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js" type="text/javascript"></script> -->
<?php endif; ?>
<script src="<?=GLOBAL_PLUGINS?>moment.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS . 'moment' . DS . 'es.js'?><?=VERSION?>" type="text/javascript"></script>
<!-- <script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js" type="text/javascript"></script> -->
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>bootstrap-datepicker.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>locales<?=DS?>bootstrap-datepicker.es.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootbox<?=DS?>bootbox.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>he<?=DS?>he.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>numeral.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>icheck<?=DS?>icheck.min.js<?=VERSION?>"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-toastr<?=DS?>toastr.min.js<?=VERSION?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=GLOBAL_SCRIPTS?>metronic.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>layout.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>demo.js<?=VERSION?>" type="text/javascript"></script>
<!-- <script src="<?=GLOBAL_SCRIPTS?>datatable.js"></script> -->
<script src="<?=ADMIN_PAGES_SCRIPTS?>creditCollection.js<?=VERSION?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
	Demo.init(); // init demo(theme settings page)
	// page functions
	CreditCollection.init();
	<?php if ($subsection == 'listSaleReceivable'): ?>
	CreditCollection.listSaleReceivable();
	<?php elseif ($subsection == 'credit'): ?>
	CreditCollection.credit();
    <?php elseif ($subsection == 'listSalePaid'): ?>
	CreditCollection.listSalePaid();
	<?php elseif($subsection == 'saleManagement'): ?>
	CreditCollection.saleManagement();
	<?php endif; ?>
});
</script>