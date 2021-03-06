<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Halaman Utama </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
</head>

<body>
  <div id="app" >
    <div class="wrapper ">
      <sidebar-component></sidebar-component>
      <div class="main-panel" id="main-panel">
        <navbar-component></navbar-component>
        <div class="panel-header panel-header-sm"></div>
        <div class="content">
          <home-chart-component></home-chart-component>
          <home-component></home-component>
        </div>
        <footer-component></footer-component>
      </div>
    </div>
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAY0GYbFosf3LOpV_e_Puid1Ex79S4NnNw"></script>
  <script src="{{ asset(mix('js/bansos.js')) }}"></script>
  <script src="{{ asset(mix('js/app.js')) }}"></script>
  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-toastr/dist/vue-toastr.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
</body>

</html>
