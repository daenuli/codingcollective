@extends('layouts.app')

@section('content')
<div class="box">
	<div class="box-header with-border">
        <a href="{{$url}}" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i> Back</a>
	</div>
    <form action="{{$action}}" method="POST" class="form-horizontal">
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
                <label class="col-sm-2 control-label">Role</label>
                <div class="col-sm-8">
                    <div class="radio">
                        <label>
                            <input type="radio" name="role" id="optionsRadios1" value="senior_hrd" {{(old('role') == 'senior_hrd') ? 'checked' : ''}}>
                            Senior HRD
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="role" id="optionsRadios2" value="hrd" {{(old('role') == 'hrd') ? 'checked' : ''}}>
                            HRD
                        </label>
                    </div>
                    @error('role')
                        <p class="text-red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" autocomplete="off">
                    @error('password')
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