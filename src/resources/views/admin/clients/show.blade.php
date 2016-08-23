@extends('web::layouts.grids.4-4-4')

@section('title', trans('oauth2::seat.oauth2_admin'))
@section('page_header', trans('oauth2::seat.oauth2_admin'))

@section('left')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('oauth2::seat.update_client') }}</h3>
    </div>
    <div class="panel-body">

      <form role="form" action="{{ route('oauth2-admin.clients.update', [$client->id]) }}" method="post" id="client-form">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="box-body">

          <div class="form-group">
            <label for="comment">{{ trans('oauth2::seat.name') }}</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $client->name }}">
          </div>

          <div class="form-group">
            <label for="comment">{{ trans('oauth2::seat.client_id') }}</label>
            <input type="text" name="id" class="form-control" id="id" value="{{ $client->id }}" disabled>
          </div>

          <div class="form-group">
            <label for="text">{{ trans('oauth2::seat.client_secret') }}</label>
            <input type="text" name="secret" class="form-control" id="secret" value="{{ $client->secret }}">
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">
            {{ trans('oauth2::seat.update') }}
          </button>
        </div>
      </form>

    </div>
  </div>

@stop

@section('center')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans_choice('oauth2::seat.endpoint', 2) }}</h3>
    </div>
    <div class="panel-body">

      <form role="form" action="{{ route('oauth2-admin.clients.endpoints.store', [$client->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="users">{{ trans_choice('oauth2::seat.redirect_uri', 1) }}</label>
          <input type="text" name="redirect_uri" class="form-control" id="redirect_uri" value="">
        </div>

        <button type="submit" class="btn btn-success btn-block">
          {{ trans('oauth2::seat.add_endpoint') }}
        </button>

      </form>

      @if($client->endpoints->count() > 0)
      <table class="table table-hover table-condensed">
        <tbody>
          <tr>
            <th>{{ trans_choice('oauth2::seat.endpoint', 2) }}</th>
          </tr>

        @foreach($client->endpoints as $endpoint)

          <tr>
            <td>{{ $endpoint->redirect_uri }}</td>
            <td>
              <form action="{{ route('oauth2-admin.clients.endpoints.destroy', [$client->id, $endpoint->id]) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-danger btn-xs confirmlink col-xs-12">
                  {{ trans('oauth2::seat.delete') }}
                </button>

              </form>
            </td>
          </tr>

        @endforeach

        </tbody>
      </table>
      @endif

    </div>
    <div class="panel-footer">
      {{ count($client->endpoints) }} {{ trans_choice('oauth2::seat.endpoint', count($client->endpoints)) }}
    </div>
  </div>
@stop

@section('right')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans_choice('oauth2::seat.scope', 2) }}</h3>
    </div>
    <div class="panel-body">

      <form role="form" action="{{ route('oauth2-admin.clients.scopes.store', [$client->id]) }}" method="post">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="users">{{ trans('oauth2::seat.available_scopes') }}</label>
          <select name="scopes[]" id="available_scopes" style="width: 100%" multiple>

            @foreach($availableScopes as $key => $scope)
              @if(! $client->scopes->contains($scope))
                  <option value="{{ $scope->id }}" data-description="{{ $scope->description }}">
                    {{ $scope->id }}
                  </option>
              @endif
            @endforeach

          </select>
        </div>
        <button type="submit" class="btn btn-success btn-block">
          {{ trans_choice('oauth2::seat.add_scope', 2) }}
        </button>
      </form>

      @if($client->scopes->count() > 0)

        <table class="table table-hover table-condensed">
          <tbody>
            <tr>
              <th>{{ trans_choice('oauth2::seat.scope', 2) }}</th>
            </tr>

          @foreach($client->scopes as $scope)

            <tr>
              <td><em>{{ $scope->id }}</em><br>{{ $scope->description }}</td>
              <td>
                <form action="{{ route('oauth2-admin.clients.scopes.destroy', [$client->id, $scope->id]) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button type="submit" class="btn btn-danger btn-xs confirmlink col-xs-12">
                    {{ trans('oauth2::seat.delete') }}
                  </button>

                </form>
              </td>
            </tr>

          @endforeach

          </tbody>
        </table>

      @endif

    </div>
    <div class="panel-footer">
      {{ count($client->scopes) }} {{ trans_choice('oauth2::seat.scope', count($client->scopes)) }}
    </div>
  </div>
@stop

@section('javascript')

  @include('web::includes.javascript.id-to-name')

  <script>
    function formatScope (scope) {
      var $scope = $(
        '<div><strong>' + scope.text + '</strong></div><div>' + $(scope.element).data('description') + '</div>'
      );
      return $scope;
    };

    $("#available_scopes").select2({
       placeholder: "{{ trans('web::seat.select_item_add') }}",
       templateResult: formatScope
    });
  </script>

@stop