function get_queue(){
	var daletqueue = $.ajax({
		type: "GET",
		url: "/wp-content/themes/BX1-2017/daletmeta-dashboardqueue.php",
		async: false
	}).complete(function(){
	}).responseText;
	$('div.daletqueue').html(daletqueue);
}
function get_history(){	
	var dalethistory = $.ajax({
		type: "GET",
		url: "/wp-content/themes/BX1-2017/daletmeta-dashboardhistory.php",
		async: false
	}).complete(function(){
	}).responseText;
	$('div.dalethistory').html(dalethistory);
}
function daletmeta_manual(){	
	$.ajax({
		type: "GET",
		url: "/wp-content/themes/BX1-2017/daletmeta-engine.php",
		async: false
	}).complete(function(){
	}).responseText;
	get_queue();
	get_history();
};
function deleteit(){
	var xmlid = jQuery(this).attr("data-xmlid");
	let isBoss = confirm("Voulez-vous vraiment supprimer le fichier '"+xmlid+"' ?");
}
function changecounter($zone){
	var $currenttime = $("."+$zone+"counter").text();
	$newtime = parseInt($currenttime - 1);
	$("."+$zone+"counter").text($newtime);
};
jQuery( document ).ready( function( $ ) {
	get_queue();
	get_history();
	$(".queuecounter").text('120');
	$(".historycounter").text('30');
	setInterval(function(){
		changecounter("queue");
		changecounter("history");
	}, 1000);
	jQuery(".chooseemission").on('change',function(){
		var optionSelected = $(this);
		var xmlid = optionSelected.attr("data-xmlid");
		var valueSelected  = optionSelected.val();
		$.ajax({
			type: "GET",
			url: "/wp-content/themes/BX1-2017/daletmeta-actions.php?section=prod&action=addemissionfile&XMLID=" + xmlid + "&ShowID=" + valueSelected,
			async: false
		}).complete(function(){
			get_queue()
		}).responseText;
	});
} );
setInterval(function(){
	get_queue()
	$(".queuecounter").text('121');
}, 45000);
setInterval(function(){
	get_history()
	$(".historycounter").text('31');
}, 30000);


