// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var url = $('#base_url').val();
var id = $('#id').val();

grafik_detail(id);

$( "#filter_kabupaten" ).change(function() {
  var id = $(this).val();
  var wilayah =  $('#filter_kabupaten').find(":selected").text();
  var wilayah_default =  $('#nama_kabupaten_default').val();
  
  window.location.href = url + "home/detail/" + id;

  if (wilayah == 'Pilih Wilayah') {
    $('#nama_kabupaten').html(wilayah_default);
  } else {
    $('#nama_kabupaten').html(wilayah);
  }

});

function grafik_detail(id){
    $.ajax({
      url: url + "home/data_kabupaten",
      type: 'POST',
      data: {id_kabupaten : id},
      dataType: "json",
      success: function(data) {
        var month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", 
                    "Agustus", "September", "Oktober", "Novermber", "Desember"]
    
        var positif = [];
        var meninggal = [];
        var sembuh = [];
        var odp = []
        var pdp = [];
        var label = [];
        var nama_subdistrict = [];

        $.each(data, function(i, item){
          
          var count_positif   = item.positif;
          var count_sembuh    = item.sembuh;
          var count_odp       = item.odp;
          var count_pdp       = item.pdp;
          var count_meninggal = item.meninggal;
          var count_tanggal   = item.tgl_publish;
          var nama_subdistrict_one  = item.nama_subdistrict
    
          var date = new Date(count_tanggal);
          var label_one = date.getDate()+ ' ' + month[date.getMonth()] + ' ' + date.getFullYear() + ' ' + date.getHours()+ ':' + date.getMinutes(); 
          
          myLineChart.data.labels.push(label_one);

            // create table
            
            $('#tbl_body').each(function(index, tbody) { 
              $(tbody).append(` 
                <tr>
                  <td>${label_one}</td>
                  <td>${nama_subdistrict_one}</td>
                  <td>${count_odp}</td>
                  <td>${count_pdp}</td>
                  <td>${count_positif}</td>
                  <td>${count_sembuh}</td>
                  <td>${count_meninggal}</td>
                </tr> 
              `);
            });

        
        return [ meninggal.push(count_meninggal), 
                  positif.push(count_positif),
                  sembuh.push(count_sembuh),
                  odp.push(count_odp),
                  pdp.push(count_pdp),
                  label.push(label_one),
                  nama_subdistrict.push(nama_subdistrict_one)

              ];
          
        });
       
        myLineChart.data.datasets[0].data = meninggal;
        myLineChart.data.datasets[1].data = positif;
        myLineChart.data.datasets[2].data = sembuh;
        myLineChart.data.datasets[3].data = odp;
        myLineChart.data.datasets[4].data = pdp;
    
        myLineChart.update();
        
        
          

      }
    });
}

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {

  type: 'line',
  data: {
    labels: [],
    datasets: [{
      label: "Meninggal",
      lineTension: 0.3,
      backgroundColor: "rgba(237, 111, 101, 0.05)",
      borderColor: "rgba(237, 111, 101, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(237, 111, 101, 1)",
      pointBorderColor: "rgba(237, 111, 101, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(237, 111, 101, 1)",
      pointHoverBorderColor: "rgba(237, 111, 101, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [],
    },
    {
      label: "Positif",
      lineTension: 0.3,
      backgroundColor: "rgba(54, 185, 204, 0.05)",
      borderColor: "rgba(54, 185, 204, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(54, 185, 204, 1)",
      pointBorderColor: "rgba(54, 185, 204, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(54, 185, 204, 1)",
      pointHoverBorderColor: "rgba(54, 185, 204, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [],
    },
    {
      label: "Sembuh",
      lineTension: 0.3,
      backgroundColor: "rgba(246, 194, 62, 0.05)",
      borderColor: "rgba(246, 194, 62, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(246, 194, 62, 1)",
      pointBorderColor: "rgba(246, 194, 62, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(246, 194, 62, 1)",
      pointHoverBorderColor: "rgba(246, 194, 62, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [],
    },
    {
      label: "ODP (orang Dalam Pantauan)",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [],
    },
    {
      label: "PDP (Pasien Dalam Pengawasan)",
      lineTension: 0.3,
      backgroundColor: "rgba(30, 200, 138, 0.05)",
      borderColor: "rgba(30, 200, 138, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(30, 200, 138, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(30, 200, 138, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [],
    },
  ],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return  + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ' :  ' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});