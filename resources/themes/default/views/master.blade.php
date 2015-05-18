<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Master</title>
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ asset('/js/angular.min.js') }}"></script>
  <script src="{{ asset('/js/angular-material.min.js') }}"></script>
  <script src="{{ asset('/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/libs/bootstrap/js/bootstrap.min.js') }}"></script>
  <script>
    var app = angular.module('App', [], function($interpolateProvider) {
      $interpolateProvider.startSymbol('[[');
      $interpolateProvider.endSymbol(']]');
    });
  </script>
</head>
<body data-ng-app="App">
  @include('layouts/header')

  <div class="container">
    <div class="col-xs-12">
      @yield('content')
    </div>
  </div>

  @include('layouts/footer')
</body>
</html>
