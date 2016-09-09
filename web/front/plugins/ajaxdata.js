(function($){
//botones de paginacion
$(document).on('click', '#data .pagination li:not(.disabled) a.act', function () {
		var page = $(this).parent().attr('p');
		var filter = $('#data').data('filter');
		$('#data').ajaxdata({
				page: page,
				filter: filter
		});
		return false;
});
//al darle Enter al input de paginación
$(document).on('keypress','.goto',function(event){ 
	var keyCode = (event.keyCode ? event.keyCode : event.which);
	if(keyCode==13){
		$('#go_btn').trigger('click');
		return false;
	}
});
//input para ir a una pagina
$(document).on('click', '#go_btn', function () {
	var page = parseInt($('.goto').val());

	var no_of_pages = parseInt($('.totaln').html());
	if (page !== 0 && page <= no_of_pages) {
			$('#data').ajaxdata({
					page: page
			});
	} else {
			alert('Ingrese un número entre 1 y ' + no_of_pages);
			$('.goto').val("").focus();
			return false;
	}
});
//////////////////BUSQUEDA EN LA CONSULTA//////////////////////////
	var timertype;
	$(document).on('keyup', '#search', function () {
			var filter = $(this).val();
			if (timertype) {
					clearTimeout(timertype);
			}
			timertype = setTimeout(function () {
				if(filter !== ''){
					$('#data').data('search',filter);
					$('#data').ajaxdata();
				}else{
					$('#data').removeData('search');
					$('#data').html('Introduzca una búsqueda');
				}
			}, 400);
	});
	///venta
	$.fn.venta = function (options) {
			var settVenta = $.extend({
					url: '/AppCMS/AdmVentas/add.php',
					idregistro: 'rel'
			}, options);

			return this.each(function () {
					var esto = $(this);
					esto.click(function() {
						var idr = $(this).attr(settVenta.idregistro);
						
						var form = '<form id="vendo" method="POST" name="vendo" action="'+settVenta.url+'"><input type="hidden" id="idr" name="idr" value="'+idr+'"></form>';
						$('body').append(form);
						$('#vendo').submit();
													
					});
			});
	};
$.fn.ajaxdata = function (options) {

			var settAjax = $.extend({
					url: '/php/list.php',
					page: 1
			}, options);

			return this.each(function () {

					var datadiv = $(this);
					var datos = {};

					datos.page = settAjax.page;
					datos.filter = settAjax.filter;
					datos.busqueda = $(this).data('search');
					$.ajax({
							type: 'POST',
							url: settAjax.url,
							data: datos,
							success: function (msg) {
									datadiv.html(msg);
									//tooltips
									$('[data-toggle="tooltip"]').tooltip({
										container: 'body'
									});
									$('.thumbnail, .mh').matchHeight();
							}
					});

			});
	};
}(jQuery));