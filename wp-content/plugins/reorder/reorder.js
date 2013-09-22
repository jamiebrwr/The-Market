jQuery(document).ready(function($) {

var config = {    
		accept: 'page-item',
		noNestingClass: "no-nesting",
		opacity: 0.5,
		helperclass: 'reorder-highlight',
		onChange: function(serialized) {
			$('#reorder-loading span').html('<img src="../wp-content/plugins/reorder/loading.gif" />');		
			$('#reorder-loading span').load("../wp-content/plugins/reorder/process-sortable.php?"+serialized[0].hash);
			//$('#order-ser').html("This can be passed as parameter to a GET or POST request: <br/>" + serialized[0].hash);			
		},
		autoScroll: true
};

$('#order-posts-list-nested').NestedSortable(config);
$('#order-posts-list').Sortable(config);

/*
$(".expand-collapse").click(function() {
	$(this).closest('li').children('ul').toggle();
});

$(".reorder-expand-all").click(function(){
	$("#order-posts-list, #order-posts-list-nested").find('ul').show();
});

$(".reorder-collapse-all").click(function(){
	$("#order-posts-list, #order-posts-list-nested").find('ul').hide();
});

    $("#order-posts-list").sortable({
	   update : function () {
	   	$("#order-loading span").html('<img src="../wp-content/plugins/reorder/loading.gif" />');
		var order = $("#order-posts-list").sortable("serialize");
		$("#order-loading span").load("../wp-content/plugins/reorder/process-sortable.php?"+order);
      }  , placeholder :"highlight" , forcePlaceholderSize: true, opacity : 0.6, items: "li"
    });*/
});