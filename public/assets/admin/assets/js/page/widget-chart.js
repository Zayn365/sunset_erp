"use strict";

var sparkline_values = [10, 7, 4, 8, 5, 8, 6, 5, 2, 4, 7, 4, 9, 6, 5, 9];
var sparkline_values_chart = [2, 6, 4, 8, 3, 5, 2, 7];
var sparkline_values_bar = [10, 7, 4, 8, 5, 8, 6, 5, 2, 4, 7, 4, 9, 10, 7, 4, 8, 5, 8, 6, 5, 2, 4, 7, 4, 9, 8, 6, 5, 2, 4, 7, 4, 9, 10, 2, 4, 7, 4, 9, 7, 4, 8, 5, 8, 6, 5];

$('.sparkline-inline').sparkline(sparkline_values, {
  type: 'line',
  width: '100%',
  height: '32',
  lineWidth: 3,
  lineColor: 'rgba(87,75,144,.1)',
  fillColor: 'rgba(87,75,144,.25)',
  highlightSpotColor: 'rgba(87,75,144,.1)',
  highlightLineColor: 'rgba(87,75,144,.1)',
  spotRadius: 3,
});

$('.sparkline-line').sparkline(sparkline_values, {
  type: 'line',
  width: '100%',
  height: '32',
  lineWidth: 3,
  lineColor: 'rgba(63, 82, 227, .5)',
  fillColor: 'transparent',
  highlightSpotColor: 'rgba(63, 82, 227, .5)',
  highlightLineColor: 'rgba(63, 82, 227, .5)',
  spotRadius: 3,
});

$('.sparkline-line-chart').sparkline(sparkline_values_chart, {
  type: 'line',
  width: '100%',
  height: '32',
  lineWidth: 2,
  lineColor: 'rgba(63, 82, 227, .5)',
  fillColor: 'transparent',
  highlightSpotColor: 'rgba(63, 82, 227, .5)',
  highlightLineColor: 'rgba(63, 82, 227, .5)',
  spotRadius: 2,
});
$('.sparkline-line-chart2').sparkline(sparkline_values_chart, {
  type: "line",
  width: "100%",
  height: "100",
  lineWidth: 3,
  lineColor: "white",
  fillColor: "transparent",
  highlightSpotColor: "rgba(63,82,227,.1)",
  highlightLineColor: "rgba(63,82,227,.1)",
  spotRadius: 3
});

$(".sparkline-bar").sparkline(sparkline_values_bar, {
  type: "bar",
  width: "100%",
  height: "100",
  barColor: "white",
  barWidth: 2
});




$('#visitorMap4').vectorMap(
  {
    map: 'world_en',
    backgroundColor: '#ffffff',
    borderColor: '#F5AE46',
    borderOpacity: .8,
    borderWidth: 1,
    hoverColor: '#000',
    hoverOpacity: .8,
    color: '#ddd',
    normalizeFunction: 'linear',
    selectedRegions: false,
    showTooltip: true,
    pins: {
      id: '<div class="jqvmap-circle"></div>',
      my: '<div class="jqvmap-circle"></div>',
      th: '<div class="jqvmap-circle"></div>',
      sy: '<div class="jqvmap-circle"></div>',
      eg: '<div class="jqvmap-circle"></div>',
      ae: '<div class="jqvmap-circle"></div>',
      nz: '<div class="jqvmap-circle"></div>',
      tl: '<div class="jqvmap-circle"></div>',
      ng: '<div class="jqvmap-circle"></div>',
      si: '<div class="jqvmap-circle"></div>',
      pa: '<div class="jqvmap-circle"></div>',
      au: '<div class="jqvmap-circle"></div>',
      ca: '<div class="jqvmap-circle"></div>',
      tr: '<div class="jqvmap-circle"></div>',
    },
  });

/* chart shadow */
var draw = Chart.controllers.line.prototype.draw;
Chart.controllers.lineShadow = Chart.controllers.line.extend({
  draw: function () {
    draw.apply(this, arguments);
    var ctx = this.chart.chart.ctx;
    var _stroke = ctx.stroke;
    ctx.stroke = function () {
      ctx.save();
      ctx.shadowColor = '#00000075';
      ctx.shadowBlur = 10;
      ctx.shadowOffsetX = 8;
      ctx.shadowOffsetY = 8;
      _stroke.apply(this, arguments)
      ctx.restore();
    }
  }
});




// revenue chart 
var options = {
  chart: {
    height: 230,
    type: "line",
    shadow: {
      enabled: true,
      color: "#000",
      top: 18,
      left: 7,
      blur: 10,
      opacity: 1
    },
    toolbar: {
      show: false
    }
  },
  colors: ["#3dc7be", "#ffa117"],
  dataLabels: {
    enabled: true
  },
  stroke: {
    curve: "smooth"
  },
  series: [{
    name: "High - 2019",
    data: [5, 15, 14, 36, 32, 32]
  },
  {
    name: "Low - 2019",
    data: [7, 11, 30, 18, 25, 13]
  }
  ],
  grid: {
    borderColor: "#e7e7e7",
    row: {
      colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
      opacity: 0.0
    }
  },
  markers: {
    size: 6
  },
  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],

    labels: {
      style: {
        colors: "#9aa0ac"
      }
    }
  },
  yaxis: {
    title: {
      text: "Income"
    },
    labels: {
      style: {
        color: "#9aa0ac"
      }
    },
    min: 5,
    max: 40
  },
  legend: {
    position: "top",
    horizontalAlign: "right",
    floating: true,
    offsetY: -25,
    offsetX: -5
  }
};

var chart = new ApexCharts(document.querySelector("#revenue"), options);

chart.render();

