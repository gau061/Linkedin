@extends($AdminTheme)
@section('title','Admin')
@section('content-header')
<h1>
Dashboard
<small>it all starts here</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol>
@endsection

@section('page-level-css')
  <link rel="stylesheet" href="{{ asset('public/AdminTheme/bower_components/morris.js/morris.css')}}">
@endsection

@section('content')
<div class="row">

  <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
    <!-- LINE CHART -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Login User</h3>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="line-chart" style="height: 300px;"></div>
      </div>
    </div>
  </div>

  <!-- <div class="col-md-6 col-sm-12 col-lg-6 col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Bar Chart</h3>
      </div>
      <div class="box-body chart-responsive">
        <div class="chart" id="bar-chart" style="height: 300px;"></div>
      </div>
    </div>
  </div> -->


</div>
@endsection

@section('page-level-script')

<script src="{{ asset('public/AdminTheme/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('public/AdminTheme/bower_components/morris.js/morris.min.js') }}"></script>

<script type="text/javascript">
   $(function () {
    "use strict";

    var  datas = <?php echo json_encode($chartData); ?>;

    // console.log(datas)
    // alert(datas);
    // LINE CHART
    
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: datas,
      xkey: 'y',
      ykeys: ['Users'],
      labels: ['Users'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });


    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: '2006', a: 100, b: 90},
        {y: '2007', a: 75, b: 65},
        {y: '2008', a: 50, b: 40},
        {y: '2009', a: 75, b: 65},
        {y: '2010', a: 50, b: 40},
        {y: '2011', a: 75, b: 65},
        {y: '2012', a: 100, b: 90}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['CPU', 'DISK'],
      hideHover: 'auto'
    });

 });
</script>

@endsection