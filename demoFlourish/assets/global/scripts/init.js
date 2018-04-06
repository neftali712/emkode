var initModalDataTableProductList = function(){
	var dataTableProductList = $('#modalProductPriceList table');
	var isDTProductPriceInitiated = false;
	$("#modalProductPriceList").on('shown.bs.modal', function () {
		if(isDTProductPriceInitiated)
			return;
		dataTableProductList.DataTable({
			"serverSide": true,
			"processing": true,
			"ajax": {
				url: DO,
				type: "POST",
				data: function (d) {
					d.isAjax = 1;
					d.whatToDo = 'product_price_list_get_data_table';
				}
			},
			"lengthMenu": [
		        [5, 10, 20, 100, -1],
		        [5, 10, 20, 100, "Todos"] // change per page values here
	    	],
	    	"pageLength": -1,
	    	"language": {
		        "search": "<span>Buscar:</span> _INPUT_",
		        "lengthMenu": "<span>Mostrar entradas:</span> _MENU_",
		        "zeroRecords": "No se encontraron resultados..",
		        "info": "_START_ - _END_ de _TOTAL_ registros",
		        "infoEmpty": "0 - 0 de 0 registros",
		        "infoFiltered": "(filtrado de _MAX_ registros totales)",
		        "paginate": { "first": "Primera", "last": "Última", "next": "Siguiente", "previous": "Anterior" },
		        "processing": 'Cargando...'
		    },
		    "buttons": [
		        { extend: 'print', className: 'btn dark btn-outline', title: 'Lista de productos'},
		        { extend: 'copy', className: 'btn red btn-outline', title: 'Lista de productos'},
		        { extend: 'pdf', className: 'btn green btn-outline', title: 'Lista de productos'},
		        { extend: 'excel', className: 'btn yellow btn-outline', title: 'Lista de productos'},
		        { extend: 'csv', className: 'btn purple btn-outline', title: 'Lista de productos'}
		    ],
		    "order": [[1, 'asc']]
		});
		isDTProductPriceInitiated = true;
	});
};

var refreshTime = 3600000;

var refresh = function(){
	$(".refresh").show("slow");
	setTimeout(refresh,refreshTime);
};

$(document).ready(function () {
	setTimeout(refresh,refreshTime);
	initModalDataTableProductList();
	$(".refresh_").on("click",function(e){
		e.preventDefault();
		location.reload();
	});
	$(".refresh-close").on("click",function(e){
		e.preventDefault();
		$(".refresh").hide("slow");
	});
});
var strip = function(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}
