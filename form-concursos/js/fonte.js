$(document).ready(function(){
var fonte = 12;
    $('#aumenta_fonte').click(function(){
		if (fonte<14){
			fonte = fonte+1;
			$('body').css({'font-size' : fonte+'px'});
		}
    });
    $('#reduz_fonte').click(function(){
		if (fonte>9){
			fonte = fonte-1;
			$('body').css({'font-size' : fonte+'px'});
		}
    });	
});