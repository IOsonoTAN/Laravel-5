@extends('master')

@section('content')
  <h4>Contact US</h4>
  {!! Form::open(['data-ng-controller' => 'formController', 'data-ng-submit' => 'submit()', 'onsubmit' => 'return false']) !!}
    <div class="alert alert-danger alert-dismissible" role="alert" data-ng-show="alertMessageError.length > 0">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      [[ alertMessageError ]]
    </div>
    <div class="alert alert-success alert-dismissible" role="alert" data-ng-show="alertMessage.length > 0">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      [[ alertMessage ]]
    </div>
    <div class="form-group">
      {!! Form::label('txtName', 'Your name') !!}
      <span data-ng-show="errorName.length > 0">[[ errorName ]]</span>
      {!! Form::text('txtName', null, ['class' => 'form-control', 'data-ng-model' => 'contact.name']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('txtMessage', 'Your message') !!}
      <span data-ng-show="errorMessage.length > 0">[[ errorMessage ]]</span>
      {!! Form::textarea('txtMessage', null, ['class' => 'form-control', 'data-ng-model' => 'contact.message']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('filePicture', 'Pictures') !!}
      {!! Form::file('filePicture') !!}
    </div>
    {!! Form::submit('Send now', ['class' => 'btn btn-sm btn-primary']) !!}
  {!! Form::close() !!}
  </form>

  <script>
    app.controller('formController', function($scope, $http) {
      $scope.contact = {
        name: '',
        message: '',
      }
      $scope.submit = function() {
        $http({
          method  : 'POST',
          url     : '/contact-us',
          data    : $.param($scope.contact),
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .success(function(data) {
          console.log(data);
          if (!data.success) {
            // $(".alert-success").hide();
            $scope.alertMessageError = data.errors;
          } else {
            // $(".alert-danter").hide();
            $scope.alertMessage = data.message;
          }
        });
      };
    });
  </script>
@stop