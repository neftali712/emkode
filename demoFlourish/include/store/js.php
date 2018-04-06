<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=GLOBAL_PLUGINS?>jquery-validation<?=DS?>js<?=DS?>jquery.validate.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery-validation<?=DS?>js<?=DS?>additional-methods.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery.form.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-select<?=DS?>bootstrap-select.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>select2<?=DS?>select2.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>jquery-multi-select<?=DS?>js<?=DS?>jquery.multi-select.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>bootstrap-datepicker.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-datepicker<?=DS?>js<?=DS?>locales<?=DS?>bootstrap-datepicker.es.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>icheck<?=DS?>icheck.min.js<?=VERSION?>"></script>
<?php if ($subsection == 'inventoryStore'): ?>
<script src="<?=GLOBAL_SCRIPTS?>datatable.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>datatables.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>plugins<?=DS?>bootstrap<?=DS?>datatables.bootstrap.js<?=VERSION?>" type="text/javascript"></script>
<?php elseif($subsection == 'warehouseStore'): ?>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>datatables.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>plugins<?=DS?>bootstrap<?=DS?>datatables.bootstrap.js<?=VERSION?>" type="text/javascript"></script>
<?php elseif(in_array($subsection, ['productionByInput', 'deliverSupplies'])): ?>
<script src="<?=ADMIN_PAGES_SCRIPTS?>productionReport.js<?=VERSION?>" type="text/javascript"></script>
<?php if($subsection == 'deliverSupplies'): ?>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>datatables.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables2<?=DS?>plugins<?=DS?>bootstrap<?=DS?>datatables.bootstrap.js<?=VERSION?>" type="text/javascript"></script>
<?php endif; ?>
<?php else: ?>
<!-- <script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>media<?=DS?>js<?=DS?>jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>datatables<?=DS?>plugins<?=DS?>bootstrap<?=DS?>dataTables.bootstrap.js" type="text/javascript"></script> -->
<?php endif; ?>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-maxlength<?=DS?>bootstrap-maxlength.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootbox<?=DS?>bootbox.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>he<?=DS?>he.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>numeral.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>trumbowyg<?=DS?>trumbowyg.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>trumbowyg<?=DS?>langs<?=DS?>es.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>moment.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>moment<?=DS?>es.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>bootstrap-fileinput<?=DS?>bootstrap-fileinput.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>ladda-bootstrap<?=DS?>dist<?=DS?>spin.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>ladda-bootstrap<?=DS?>dist<?=DS?>ladda.jquery.min.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=GLOBAL_PLUGINS?>ladda-bootstrap<?=DS?>dist<?=DS?>ladda.min.js<?=VERSION?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=GLOBAL_SCRIPTS?>metronic.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>layout.js<?=VERSION?>" type="text/javascript"></script>
<script src="<?=ADMIN_LAYOUT_SCRIPTS?>demo.js<?=VERSION?>" type="text/javascript"></script>
<!-- <script src="<?=GLOBAL_SCRIPTS?>datatable.js"></script> -->
<script src="<?=ADMIN_PAGES_SCRIPTS?>store.js<?=VERSION?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    Demo.init(); // init demo(theme settings page)
    // page functions
    Store.init();
    <?php if ($subsection == 'manageStore'): ?>
    Store.manageStore();
    <?php elseif ($subsection == 'inventoryStore'): ?>
    Store.inventoryStore();
    <?php elseif ($subsection == 'warehouseStore'): ?>
    Store.warehouseStore();
    Store.requisition();
    <?php elseif ($subsection == 'productionByInput'): ?>
	ProductionReport.productionByInput();
	<?php elseif ($subsection == 'deliverSupplies'): ?>
	ProductionReport.deliverSupplies();
    <?php endif; ?>
});
</script>
