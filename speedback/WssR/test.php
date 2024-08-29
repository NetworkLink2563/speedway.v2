<html>
   <head> 
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script> 
   </head> 
   <body> 
      <button type="button" onclick="loadGraph()">Click Me!</button> 
      <canvas id="myChart" width="400" height="400"></canvas> 
      <script>
function getRandomJson() {//from   w  ww .j a  v  a 2  s.  c om
    var cdata = [{
        "_id": "585b544f5c86b6c8537c34d6",
        "topic": "Humidity",
        "message": Math.floor(Math.random() * (100 - 20 + 1)) + 20,
        "message1": Math.floor(Math.random() * (50 - 5 + 1)) + 5,
        "when": "2016-12-22T04:19:27.000Z"
    }, {
        "_id": "585b54505c86b6c8537c34d7",
        "topic": "Humidity",
        "message": Math.floor(Math.random() * (80 - 1 + 1)) + 1,
        "message1": Math.floor(Math.random() * (40 - 5 + 1)) + 5,
        "when": "2016-12-22T04:19:28.000Z"
    }, {
        "_id": "585b54515c86b6c8537c34d8",
        "topic": "Humidity",
        "message": Math.floor(Math.random() * (90 - 20 + 1)) + 20,
        "message1": Math.floor(Math.random() * (60 - 20 + 1)) + 20,
        "when": "2016-12-22T04:19:29.000Z"
    }, {
        "_id": "585b54525c86b6c8537c34d9",
        "topic": "Humidity",
        "message": Math.floor(Math.random() * (50 - 40 + 1)) + 40,
        "message1": Math.floor(Math.random() * (70 - 30 + 1)) + 30,
        "when": "2016-12-22T04:19:30.000Z"
    }, {
        "_id": "585b54535c86b6c8537c34da",
        "topic": "Humidity",
        "message": Math.floor(Math.random() * (85 - 20 + 1)) + 20,
        "message1": Math.floor(Math.random() * (65 - 35 + 1)) + 35,
        "when": "2016-12-22T04:19:31.000Z"
    }];
    return cdata;
}
loadGraph();
function loadGraph() {
var labeldata = [];
var chrtdata = [];
var chartdata = [];
var cdata = getRandomJson();
for(var i =0; i < cdata.length; i++)
{
  labeldata.push(cdata[i].when);
  chrtdata.push(cdata[i].message)
  chartdata.push(cdata[i].message1)
}
var ctx = document.getElementById("myChart").getContext("2d");
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: labeldata,
    datasets: [{
      label: 'Humidity',
      data: chrtdata,
      backgroundColor: "rgba(255, 51, 0,0.6)"
    },
    {
      label: 'Temperature',
      data: chartdata,
      backgroundColor: "rgba(102, 0, 255,0.6)"
    },
    ]
  }
});
}

      </script>  
   </body>
</html>