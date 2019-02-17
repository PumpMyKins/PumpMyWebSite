var maxLengthMotivationAncienneteSanction = 600;
var maxLengthPresentation = 1000;
$('#motivation').keyup(function() {

	var length = $(this).val().length;
	var length = maxLengthMotivationAncienneteSanction - length;

	$('#charsmotivation').text(length);
});
$('#anciennete').keyup(function() {

	var length = $(this).val().length;
	var length = maxLengthMotivationAncienneteSanction - length;

	$('#charsanciennete').text(length);
});
$('#sanction').keyup(function() {

	var length = $(this).val().length;
	var length = maxLengthMotivationAncienneteSanction - length;

	$('#charssanction').text(length);
});
$('#presentation').keyup(function() {

	var length = $(this).val().length;
	var length = maxLengthPresentation - length;

	$('#charspresentation').text(length);
});