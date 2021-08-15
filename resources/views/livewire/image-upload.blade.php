<div class="col-md-12">
  @if (!$image)
  <div class="text-center">
  <img width="160" class="mb-4 img-fluid rounded" src="https://lh3.googleusercontent.com/proxy/6JSP54y8h3gwi6BCeifU7ERS7lOeGguKUkaRnipDhEF5wo0sXrBtuW3aJ6qJ5qAp8iLUNzlv4vL1BGmVEdsHyo2MwmhRjR6t3b6_CulKSWLFCMyQ-R3wg7eSE7KiKF8XWyJK_OXBRybzcYt98OjGe52HQ1I-rSkJRcq1S0U2-SukqcIqulTZt0j4CEOS17scMZlUDONn4XRUOMp21od_wHrkRvsWoCRqctuRB9SJIALAcaOHV42YY8GnDrHd-24_x-rwFSoDi0MoVLV__p5H_cq57apCBHzEHI9nloWHnLWBUkb6CZKKvWVNagmtnF9m19MGDAZZ8o7ow6ZehdXhgWcwj4zwco3bGD4Y8M5gXox0ShpiId6v1RAHZwMUMutjDviBu-GWDza9dRbfvBIufU6MamZw72_as-ggn_TUzdm3h5ZN49BeNZm6rO425Bczy1vhArH8iO2bYdKoHcSaZV9s2XebMSeeOfdoHkeKWrCC9geaao8vfgUqER2o6S-HkDmbayhT2BWg6aMr28Rxxe0S4gameEVb0opZNtSSHOt_tYAYG4D9ZVwVf3wKxALte3vdIXI" alt="">
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
