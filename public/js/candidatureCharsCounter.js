var maxLengthMotivationAncienneteSanction = 200;
var maxLengthPresentation = 500;
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