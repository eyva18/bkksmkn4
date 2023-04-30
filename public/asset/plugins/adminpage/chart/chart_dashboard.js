// Chart Alumni Pertahun 
var ctx = document.getElementById("ds1").getContext('2d');
var ds1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["2020", "2021", "2022", "2023"],
        datasets: [{
            label: 'Alumni',
            data: [450, 400, 430, 450, 600],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {display: false},
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

//Chart Alumni Tahun Sekarang
var xValues = ["Tata Boga", "Tata Busana", "Tata Kecantikan", "Akomodasi Perhotelan", "Usaha Perjalanan Wisata", "Seni Musik Populer",
"Rekayasa Perangkat Lunak"];
var yValues = [91, 94, 35, 70, 29, 28, 64];
var barColors = [
  "#fcba03",
  "#a103fc",
  "#b33daf",
  "#6dc73a",
  "#cede1d",
  "#1d7ede",
  "#de1d47",
];

new Chart("ds2", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Alumni Per Jurusan"
    }
  }
});

//Chart Alumni Melamar Per Bulan
var xValues = ["Januari", "Febuari", "Maret", "April"];
var yValues = [40, 20, 35, 30];
new Chart("ds3", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      label:"Alumni Melamar",  
      backgroundColor:"rgba(0,0,0,0.0)",
      borderColor: "rgba(0,0,255,1.0)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}
});

//Chart Alumni Melamar Per Bulan
var xValues = ["Maret", "April", "Mei", "June"];
var yValues = [1000, 2927, 3996, 2000];
new Chart("ds4", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor:"rgba(0,0,0,0.0)",
      borderColor: "rgba(0,0,255,1.0)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}
});

//Chart Lowongan
var xValues = ["Italy", "France", "Spain", "USA", "Argentina", "Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 15, 55, 49, 44, 24, 15];
var barColors = ["red", "green","blue","orange","blue", "red", "green","blue","orange","blue"];

new Chart("ds5", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
});