$(function() {

	var uiElements = function(){
		var uiDatatable = function(){
			if($(".datatable").length > 0){                
                $(".datatable").dataTable();
                // $(".datatable").on('page.dt',function () {
                //     onresize(100);
                // });
            }
            
            if($(".datatable_simple").length > 0){                
                $(".datatable_simple").dataTable({"ordering": false, "info": false, "lengthChange": false,"searching": false});
                // $(".datatable_simple").on('page.dt',function () {
                //     onresize(100);
                // });                
            }       
            
            if($("#produkDataTable").length > 0){
                $("#produkDataTable").dataTable({ "columnDefs": [ {"targets": [ 2 ], "visible": false } ], "ordering": false, "info": false, "lengthChange": false,"searching": true, "sDom":'tp' });
            }

            if($("#my_datatable").length > 0){
                //$("#transaksiDataTable").dataTable({ "aoColumnDefs": [ {"aTargets": [ 4 ], "visible": false, "bSearchable": false } ]});
                $("#my_datatable").dataTable();
                // $("#my_datatable").on('page.dt',function () {
                //     onresize(100);
                // });
            }
		} //End UiDatatable

		return {
            init: function(){
                uiDatatable();
            }
        }

	}(); //End uiElements

	uiElements.init();

}); //End $(function())