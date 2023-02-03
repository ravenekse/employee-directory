@extends('layouts.acp-layout')
@section('title', 'Dashboard')

@php
    $user = auth()->user();
@endphp

@section('acp_content')
    <div class="container-fluid">
        <div class="content-header d-flex align-items-center">
            <h4>Działy</h4>
            @if($user->hasRole('admin'))
                <a href="{{ route("admin.add.department") }}" class="btn btn-info ml-auto d-flex align-items-center">
                    <i class="ri-add-line mr-1"></i>
                    Dodaj dział
                </a>
            @endif
        </div>
                <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa działu</th>
                            <th>Opis działu</th>
                            @if($user->hasRole('admin'))
                                <th class="text-center">Zarządzanie</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>#{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->description }}</td>
                                @if($user->hasRole('admin'))
                                    <td class="actions text-center">
                                        <a href="#" class="btn btn-danger btn-sm mr-auto d-inline-flex align-items-center">
                                            <i class="ri-delete-bin-line mr-1"></i>
                                            Usuń
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
