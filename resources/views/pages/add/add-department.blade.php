@extends('layouts.acp-layout')
@section('title', 'Dodawanie działu')

@section('acp_content')
    <div class="container-fluid">
        <div class="content-header d-flex align-items-center">
            <h4>Dodawanie działu</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-8 mx-auto">
                        <h6>Podstawowe informacje</h6>
                        <form action="{{ route("departments.add.form") }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('department_name') is-invalid @enderror" name="department_name" value="{{ old('department_name') }}" placeholder="Nazwa działu">
                                @error('department_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <textarea class="form-control department-description @error('department_description') is-invalid @enderror" name="department_description" placeholder="Opis działu" rows="12">{{ old('department_description') }}</textarea>
                                @error('department_description')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success d-flex align-items-center mx-auto">
                                    <i class="ri-add-line mr-1"></i>
                                    Dodaj
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
