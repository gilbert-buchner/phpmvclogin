$(document).ready(function(){
	
	enableDisable();
	$("input[name='anmeldeart']").change(function(){
		enableDisable();
	});
	function enableDisable(val){
		var val = $("input[name='anmeldeart']:checked").val();
		if (val == 'A'){
			$('#neu_anmelden').hide();
		}else{
			$('#neu_anmelden').show();
			
		}
	}
});