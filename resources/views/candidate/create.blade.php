@extends('layouts.app')

@push('select2')
    <link rel="stylesheet" href="{{asset('AdminLTE-2.4.15/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('AdminLTE-2.4.15/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
    $('.datepicker').datepicker({
        format:'yyyy-mm-dd',
        autoclose: true
    });
  </script>
@endpush

@section('content')
<div class="box">
	<div class="box-header with-border">
        <a href="{{$url}}" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i> Back</a>
	</div>
    <form action="{{$action}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Ex: Amber Heard" autocomplete="off">
                    @error('name')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Ex: smith@gmail.com" autocomplete="off">
                    @error('email')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="phone_number" value="{{old('phone_number')}}" placeholder="Ex: 085123456789" autocomplete="off">
                    @error('phone_number')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Experience</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="experience" value="{{old('experience')}}" placeholder="Ex: 5" autocomplete="off">
                    @error('experience')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Education</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="education" value="{{old('education')}}" placeholder="Ex: UGM Yogyakarta" autocomplete="off">
                    @error('education')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Birth Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control datepicker" name="birth_date" value="{{old('birth_date')}}" placeholder="Ex: 1991-01-19" autocomplete="off">
                    @error('birth_date')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Last Position</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="last_position" value="{{old('last_position')}}" placeholder="Ex: Data Scientist" autocomplete="off">
                    @error('last_position')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Appied Position</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="applied_position" value="{{old('applied_position')}}" placeholder="Ex: Chief Information Officer" autocomplete="off">
                    @error('applied_position')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Skill</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="skill" value="{{old('skill')}}" placeholder="Ex: Laravel, Mysql, PostgreSQL, Codeigniter, Java" autocomplete="off">
                    @error('skill')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Resume File</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" name="resume_file" autocomplete="off">
                    @error('resume_file')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-8 col-sm-offset-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection