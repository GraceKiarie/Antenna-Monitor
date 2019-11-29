// Chart.defaults.global.defaultFontFamily = 'Varela Round', sans-serif;

new Chart(document.getElementById("dash-pie-chart"), {
  type: 'pie',
  data: {
    labels: ["Azimuth", "Pitch", "Roll", "Signal Strength", "Battery"],
    datasets: [{
      label: "Alerts Count",
      backgroundColor: ["#3e95cd", "#58ffff","#3cba9f","#f8e646","#c45850"],
      data: [478,267,734,784,133]
    }]
  },
  options: {
    legend: {
      position: 'bottom',
      align: 'start',
      labels: {
        fontFamily: 'Varela Round',
        fontColor: 'black',
        fontSize: 15
      }
    },
    title: {
      display: true,
      fontFamily: 'Varela Round',
      fontColor: 'black',
      fontSize: 17,
      text: 'Comparisson of Alerts By Type'
    }
  }
});

new Chart(document.getElementById("dash-bar-chart-horizontal"), {
  type: 'horizontalBar',
  data: {
    labels: ["Azimuth", "Pitch", "Roll", "Signal Strength", "Battery"],
    datasets: [
      {
        label: "Alert Count",
        backgroundColor: ["#3e95cd", "#58ffff","#3cba9f","#f8e646","#c45850"],
        data: [47,26,13,28,43]
      }
    ]
  },
  options: {
    legend: {
      display: false,
      labels: {
        fontFamily: 'Varela Round',
        fontColor: 'black',
        fontSize: 15
      }
    },
    title: {
      display: true,
      fontFamily: 'Varela Round',
      fontColor: 'black',
      fontSize: 17,
      text: 'Alert Count Trends (Over Last 10 Months)'
    }
  }
});


// Bar chart
new Chart(document.getElementById("dash-line-chart"), {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
    datasets: [{ 
        data: [12,6,11,10,10,10,11,13,22,15,20],
        label: "Azimuth",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: [23,28,35,41,50,63,53,61,48,45,43],
        label: "Pitch",
        borderColor: "#58ffff",
        fill: false
      }, { 
        data: [14,16,17,17,19,20,27,40,54,67,73],
        label: "Roll",
        borderColor: "#3cba9f",
        fill: false
      }, { 
        data: [37,40,20,10,16,24,38,74,16,50,78],
        label: "Signal Strength",
        borderColor: "#f8e646",
        fill: false
      }, { 
        data: [4,6,3,2,2,7,2,8,0,3,4],
        label: "Battery",
        borderColor: "#c45850",
        fill: false
      }
    ]
  },
  options: {
    legend: {
      labels: {
        fontFamily: 'Varela Round',
        fontColor: 'black',
        fontSize: 15
      }
    },
    title: {
      display: true,
      fontFamily: 'Varela Round',
      fontColor: 'black',
      fontSize: 17,
      text: 'Alert Trends (This Year)'
    }
  }
});

