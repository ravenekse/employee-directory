@extends("layouts.acp-layout")
@section("title", "Ustawienia konta")

@section("acp_content")
    <div class="container-fluid">
        <div class="content-header d-flex align-items-center">
            <h4>Ustawienia konta</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-10 mx-auto">
                        <form action="{{ route("account-settings.change-details.form") }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <h6>Podstawowe informacje</h6>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error("firstname") is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" placeholder="Imię">
                                        @error("firstname")
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error("surname") is-invalid @enderror" name="surname" value="{{ $user->surname }}" placeholder="Nazwisko">
                                        @error("surname")
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control @error("email") is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="Adres e-mail">
                                        @error("email")
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control @error("phone_number") is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" placeholder="Numer telefonu" data-inputmask="'mask': ['+48 999 999 999', '+48 999 999 999']" data-mask>
                                        @error("phone_number")
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input @error("image") is-invalid @enderror" id="user_image" accept="image/png, image/jpeg">
                                                <label class="custom-file-label" for="user_image">Wybierz obrazek</label>
                                            </div>
                                        </div>
                                        @error("image")
                                            <span class="error invalid-feedback @error("image") d-block @enderror">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <h6>Opis konta</h6>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control employee-description @error("description") is-invalid @enderror" name="description" placeholder="Napisz coś..." rows="12">{{ $user->description }}</textarea>
                                        @error("description")
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4 mx-auto">
                                    <button type="submit" class="btn btn-success d-flex align-items-center">
                                        <i class="ri-save-2-line mr-1"></i>
                                        Zapisz ustawienia
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route("account-settings.change-password.form") }}" method="post">
                            @csrf
                            <div class="col-sm-12 col-md-12 col-lg-6 mt-4">
                                <h6>Zmiana hasła</h6>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control @error("old_password") is-invalid @enderror" name="old_password" placeholder="Stare hasło">
                                    @error("old_password")
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control @error("new_password") is-invalid @enderror" name="new_password" placeholder="Nowe hasło">
                                    @error("new_password")
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control @error("new_password_confirmation") is-invalid @enderror" name="new_password_confirmation" placeholder="Powtórz nowe hasło">
                                    @error("new_password_confirmation")
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success d-flex align-items-center mx-auto">
                                        <i class="ri-save-2-line mr-1"></i>
                                        Zmień hasło
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
