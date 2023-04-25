@extends('layouts.app')

@section('title', 'Manage Member')

@section('content')

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('member.add') }}" class="btn btn-primary mb-2">Add Member</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Anggota</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Tanggal Lahir</th>
                        <th>Tanggal Bergabung</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($number = 1)
                    @foreach ($members as $item)
                        <tr>
                            <td>
                                {{ $number++ }}
                            </td>
                            <td>
                                {{ $item->nomor_anggota}}
                            </td>
                            <td>
                                {{ $item->nama}}
                            </td>
                            <td>
                                {{ $item->nim}}
                            </td>
                            <td>
                                {{ $item->tanggal_lahir}}
                            </td>
                            <td>
                                {{ $item->tanggal_bergabung}}
                            </td>
                            <td>
                                <a href="{{ route('member.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('member.delete', $item->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection