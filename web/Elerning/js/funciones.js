$(document).ready(function(){

	rand = Math.floor((Math.random()*20)+1);

	$("#barrita").animate({'width':rand+'%'},200,function(){
	});
});

$(window).load(function(){
	$("#barrita").animate({'width':100+'%'},450,function(){
		$("#barrita").fadeOut(250);
	});
	$("#loading").fadeOut(1000);
});
