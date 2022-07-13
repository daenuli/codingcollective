@extends('layouts.app')

@section('content')
<div class="box">
	<div class="box-header with-border">
        <a href="{{$url}}" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i> Back</a>
	</div>
    <form class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="{{$candidate->name}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" value="{{$candidate->email}}" disabled>
                    @error('email')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="phone_number" value="{{$candidate->phone_number}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Experience</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="experience" value="{{$candidate->experience}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Education</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="education" value="{{$candidate->education}}" disabled>
                    @error('education')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Birth Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="birth_date" value="{{$candidate->birth_date}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Last Position</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="last_position" value="{{$candidate->last_position}}" disabled>
                    @error('last_position')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Appied Position</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="applied_position" value="{{$candidate->applied_position}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Skill</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="skill" value="{{$candidate->skill}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Resume</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" name="file" autocomplete="off">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection