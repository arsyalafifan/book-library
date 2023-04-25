@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('title', 'Form Member')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ isset($member) ? "Edit Member" : "Add Member" }}</h6>
    </div>
    <form action="{{ isset($member) ? route('member.add.update', $member->id) : route('member.add.store') }}" method="POST">
         @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ isset($member) ? $member->nama : '' }}">
                @if ($errors->has('nama'))
                    <span class="text-danger text-left">{{ $errors->first('nama') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ isset($member) ? $member->nim : '' }}">
                @if ($errors->has('nim'))
                    <span class="text-danger text-left">{{ $errors->first('nim') }}</span>
                @endif
            </div>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                    <input type="datetime-local" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="{{ isset($member) ? $member->tanggal_lahir : 'Tanggal Lahir' }}" value="{{ isset($member) ? $member->tanggal_lahir : '' }}" />
                    @if ($errors->has('tanggal_lahir'))
                        <span class="text-danger text-left">{{ $errors->first('tanggal_lahir') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                    <input type="datetime-local" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" placeholder="{{ isset($member) ? $member->tanggal_bergabung : 'Tanggal Bergabung' }}" value="{{ isset($member) ? $member->tanggal_bergabung : '' }}" />
                    @if ($errors->has('tanggal_bergabung'))
                        <span class="text-danger text-left">{{ $errors->first('tanggal_bergabung') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </form>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]");
</script>
@endpush