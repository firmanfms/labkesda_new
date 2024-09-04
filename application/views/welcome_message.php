<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Lab Klinik</span>
          <span>Tahun <strong><?= substr(dbnow(),0,4); ?></strong></span>
          <span class="info-box-number"><?= $lk; ?> </span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Lab Lingkungan </span>
          <span>Tahun <strong><?= substr(dbnow(),0,4); ?></strong></span>
          <span class="info-box-number"><?= $ll; ?> </span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Lab Makanan & Minuman</span>
          <span>Tahun <strong><?= substr(dbnow(),0,4); ?></strong></span>
          <span class="info-box-number"><?= $lm; ?> </span>
        </div>
      </div>
    </div>

    <!-- <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Sales</span>
          <span class="info-box-number">760</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">New Members</span>
          <span class="info-box-number">2,000</span>
        </div>
      </div>
    </div> -->
  </div>
  <div class="row">    
    <div class="col-xs-4">
      <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <div id="container_box1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <div id="container_box2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="box">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <div id="container_box3"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
// test($last_stok,1);
$array_top = array();
foreach ($top_mutasi as $key => $value1) {
  $array_top[$key]=array($value1->name,(int)$value1->y);
}

$array_last_stok = array();
foreach ($last_stok as $key => $value2) {
  $array_last_stok[$key]=array($value2->name,(int)$value2->y);
}

$array_lk = array();
foreach ($gr_lk as $key => $value3) {
  $array_lk[$key]=array($value3->tahun,(int)$value3->jumlah);
}

$array_ll = array();
foreach ($gr_ll as $key => $value4) {
  $array_ll[$key]=array($value4->tahun,(int)$value4->jumlah);
}

$array_lm = array();
foreach ($gr_lm as $key => $value5) {
  $array_lm[$key]=array($value5->tahun,(int)$value5->jumlah);
}
?>

<script>
$(function(){

  // Create the chart
  Highcharts.chart('container_box1', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Jumlah Kunjungan Laboratorium Klinik Labkesda Kota Tangerang'
      },
      accessibility: {
          announceNewData: {
              enabled: true
          }
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: 'Quantity'
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}<br/>'
      },

      series: [
          {
              name: "Tahun",
              colorByPoint: true,
              data: <?= json_encode($array_lk); ?>
          }
      ]
  });

  Highcharts.chart('container_box2', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Jumlah Kunjungan Laboratorium Lingkungan Labkesda Kota Tangerang'
      },
      accessibility: {
          announceNewData: {
              enabled: true
          }
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: 'Quantity'
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}<br/>'
      },

      series: [
          {
              name: "Tahun",
              colorByPoint: true,
              data: <?= json_encode($array_ll); ?>
          }
      ]
  });

  Highcharts.chart('container_box3', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Jumlah Kunjungan Laboratorium Makanan & Minuman Labkesda Kota Tangerang'
      },
      accessibility: {
          announceNewData: {
              enabled: true
          }
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: 'Quantity'
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}<br/>'
      },

      series: [
          {
              name: "Tahun",
              colorByPoint: true,
              data: <?= json_encode($array_lm); ?>
          }
      ]
  });
});
</script>