function pertumbuhan_laba(value, selector, $tahun=null){
    var title = {
       text: 'Pertumbuhan laba usaha BUMDes Pujotirto tahun 2019'   
    };
    var subtitle = {
       text: 'Sumber: BUMDes Pujotirto'
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