@extends('master')

@section('content')
  <h4>Basic</h4>
    <p><span class="glyphicon glyphicon-map-marker"></span> This is content zone.</p>
    <div data-ng-controller="Customer">
      <p>Ciao [[ firstName ]] / <span data-ng-bind="lastName"></span></p>
      <hr>
      <p>Tuo nome: <input type="text" data-ng-model="firstName"></p>
      <p>Tuo cognome: <input type="text" data-ng-model="lastName"></p>
    </div>
  <hr>
  <h4>Text fields</h4>
    <div data-ng-controller="Products">
      <p><input type="text" data-ng-model="cost" placeholder="Enter cost"> * <input type="text" data-ng-model="quantity" placeholder="Enter quantity"></p>
      <p>Total: <span data-ng-bind="(quantity * cost) | currency : '฿'"></span></p>
      <!-- <p data-ng-show="(cost.length && quantity.length)">Total: <span data-ng-bind="(quantity * cost) | currency : '฿'"></span></p> -->
    </div>
  <hr>
  <h4>Loop & Ajax</h4>
    <ul data-ng-controller="Contacts">
      <li data-ng-repeat="x in names | orderBy:'Country'">
        [[ x.Name + ', ' + x.Country ]]
      </li>
    </ul>
  <hr>
  <h4>Button & click</h4>
    <button data-ng-disabled="closeClickME == undefined || closeClickME ==''" disabled>Click Me!</button>
    <input type="checkbox" data-ng-model="closeClickME" value="1">Button
  <hr>
  <h4>Button & variables</h4>
    <span data-ng-init="count = 1"></span>
    <button data-ng-disabled="count >= 10" data-ng-click="count = count + 1" class="btn btn-sm btn-primary">Click +!</button>
    <button data-ng-disabled="count <= 1" data-ng-click="count = count - 1" class="btn btn-sm btn-primary">Click -!</button>
    <p>[[ count ]]</p>
  <hr>
  <h4>Toggle && copy</h4>
    <div data-ng-controller="personCtrl">
      <button data-ng-click="toggle()">Toggle</button>
      <p data-ng-show="myVar">
        First Name: <input type="text" data-ng-model="firstName"><br>
        Last Name: <input type="text" data-ng-model="lastName"><br>
        <br>
        Full Name: [[ firstName + " " + lastName ]]
      </p>
    </div>
  <hr>
  <h4>Form & send</h4>
    <div data-ng-controller="formCtrl">
      <form novalidate>
        First Name:<br>
        <input type="text" data-ng-model="user.firstName"><br>
        Last Name:<br>
        <input type="text" data-ng-model="user.lastName">
        <br><br>
        <button data-ng-click="reset()">RESET</button>
      </form>
      <p>form = [[ user ]]</p>
      <p>master = [[ master ]]</p>
    </div>
  <hr>
  <h4>Form & send + validation</h4>
    <form data-ng-controller="validateCtrl" name="myForm" novalidate>
      <p>Username:<br>
        <input type="text" name="user" data-ng-model="user" required>
        <span style="color:red" data-ng-show="myForm.user.$dirty && myForm.user.$invalid">
          <span data-ng-show="myForm.user.$error.required">Username is required.</span>
        </span>
      </p>
      <p>Email:<br>
        <input type="email" name="email" data-ng-model="email" required>
        <span style="color:red" data-ng-show="myForm.email.$dirty && myForm.email.$invalid">
          <span data-ng-show="myForm.email.$error.required">Email is required.</span>
          <span data-ng-show="myForm.email.$error.email">Invalid email address.</span>
        </span>
      </p>
      <p>
        <input type="submit" data-ng-disabled="myForm.user.$dirty && myForm.user.$invalid || myForm.email.$dirty && myForm.email.$invalid">
      </p>
    </form>

  <script>
    app.controller('Customer', function($scope) {
      $scope.firstName = "Krissada";
      $scope.lastName = "Boontrigratn";
    });

    app.controller('Products', function($scope) {
      $scope.quantity = 3;
      $scope.cost = 199;
    });

    app.controller('Contacts', function($scope, $http) {
      $http.get("http://www.w3schools.com/angular/customers.php").success(function(response){
        $scope.names = response.records;
      });
    });

    app.controller('personCtrl', function($scope) {
      $scope.firstName = "John",
      $scope.lastName = "Doe"
      $scope.myVar = true;
      $scope.toggle = function() {
        $scope.myVar = !$scope.myVar;
      }
    });

    app.controller('formCtrl', function($scope) {
      $scope.master = {firstName: "Krissada", lastName: "Boontrigratn"};
      $scope.reset = function() {
        $scope.user = angular.copy($scope.master);
      };
      $scope.reset();
    });

    app.controller('validateCtrl', function($scope) {
      $scope.user = angular.isString('John Doe');
      $scope.email = 'john.doe@gmail.com';
    });
  </script>
@stop