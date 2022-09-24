<div class="row">
    <div class="col-6">
        <div class="form-group mb-2">
            <label for="" id="name"> Nama Produk </label>
            <input autocomplete="off" type="text" name="name" id="" value="{{ old('name') ?? $product->name }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="" id="price"> Harga Produk </label>
            <input autocomplete="off" type="number" name="price" id="" value="{{ old('price') ?? $product->price }}" class="form-control @error('price') is-invalid @enderror" >
            @error('price')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="" id="type"> Condition </label>
            <select type="text" name="condition" id="" class="form-control">
                <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}> New </option>    
                <option value="second" {{ $product->condition == 'second' ? 'selected' : '' }}> Second </option>
            </select>
            @error('condition')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group mb-2">
            <label for="" id="quantity"> Jumlah Produk </label>
            <input autocomplete="off"  type="number" name="quantity" id="" value="{{ old('quantity') ?? $product->quantity }}"  class="form-control @error('quantity') is-invalid @enderror">
            @error('quantity')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="" id="type"> Tipe </label>
            <select name="type_id" id="" class="form-control">
                <option value=""> Pilih Tipe </option>    
                @forelse($type as $t)
                    <option value="{{ $t->id }}" {{ $t->id == $product->type_id ? 'selected' : '' }}> {{ $t->name }} </option>
                @empty
                    <option disabled> Belum ada data tipe </option>
                @endforelse
            </select>
            @error('type')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-2">
            <label for="" id="brand"> Brand </label>
            <select name="brand_id" id="" class="form-control">
                <option disabled selected> Pilih Brand </option>    
                @forelse($brand as $b)
                    <option value="{{ $b->id }}" {{ $b->id == $product->brand_id ? 'selected' : '' }}> {{ $b->name }} </option>
                @empty
                    <option disabled> Belum ada data Brand </option>
                @endforelse
            </select>
            @error('brand')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group mb-2">
        <label for="" id="description"> Description Produk </label>
        <textarea id="ckeditor" name="description" id="" class="form-control">{!! $product->description !!}</textarea>
        @error('description')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>