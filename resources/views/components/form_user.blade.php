<div class="p-3">
    <div class="row">
        <div class="col-6">
            <div class="form-check mb-2">
                <label for=""> Nama </label>
                <input type="text" value="{{ old('name') ?? $user->name }}" name="name" id="" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @if($user == null)
                <div class="form-check mb-2">
                    <label for=""> Password </label>
                    <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            <div class="form-check mb-2">
                <label for=""> Photo </label>
                <input type="file" name="photo" id="" class="form-control @error('photo') is-invalid @enderror">
                @error('photo')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-check mb-2">
                <label for=""> Email </label>
                <input type="email" name="email" value="{{ old('email') ?? $user->email }}" id="" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @if($user == null)
                <div class="form-check mb-2">
                    <label for=""> Konfirmasi Password </label>
                    <input type="password" name="password_confirmation" id="" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            <div class="form-check mb-2">
                <label for=""> Phone </label>
                <input type="text" name="phone" value="{{ old('phone') ?? $user->phone }}" id="" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-check mb-3">
                <label for="" id="textarea"> Alamat </label>
                <textarea name="alamat" id="" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') ?? $user->alamat }}</textarea>
                @error('phone')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror                
            </div>
            <div class="d-flex justify-content-end">
                @if($user == null)
                    <button type="submit" class="btn btn-info"> Tambah </button>
                @else
                    <button type="submit" class="btn btn-info"> Simpan Perubahan </button>
                @endif
            </div>
        </div>
    </div>
</div>
