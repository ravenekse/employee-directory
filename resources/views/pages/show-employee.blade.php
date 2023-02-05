@extends("layouts.acp-layout")
@section("title", "Profil {$employee->firstname} {$employee->surname}")

@php
    $name = "{$employee->firstname} {$employee->surname}";
    $avatar = $employee->image_url ?: asset("assets/images/default_avatar.jpg");
@endphp

@section("acp_content")
    <div class="container-fluid">
        <div class="content-header d-flex align-items-center">
            <h4>Profil pracownika</h4>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-5">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="{{ $avatar }}" alt="{{ $name }}" class="profile-user-img img-fluid img-circle">
                        </div>

                        <h3 class="profile-username text-center">{{ $name }}</h3>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">Informacje</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Rola:</strong>

                            <p class="m-0">
                                {{ $employee->hasRole("admin") ? "Administrator" : "Pracownik" }}
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Numer telefonu:</strong>

                            <p class="m-0">
                                {{ $employee->phone_number }}
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Adres e-mail:</strong>

                            <p class="m-0">
                                {{ $employee->email }}
                            </p>
                        </div>
                        <hr>
                        <div class="d-block">
                            <strong>Opis:</strong>

                            <p class="m-0 mt-1">
                                {{ $employee->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-7">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">Działy w których pracuje {{ $name }}</div>
                    </div>
                    <div class="card-body">
                        <ul>
                            @if($employee->departments->count() > 0)
                                @foreach($employee->departments as $department)
                                    <li>
                                        <a href="{{ route("departments.show-department", ["department_id" => $department->id]) }}">
                                            {{ $department->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <div class="py-4">
                                    <h5 class="justify-content-center d-flex align-items-center">
                                        <i class="ri-error-warning-line mr-2"></i>
                                        Ten pracownik nie jest przypisany do żadnego działu
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
