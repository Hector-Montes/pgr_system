@extends('layouts.dashboard')
@section('page_title', 'Student Statuses')
@section('page_description', 'Current list of student statuses')
@section('content')
<div class="content">
  <div class="col-md-12">
    @component('components.datatable')
    @slot('tableId', 'admin-student-status-table')
      <th>Status</th>
      <th>Students</th>
      <td><i class="fa fa-cogs" aria-hidden="true"></i></td>
      <td><i class="fa fa-cogs" aria-hidden="true"></i></td>
    @endcomponent
    <div class="box box box-primary">
      <div class="box-body">
        <label>Create new Student Statuses</label>
        <form action="{{ route('settings.student-status.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} col-md-12">
            <input type="text" class="form-control" placeholder="Status" name="status" value="{{ old('status') }}">
            @if ($errors->has('status'))
            <span class="help-block">
              <strong>{{ $errors->first('status') }}</strong>
            </span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Add Student Status</button>
        </form>
      </div>
    </div>
    @if($deletedStatuses->isNotEmpty())
    <div class="box box box-primary">
      <div class="box-body">
        <div class="panel-heading">
          <h4 class="panel-title">
          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseone">Show Deleted Student Status
          </a>
          </h4>
        </div>
        <div id="collapseone" class="panel-collapse collapse">
          <div class="panel-body">
              @foreach($deletedStatuses as $status)
              <div class="col-md-12">
                <a href="{{ route('settings.student-status.restore', $status->slug()) }}">
                  <span class="btn btn-success">Restore</span>
                </a>
                {{ $status->status }}
              </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</li>
@endsection
