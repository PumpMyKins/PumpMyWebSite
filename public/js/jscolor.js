$('#picker').colpick({
	layout:'hex',
	submit:0,
	colorScheme:'dark',
	onChange:function(hsb,hex,rgb) {
		$('#picker').val(hex).css('border-color','#'+hex);
	}
});
$('#picker').keyup(function(){
	$(this).colpickSetColor(this.value);
});