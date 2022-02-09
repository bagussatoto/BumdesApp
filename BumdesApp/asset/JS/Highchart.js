function pertumbuhan_perdagangan_minggu(value, selector, bulan, tahun){
   var title = {
      text: 'Pertumbuhan perdagangan '+bulan+' '+tahun
   };
   var subtitle = {
      text: 'Source: worldClimate.com'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['minggu'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> minggu <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Penjualan',
         data: value['penjualan']
      },{
         name: 'Keuntungan',
         data: value['margin']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
 //   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function pertumbuhan_perdagangan_bulan(value, selector, tahun){
   var title = {
      text: 'Pertumbuhan perdagangan tahun '+tahun
   };
   var subtitle = {
      text: 'Source: worldClimate.com'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['bulan'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> minggu <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Penjualan',
         data: value['penjualan']
      },{
         name: 'Keuntungan',
         data: value['margin']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
 //   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function pertumbuhan_penyewaan(value, selector, tahun){
   var title = {
      text: 'Pertumbuhan perdagangan'   
   };
   var subtitle = {
      text: 'Source: worldClimate.com'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: ['1', '2', '3', '4'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> minggu ke <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Pendapatan',
         data: value['penjualan']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
 //   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function pembelian_logistik(value, selector, tahun){
   var title = {
      text: 'Pertumbuhan pembelian barang tahun '+tahun
   };
   var subtitle = {
      text: 'Source: worldClimate.com'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['bulan'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> bulan <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Belanja barang',
         data: value['value']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
 //   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function distribusi(value, selector, tahun=null){
   var title = {
      text: 'Pertumbuhan perdagangan/distribusi tahun '+tahun   
   };
   var subtitle = {
      text: 'Source: worldClimate.com'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['bulan'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> bulan <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Nilai distribusi',
         data: value['value']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
 //   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function non_distribusi(value, selector, tahun=null){
   var title = {
      text: 'Pertumbuhan perdagangan/non-distribusi tahun '+tahun
   };
   var subtitle = {
      text: 'Source: worldClimate.com'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['bulan'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> bulan <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Nilai non-distribusi',
         data: value['value']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
 //   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function penyewaan(value, selector, tahun){
   var title = {
      text: 'Pertumbuhan penyewaan aset BUMDes tahun '+tahun
   };
   var subtitle = {
      text: 'Sumber: BUMDes Indrakila jaya'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['bulan'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> bulan <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Total transaksi sewa',
         data: value['value']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function bagi_hasil(value, selector, $tahun=null){
   var title = {
      text: 'Pertumbuhan pemasukan bagi hasil aset tahun '+$tahun
   };
   var subtitle = {
      text: 'Sumber: BUMDes Indrakila jaya'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['bulan'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> bulan <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Nilai bagi hasil',
         data: value['nilai']
      },{
         name: 'Penerimaan BUMDes',
         data: value['bumdes']
      },{
         name: 'Penerimaan Mitra',
         data: value['mitra']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function keuangan_mingguan(value, selector, bulan,  tahun){
   var title = {
      text: 'Keuangan minggu-an BUMDes Indrakila Jaya bulan '+bulan+' '+tahun
   };
   var subtitle = {
      text: 'Sumber: BUMDes Indrakila jaya'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['minggu'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> minggu <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [/*{
         name: 'Saldo',
         data: value['saldo']
      },*/{
         name: 'Debit',
         data: value['debit']
      },{
         name: 'Kredit',
         data: value['kredit']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function keuangan_bulanan(value, selector, tahun){
   var title = {
      text: 'Keuangan bulan-an BUMDes Indrakila Jaya Tahun '+tahun
   };
   var subtitle = {
      text: 'Sumber: BUMDes Indrakila jaya'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['bulan'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> bulan <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [/*{
         name: 'Saldo',
         data: value['saldo']
      },*/{
         name: 'Debit',
         data: value['debit']
      },{
         name: 'Kredit',
         data: value['kredit']
      }];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };
/*
   var labels = {
      formatter: function() {
         return Highcharts.numberFormat(this.value, 2);
      }
   };
*/
   var json = {};
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   // json.labels = labels;
   
   $(selector).highcharts(json);
}

function keuangan_tahunan(value, selector){
   var title = {
      text: 'Keuangan tahun-an BUMDes Indrakila Jaya'   
   };
   var subtitle = {
      text: 'Sumber: BUMDes Indrakila jaya'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['tahun'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> tahun <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [/*{
         name: 'Saldo',
         data: value['saldo']
      },*/{
         name: 'Debit',
         data: value['debit']
      },{
         name: 'Kredit',
         data: value['kredit']
      }];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function pertumbuhan_laba(value, selector, $tahun=null){
   var title = {
      text: 'Pertumbuhan laba usaha BUMDes Indrakila Jaya tahun 2019'   
   };
   var subtitle = {
      text: 'Sumber: BUMDes Indrakila jaya'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['bulan'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> bulan <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Penjualan',
         data: value['penjualan']
      },{
         name: 'Keuntungan',
         data: value['keuntungan']
      }];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}


function bagi_hasil_usaha(value, selector){
   var title = {
      text: 'Pertumbuhan bagi hasil usaha BUMDes'
   };
   var subtitle = {
      text: 'Sumber: BUMDes Indrakila jaya'
   };
   var xAxis =[{
      tickmarkPlacement: 'on',
      categories: value['tahun'],
      startOnTick: true
    }
   ];
   var yAxis = {
      title: {
         text: 'Rupiah IDR'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   
   var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
      /* backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,*/
       formatter: function() {
          return this.series.name + '</b> bulan <b>' + this.x + '</b>, adalah <b>Rp. '+ this.y+' </b>';
       }
    }
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  [{
         name: 'Nilai bagi hasil',
         data: value['nilai']
      }
   ];

   var plotOptions = {
      line: {
         dataLabels: {
            enabled: false
         },   
         enableMouseTracking: true
      },
      series: {
         pointPlacement: 'on'
      }

   };

   var json = {};
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   
   $(selector).highcharts(json);
}

function bagi_dividen(id){
   var chart = {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false
   };
   var title = {
      text: 'Browser market shares at a specific website, 2014'   
   };      
   var tooltip = {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
   };
   var plotOptions = {
      pie: {
         allowPointSelect: true,
         cursor: 'pointer',
         
         dataLabels: {
            enabled: false           
         },
         
         showInLegend: true
      }
   };
   var series = [{
      type: 'pie',
      name: 'Browser share',
      data: [
         ['Firefox',   45.0],
         ['IE',       26.8],
         ['Chrome', 12.8],
         ['Safari',    8.5],
         ['Opera',     6.2],
         ['Others',   0.7]
      ]
   }];     
   var json = {};   
   json.chart = chart; 
   json.title = title;     
   json.tooltip = tooltip;  
   json.series = series;
   json.plotOptions = plotOptions;
   $(id).highcharts(json); 
}

/* =================================================================================== */
function toko (id, nilai, tahun, tanggal){
    var chart = {
       type: 'column'
    };
    var title = {
       text: 'Informasi KAH tahun '+tahun   
    };
    var subtitle = {
       text: 'BMKG DIY Stasiun Geofisika <br> '+tanggal
    };
    var xAxis = {
       //categories: [1,2,3,4],
          title: {
             text:'Minggu'
          },
       allowDecimals: false
    };
    var yAxis = {
       title: {
          text: 'Indeks Ph KAH'
       },
       allowDecimals: true,
       plotLines: [{
          value: 7,
          width: 2,
          color: 'red'
       }]
    };
    var plotOptions = {
       line: {
          dataLabels: {
             enabled: true
          },   
          enableMouseTracking: true
       },
       series: {
          pointStart: 1
       }

    };   
    var tooltip = {
       /*valueSuffix: ' µgram/m3',
       height: 20,*/
       backgroundColor: '#FCFFC5',
       borderColor: 'black',
       borderRadius: 10,
       formatter: function() {
          return 'Indeks Ph bulan <b>' + this.series.name + '</b> di minggu ke <b>' + this.x + '</b>, adalah <b>'+ this.y+' µgram/m3</b>';
       }
    }

    var legend = {
       layout: 'vertical',
       align: 'right',
       verticalAlign: 'middle',
       borderWidth: 0
    };
    var series =  nilai ;

    var navigation = {
         buttonOptions: {
             enabled: true
         }
     };

     var exporting = {
       filename: 'Info-KAH-tahun-'+tahun
     }

    var json = {};
    //json.chart = chart;
    json.title = title;
    json.subtitle = subtitle;
    json.xAxis = xAxis;
    json.yAxis = yAxis;
    json.tooltip = tooltip;
    json.legend = legend;
    json.series = series;
    json.plotOptions = plotOptions;
    json.navigation = navigation;
    json.exporting = exporting;
    
    $(id).highcharts(json);
}

function inc_funds (id, nilai, tahun, tanggal){
   var chart = {
      type: 'column'
   };
   var title = {
      text: 'Informasi KAH tahun '+tahun   
   };
   var subtitle = {
      text: 'BMKG DIY Stasiun Geofisika <br> '+tanggal
   };
   var xAxis = {
      //categories: [1,2,3,4],
         title: {
            text:'Minggu'
         },
      allowDecimals: false
   };
   var yAxis = {
      title: {
         text: 'Indeks Ph KAH'
      },
      allowDecimals: true,
      plotLines: [{
         value: 7,
         width: 2,
         color: 'red'
      }]
   };
   var plotOptions = {
      line: {
         dataLabels: {
            enabled: true
         },   
         enableMouseTracking: true
      },
      series: {
         pointStart: 1
      }

   };   
   var tooltip = {
      /*valueSuffix: ' µgram/m3',
      height: 20,*/
      backgroundColor: '#FCFFC5',
      borderColor: 'black',
      borderRadius: 10,
      formatter: function() {
         return 'Indeks Ph bulan <b>' + this.series.name + '</b> di minggu ke <b>' + this.x + '</b>, adalah <b>'+ this.y+' µgram/m3</b>';
      }
   }

   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  nilai ;

   var navigation = {
        buttonOptions: {
            enabled: true
        }
    };

    var exporting = {
      filename: 'Info-KAH-tahun-'+tahun
    }

   var json = {};
   //json.chart = chart;
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   json.navigation = navigation;
   json.exporting = exporting;
   
   $(id).highcharts(json);
}

function outc_funds (id, nilai, tahun, tanggal){
   var chart = {
      type: 'column'
   };
   var title = {
      text: 'Informasi KAH tahun '+tahun   
   };
   var subtitle = {
      text: 'BMKG DIY Stasiun Geofisika <br> '+tanggal
   };
   var xAxis = {
      //categories: [1,2,3,4],
         title: {
            text:'Minggu'
         },
      allowDecimals: false
   };
   var yAxis = {
      title: {
         text: 'Indeks Ph KAH'
      },
      allowDecimals: true,
      plotLines: [{
         value: 7,
         width: 2,
         color: 'red'
      }]
   };
   var plotOptions = {
      line: {
         dataLabels: {
            enabled: true
         },   
         enableMouseTracking: true
      },
      series: {
         pointStart: 1
      }

   };   
   var tooltip = {
      /*valueSuffix: ' µgram/m3',
      height: 20,*/
      backgroundColor: '#FCFFC5',
      borderColor: 'black',
      borderRadius: 10,
      formatter: function() {
         return 'Indeks Ph bulan <b>' + this.series.name + '</b> di minggu ke <b>' + this.x + '</b>, adalah <b>'+ this.y+' µgram/m3</b>';
      }
   }

   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };
   var series =  nilai ;

   var navigation = {
        buttonOptions: {
            enabled: true
        }
    };

    var exporting = {
      filename: 'Info-KAH-tahun-'+tahun
    }

   var json = {};
   //json.chart = chart;
   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   json.plotOptions = plotOptions;
   json.navigation = navigation;
   json.exporting = exporting;
   
   $(id).highcharts(json);
}



