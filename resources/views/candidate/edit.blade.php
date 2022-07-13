@extends('layouts.app')

@section('content')
@if (session()->has('success'))
    <div class="callout callout-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p>{!!session('success')!!}</p>
    </div>
@endif
<div class="box">
	<div class="box-header with-border">
        <a href="{{$url}}" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i> Back</a>
	</div>
    <form action="{{$action}}" method="POST" class="form-horizontal">
    <input type="hidden" name="_method" value="PUT">
    @csrf
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="{{$candidate->name}}" autocomplete="off">
                    @error('name')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" value="{{$candidate->email}}" placeholder="Ex: smith@gmail.com" autocomplete="off">
                    @error('email')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="phone_number" value="{{$candidate->phone_number}}" placeholder="Ex: 085123456789" autocomplete="off">
                    @error('phone_number')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Experience</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="experience" value="{{$candidate->experience}}" placeholder="Ex: 5" autocomplete="off">
                    @error('experience')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Education</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="education" value="{{$candidate->education}}" placeholder="Ex: UGM Yogyakarta" autocomplete="off">
                    @error('education')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Birth Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control datepicker" name="birth_date" value="{{$candidate->birth_date}}" placeholder="Ex: 1991-01-19" autocomplete="off">
                    @error('birth_date')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Last Position</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="last_position" value="{{$candidate->last_position}}" placeholder="Ex: Data Scientist" autocomplete="off">
                    @error('last_position')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Appied Position</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="applied_position" value="{{$candidate->applied_position}}" placeholder="Ex: Chief Information Officer" autocomplete="off">
                    @error('applied_position')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Skill</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="skill" value="{{$candidate->skill}}" placeholder="Ex: Laravel, Mysql, PostgreSQL, Codeigniter, Java" autocomplete="off">
                    @error('skill')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Resume</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" name="file" autocomplete="off">
                    @error('file')
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