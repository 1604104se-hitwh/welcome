// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// groupAccountChart, using to show the Male and Female in a class
var groupAccountChart = new Chart(document.getElementById("groupAccountChart"), {
  type: 'doughnut',
  data: {
    labels: ["男生", "女生"],
    datasets: [{
      data: [31, 1],
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
});


var allAccountChart = new Chart(document.getElementById("groupProviceChart"), {
  type: 'doughnut',
  data: {
    labels: ["山东省", "安徽省", "云南省", "重庆市", "其他"],
    datasets: [{
      data: [31, 16, 13, 7, 14],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f26d5b', '#7f9eb2'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#c03546', '#77919d'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
});
