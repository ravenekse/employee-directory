@extends('layouts.acp-layout')
@section('title', 'Dodawanie pracownika')

@section('acp_content')
    <div class="container-fluid">
        <div class="content-header d-flex align-items-center">
            <h4>Dodawanie pracownika</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-10 mx-auto">
                        <form action="{{ route("employess.add.form") }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <h6>Podstawowe informacje</h6>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" placeholder="Imię">
                                        @error('firstname')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" placeholder="Nazwisko">
                                        @error('surname')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Adres e-mail">
                                        @error('email')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Numer telefonu" data-inputmask="'mask': ['+48 999 999 999', '+48 999 999 999']" data-mask>
                                        @error('phone_number')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group border-danger">
                                            <select class="select2 @error('departments') is-invalid @enderror" multiple="multiple" name="departments[]" data-placeholder="Wybierz działy" style="width: 100%;">
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>



                                            @error('departments')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="user_image" accept="image/png,image/jpeg" value="{{ old('image') }}">
                                                <label class="custom-file-label" for="user_image">Wybierz obrazek</label>
                                            </div>
                                        </div>
                                        @error('image')
                                            <span class="error invalid-feedback @error('image') d-block @enderror">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <h6>Opis pracownika</h6>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control employee-description @error('description') is-invalid @enderror" name="description" placeholder="Napisz coś..." rows="12">{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
