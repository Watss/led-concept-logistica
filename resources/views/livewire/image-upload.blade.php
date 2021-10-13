<div class="col-md-12">
    @if (!$image)
        <div class="text-center">
            <img width="160" class="mb-4 img-fluid rounded"
                src="{{asset($image)}}"
                alt="">
        </div>
    @endif

    @if ($image)
        <div class="text-center">
            <img width="160" class="mb-4 img-fluid rounded" src="{{ $image->temporaryUrl() }}">
        </div>

    @endif

    <input name="image" class="form-control form-control-sm" type="file" wire:model="image">

    @error('image') <span class="error">{{ $message }}</span> @enderror

</div>
