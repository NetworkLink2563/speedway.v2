function Showchart4(){
	$.post("Controller.php",
	{
		Chart4: "Chart4"
	}, function (result) {
		
		const obj = JSON.parse(result);
		$('#ShowVolt').text(parseFloat(obj.Voltage).toFixed(2)+" V");
		$('#ShowAmp').text(parseFloat(obj.Current).toFixed(2)+" A");
	});
}
$(function () {
	Showchart4();
	setInterval(Showchart4, 30000);
});
