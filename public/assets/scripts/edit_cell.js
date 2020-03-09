$(document).ready(function() {

    $('table.display').DataTable({
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
    });

    /*
|--------------------------------------------------------------------------
| LINE GRAPH
|--------------------------------------------------------------------------
*/
    Chart.defaults.global.defaultFontFamily = 'Varela Round', 'sans-serif';
    Chart.defaults.global.defaultFontColor = 'black';

    Chart.defaults.global.animation.duration = 700;
    Chart.defaults.global.animation.easing = 'linear';

    // TITLE CONFIGURTAION
    Chart.defaults.global.title.fontSize = 16;
    Chart.defaults.global.title.fontStyle = 'normal';
    Chart.defaults.global.title.fontColor = 'rgb(65, 65, 65)';

    Chart.defaults.global.legend.labels.fontSize = 12;
    Chart.defaults.global.legend.labels.fontStyle = 'normal';

    var ac_my = [0,1,2,3,4,5,6];
    var ac_em = [];
    for(var i=1;i<lc_volt.length;i++){
      ac_em.push(lc_volt[i]['mon']);
    }
    for(var i=1;i<ac_my.length;i++){
      if(ac_em.indexOf(parseInt(ac_my[i])) < 0){
        var zeroObject = {
        "mon": i,
        "count": 0
        };
        lc_volt.push(zeroObject);
      }
    }
    ac = [];
    for(var i in lc_volt) {
      ac.push(lc_volt[i].count);
    }
    
    // DRAW LINE CHART
var dashLineChart = new Chart(document.getElementById("dash-line-chart"), {
  type: 'line',
  data: {
    labels: ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"],
    datasets: [
      { 
          data: ac,
          label: "Voltage Level",
          borderColor: "#3e95cd",
          fill: false
      }
    ]
  },
  options: {
    legend: {
      labels: {
        fontSize: 15
      }
    },
    title: {
      display: true,
      text: 'Battery Voltage Levels (Last 7 Days)'
    },
    layout: {
      padding: {
          left: 15,
          right: 30,
          top: 10,
          bottom: 10
      }
  },
    scales: {
          xAxes: [{
        scaleLabel: {
          display: true,
          labelString: 'Date',
          fontSize: 15
        },
              ticks: {
                  beginAtZero: true
              }
          }],
          yAxes: [{
        scaleLabel: {
          display: true,
          labelString: 'Voltage',
          fontSize: 15
        }
          }]
      }
  }
});
    // https://webdesign.tutsplus.com/tutorials/how-to-add-deep-linking-to-the-bootstrap-4-tabs-component--cms-31180
    let url = location.href.replace(/\/$/, "");
   
    if (location.hash) {
      const hash = url.split("#");
      $('#cellsTab a[href="#'+hash[1]+'"]').tab("show");
      url = location.href.replace(/\/#/, "#");
      history.replaceState(null, null, url);
      setTimeout(() => {
        $(window).scrollTop(0);
      }, 400);
    } 
     
    $('a[data-toggle="tab"]').on("click", function() {
      let newUrl;
      const hash = $(this).attr("href");
      if(hash == "#overview") {
        newUrl = url.split("#")[0];
      } else {
        newUrl = url.split("#")[0] + hash;
      }
      newUrl += "/";
      history.replaceState(null, null, newUrl);
    });

});