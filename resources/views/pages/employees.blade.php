@extends('layouts.acp-layout')
@section('title', 'Działy')

@php
    $user = auth()->user();
@endphp

@section('acp_content')
    <div class="container-fluid">
        <div class="content-header d-flex align-items-center">
            <h4>Pracownicy</h4>
            @if($user->hasRole('admin'))
                <a href="{{ route("employees.add") }}" class="btn btn-info ml-auto d-flex align-items-center">
                    <i class="ri-add-line mr-1"></i>
                    Dodaj pracownika
                </a>
            @endif
        </div>
        <div class="card">
            <div class="card-body p-0">
                @if($employees->count() > 0)
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Imię</th>
                                <th class="text-center">Nazwisko</th>
                                <th class="text-center">Obrazek</th>
                                <th class="text-center">Numer telefonu</th>
                                <th class="text-center">Adres e-mail</th>
                                <th class="text-center">Profil</th>
                                @if($user->hasRole('admin'))
                                    <th class="text-center">Zarządzanie</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td class="text-center">#{{ $employee->id }}</td>
                                    <td class="text-center">{{ $employee->firstname }}</td>
                                    <td class="text-center">{{ $employee->surname }}</td>
                                    <td class="text-center">
                                        @php
                                            $avatar = $employee->image_url ?: asset('assets/images/default_avatar.jpg');
                                        @endphp
                                        <div class="avatar">
                                            <img class="rounded-circle" src="{{ $avatar }}" alt="{{ $employee->firstname . " " . $employee->surname }}">
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $employee->phone_number }}</td>
                                    <td class="text-center">{{ $employee->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route("employees.show-employee", ["employee_id" => $employee->id]) }}" class="btn btn-primary d-inline-flex align-items-center">
                                            <i class="ri-pages-line mr-1"></i>
                                            Profil
                                        </a>
                                    </td>
                                    @if($user->hasRole('admin'))
                                        <td class="actions text-center">
                                            <a href="{{ route("employees.remove", ["employee_id" => $employee->id]) }}" class="btn btn-danger btn-sm d-inline-flex align-items-center mt-1 {{ $employee->id === $user->id ? "disabled" : "" }}">
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
                    {{ $employees->links() }}
                @else
                    <div class="py-4">
                        <h5 class="justify-content-center d-flex align-items-center">
                            <i class="ri-error-warning-line mr-2"></i>
                            Obecnie nie ma nic do wyświetlenia
                        </h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
