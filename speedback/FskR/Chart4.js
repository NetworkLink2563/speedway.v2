function Showchart4(){
	$('#ShowVolt').text("0 V");
	$('#ShowAmp').text("0 A");
	$.post("Controller.php",
	{   Pcode:$("#SelProject").val(),
		Chart4: "Chart4"
	}, function (result) {
		console.log(result);
		const obj = JSON.parse(result);
		$('#ShowVolt').text(parseFloat(obj.Voltage).toFixed(2)+" V");
		$('#ShowAmp').text(parseFloat(obj.Current).toFixed(2)+" A");
	});
}
$(function () {
	Showchart4();
	setInterval(Showchart4, 10000);
});
