<form action=" {{ route('url.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-5">
            <input
                type="url"
                id="long_url"
                name="long_url"
                class="form-control @error('long_url') is-invalid @enderror"
                placeholder="{{ __('url.long_url') }}"
                required
            >
            @error('long_url')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-5">
            <input
                type="text"
                id="keyword"
                name="keyword"
                class="form-control @error('keyword') is-invalid @enderror"
                placeholder="{{ __('url.short_url') }}"
            >
            @error('keyword')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-2">
            <input
                type="checkbox"
                id="private"
                name="private"
                value="1"
                class="form-check-input @error('private') is-invalid @enderror"
            >
            <label for="private" class="form-check-label">
                {{ __('url.is_private') }}
            </label>
            @error('private')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <textarea
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="{{ __('url.description') }}"
            ></textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">
                {{ __('url.shorten') }}
            </button>
        </div>
    </div>
</form>
