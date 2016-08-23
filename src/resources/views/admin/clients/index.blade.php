@extends('web::layouts.grids.3-9')

@section('title', trans('oauth2::seat.oauth2_admin'))
@section('page_header', trans('oauth2::seat.oauth2_admin'))

@section('left')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('oauth2::seat.new_client') }}</h3>
    </div>
    <div class="panel-body">

      <form role="form" action="{{ route('oauth2-admin.clients.store') }}" method="post" id="client-form">
        {{ csrf_field() }}

        <div class="box-body">

          <div class="form-group">
            <label for="comment">{{ trans('oauth2::seat.name') }}</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
          </div>

          <div class="form-group">
            <label for="comment">{{ trans('oauth2::seat.client_id') }}</label>
            <input type="text" name="id" class="form-control" id="id" value="{{ old('id') }}">
          </div>

          <div class="form-group">
            <label for="text">{{ trans('oauth2::seat.client_secret') }}</label>
            <input type="text" name="secret" class="form-control" id="secret" value="{{ old('secret') }}">
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">
            {{ trans('oauth2::seat.add') }}
          </button>
        </div>
      </form>

    </div>
  </div>

@stop

@section('right')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans_choice('oauth2::seat.client', 2) }}</h3>
    </div>
    <div class="panel-body">

      <table class="table table-condensed table-hover table-responsive">
        <tbody>
          <tr>
            <th>{{ trans('oauth2::seat.name') }}</th>
            <th>{{ trans('oauth2::seat.client_id') }}</th>
            <th>{{ trans('oauth2::seat.client_secret') }}</th>
          </tr>

        @foreach($clients as $client)

          <tr>
            <td>{{ $client->name }}</td>
            <td>{{ $client->id }}</td>
            <td>{{ $client->secret }}</td>
            <td>
                <a href="{{ route('oauth2-admin.clients.show', [$client->id]) }}" type="button" class="btn btn-primary btn-xs">
                  {{ trans('oauth2::seat.view') }}
                </a>

                <form action="{{ route('oauth2-admin.clients.destroy', [$client->id]) }}" method="POST" class="inline">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button type="submit" class="btn btn-danger btn-xs confirmlink">
                    {{ trans('oauth2::seat.delete') }}
                  </button>

                </form>
            </td>
          </tr>

        @endforeach

        </tbody>
      </table>

    </div>
    <div class="panel-footer">
      {{ count($clients) }} {{ trans_choice('oauth2::seat.client', count($clients)) }}
    </div>
  </div>
@stop