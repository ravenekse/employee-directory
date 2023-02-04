@extends('layouts.acp-layout')
@section('title', (str_starts_with($department->name, 'Dział') ? $department->name : "Dział {$department->name}"))

@section('acp_content')
    <div class="container-fluid">
        <div class="content-header d-flex align-items-center">
            <h4>Profil działu</h4>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">Informacje</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Nazwa działu:</strong>

                            <p class="m-0">
                                {{ $department->name }}
                            </p>
                        </div>
                        <hr>
                        <div class="d-block">
                            <strong>Opis:</strong>

                            <p class="m-0 mt-1">
                                {{ $department->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-7">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">Pracownicy</div>
                    </div>
                    <div class="card-body">
                        <ul>
                            @if($department->users->count() > 0)
                                @foreach($department->users as $employee)
                                    <li>
                                        <a href="{{ route("employees.show-employee", ["employee_id" => $employee->id]) }}">
                                            {{ $employee->firstname . " " . $employee->surname }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <div class="py-4">
                                    <h5 class="justify-content-center d-flex align-items-center">
                                        <i class="ri-error-warning-line mr-2"></i>
                                        Obecnie nikt nie pracuje w tym dziale
                                    </h5>
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
