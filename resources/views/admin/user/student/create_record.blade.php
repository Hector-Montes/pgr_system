@if ($errors->has('university_id'))
<script>
window.location = "{{ route('student.find') }}";
</script>
@endif
@extends('layouts.dashboard')
@section('page_title', 'Create New Student Record')
@section('page_description', '')
@section('content')
<div class="content">
  <div class="box box box-primary">
    <div class="box-body">
      <label>Create new Student Record</label>
      <form action="{{ route('student.record.store',
        ($student ? $student->university_id : old('university_id'))) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="university_id" value="{{
        $student ? $student->university_id : old('university_id') }}">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('funding_type_id') ? ' has-error' : '' }}">
            <label for="funding_type_id">Funding Type</label>
            <select class="form-control" name="funding_type_id">
              <option value="">--- Select ---</option>
              @foreach($funding_types as $t)
              <option value="{{ $t->id }}"
                @if( old('funding_type_id') == $t->id )
                selected="selected"
                @endif>
                {{ $t->name }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('funding_type_id'))
            <span class="help-block">
              <strong>{{ $errors->first('funding_type_id') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('school_id') ? ' has-error' : '' }}">
            <label for="school_id">School</label>
            <select class="form-control" name="school_id">
              <option value="">--- Select ---</option>
              @foreach($schools as $s)
              <option value="{{ $s->id }}"
                @if( old('school_id') == $s->id )
                selected="selected"
                @endif>
                {{ $s->name }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('school_id'))
            <span class="help-block">
              <strong>{{ $errors->first('school_id') }}</strong>
            </span>
            @endif
          </div>
          
          <div class="form-group{{ $errors->has('enrolment_status_id') ? ' has-error' : '' }}">
            <label for="enrolment_status_id">Enrolment Status</label>
            <select class="form-control" name="enrolment_status_id">
              <option value="">--- Select ---</option>
              @foreach($enrolment_statuses as $es)
              <option value="{{ $es->id }}"
                @if( old('enrolment_status_id') == $es->id )
                selected="selected"
                @endif>
                {{ $es->status }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('enrolment_status_id'))
            <span class="help-block">
              <strong>{{ $errors->first('enrolment_status_id') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('student_status_id') ? ' has-error' : '' }}">
            <label for="student_status_id">Student Status</label>
            <select class="form-control" name="student_status_id">
              <option value="">--- Select ---</option>
              @foreach($student_statuses as $t)
              <option value="{{ $t->id }}"
                @if( old('student_status_id') == $t->id )
                selected="selected"
                @endif>
                {{ $t->status }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('student_status_id'))
            <span class="help-block">
              <strong>{{ $errors->first('student_status_id') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('programme_id') ? ' has-error' : '' }}">
            <label for="programme_id">Programme</label>
            <select class="form-control" name="programme_id">
              <option value="">--- Select ---</option>
              @foreach($programmes as $p)
              <option value="{{ $p->id }}"
                @if( old('programme_id') == $p->id )
                selected="selected"
                @endif>
                {{ $p->name }}
              </option>
              @endforeach
            </select>
            @if ($errors->has('programme_id'))
            <span class="help-block">
              <strong>{{ $errors->first('programme_id') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('enrolment_date') ? ' has-error' : '' }}">
            <label for="enrolment_date">Enrolment Date</label>
            <input type="hidden"
            name="enrolment_date"
            id="enrolment_date"
            value="{{ old('enrolment_date') }}">
            <div id="datepicker-container">
              <div id="datepicker-center">
                <div id="datepicker">
                </div>
              </div>
            </div>
            @if ($errors->has('enrolment_date'))
            <span class="help-block">
              <strong>{{ $errors->first('enrolment_date') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('tierFour') ? ' has-error' : '' }}">
            <label class="radio control-label">TierFour</label>
            <label class="radio-inline">
              <input type="radio" name="tierFour" value="1" {{ old('tierFour') === '1' ? 'checked="checked"' : '' }}>
              Yes
            </label>
            <label class="radio-inline">
              <input type="radio" name="tierFour" value="0" {{ old('tierFour') === '0' ? 'checked="checked"' : '' }}>
              No
            </label>
            @if ($errors->has('tierFour'))
            <span class="help-block">
              <strong>{{ $errors->first('tierFour') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Add New Student Record</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection