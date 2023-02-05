@extends("layouts.acp-layout")
@section("title", 'Działy')

@php
    $user = auth()->user();
@endphp

@section("acp_content")
    <div class="container-fluid">
        <div class="content-header d-flex align-items-center">
            <h4>Działy</h4>
            @if($user->hasRole("admin"))
                <a href="{{ route("departments.add") }}" class="btn btn-info ml-auto d-flex align-items-center">
                    <i class="ri-add-line mr-1"></i>
                    Dodaj dział
                </a>
            @endif
        </div>
        <div class="card">
            <div class="card-body p-0">
                @if($departments->count() > 0)
                    <div class="table-responsive">
                        <table class="table m-0" id="data-table">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nazwa działu</th>
                                    <th class="text-center">Opis działu</th>
                                    <th class="text-center">Profil</th>
                                    @if($user->hasRole("admin"))
                                        <th class="text-center">Zarządzanie</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td class="text-center">#{{ $department->id }}</td>
                                        <td class="text-center" style="min-width: 140px">{{ $department->name }}</td>
                                        <td class="text-center" style="min-width: 350px">{{ $department->description }}</td>
                                        <td class="text-center">
                                            <a href="{{ route("departments.show-department", ["department_id" => $department->id]) }}" class="btn btn-primary d-inline-flex align-items-center">
                                                <i class="ri-pages-line mr-1"></i>
                                                Profil
                                            </a>
                                        </td>
                                        @if($user->hasRole("admin"))
                                            <td class="actions text-center">
                                                <a href="{{ route("departments.remove", ["department_id" => $department->id]) }}" class="btn btn-danger btn-sm d-inline-flex align-items-center mt-1">
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
