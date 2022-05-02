<x-jet-form-section submit="updateProfileInformation">
  <x-slot name="title">
    {{ __('Profile Information') }}
  </x-slot>

  <x-slot name="description">
    {{ __('Update your account\'s profile information and email address.') }}
  </x-slot>

  <x-slot name="form">

    <x-jet-action-message on="saved">
      {{ __('Saved.') }}
    </x-jet-action-message>

    <!-- Profile Photo -->
    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
      <div class="mb-1" x-data="{photoName: null, photoPreview: null}">
        <!-- Profile Photo File Input -->
        <input type="file" hidden wire:model="photo" x-ref="photo"
          x-on:change=" photoName = $refs.photo.files[0].name; const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result;}; reader.readAsDataURL($refs.photo.files[0]);" />

        <!-- Current Profile Photo -->
        <div class="mt-2" x-show="! photoPreview">
          <img src="{{ $this->user->profile_photo_url }}" class="rounded-circle" height="80px" width="80px">
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2" x-show="photoPreview">
          <img x-bind:src="photoPreview" class="rounded-circle" width="80px" height="80px">
        </div>

        <x-jet-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
          {{ __('Select A New Photo') }}
        </x-jet-secondary-button>

        @if ($this->user->profile_photo_path)
          <button type="button" class="btn btn-danger text-uppercase mt-2" wire:click="deleteProfilePhoto">
            {{ __('Remove Photo') }}
          </button>
        @endif

        <x-jet-input-error for="photo" class="mt-2" />
      </div>
    @endif

    <div class="row">
    <div class="col-md-4 col-sm-6 col-lg-4">
<!-- Firstname -->
    <div class="mb-1">
        <x-jet-label class="form-label" for="firstname" value="{{ __('Firstname') }}" />
        <x-jet-input id="firstname" type="text" class="{{ $errors->has('firstname') ? 'is-invalid' : '' }}"
          wire:model.defer="state.firstname" autocomplete="firstname" />
        <x-jet-input-error for="name" />
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-4">
<!-- Lastname -->
      <div class="mb-1">
          <x-jet-label class="form-label" for="lastname" value="{{ __('Lastname') }}" />
          <x-jet-input id="lastname" type="text" class="{{ $errors->has('lastname') ? 'is-invalid' : '' }}"
            wire:model.defer="state.lastname" autocomplete="lastname" />
          <x-jet-input-error for="lastname" />
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-4">
            <!-- Email -->
      <div class="mb-1">
          <x-jet-label class="form-label" for="email" value="{{ __('Email') }}" />
          <x-jet-input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
            wire:model.defer="state.email" />
          <x-jet-input-error for="email" />
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-lg-4">
      <!-- Address -->
    <div class="mb-1">
        <x-jet-label class="form-label" for="address" value="{{ __('Address') }}" />
        <x-jet-input id="address" type="text" class="{{ $errors->has('address') ? 'is-invalid' : '' }}"
          wire:model.defer="state.address" autocomplete="address" />
        <x-jet-input-error for="address" />
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-4">
      <!-- Town -->
    <div class="mb-1">
        <x-jet-label class="form-label" for="town" value="{{ __('Town') }}" />
        <x-jet-input id="town" type="text" class="{{ $errors->has('town') ? 'is-invalid' : '' }}"
          wire:model.defer="state.town" autocomplete="town" />
        <x-jet-input-error for="town" />
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-4">
      <!-- City -->
    <div class="mb-1">
        <x-jet-label class="form-label" for="city" value="{{ __('City') }}" />
        <x-jet-input id="city" type="text" class="{{ $errors->has('city') ? 'is-invalid' : '' }}"
          wire:model.defer="state.city" autocomplete="city" />
        <x-jet-input-error for="city" />
      </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6 col-lg-4">
      <!-- Twitter -->
    <div class="mb-1">
        <x-jet-label class="form-label" for="twitter" value="{{ __('Twitter') }}" />
        <x-jet-input id="twitter" type="text" class="border-twitter {{ $errors->has('twitter') ? 'is-invalid' : '' }}"
          wire:model.defer="state.twitter" autocomplete="twitter" placeholder="https://twitter.com/[username]" />
        <x-jet-input-error for="twitter" />
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-4">
      <!-- Facebook -->
    <div class="mb-1">
        <x-jet-label class="form-label" for="facebook" value="{{ __('Facebook') }}" />
        <x-jet-input id="facebook" type="text" class="border-facebook {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
          wire:model.defer="state.facebook" autocomplete="facebook" placeholder="https://facebook.com/[username]"/>
        <x-jet-input-error for="facebook" />
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-4">
      <!-- instagram -->
    <div class="mb-1">
        <x-jet-label class="form-label" for="instagram" value="{{ __('Instagram') }}" />
        <x-jet-input id="instagram" type="text" class="border-instagram {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
          wire:model.defer="state.instagram" autocomplete="instagram" placeholder="https://instagram.com/[username]" />
        <x-jet-input-error for="instagram" />
      </div>
    </div>
</div>
  </x-slot>

  @if (auth()->user()->role_id != 3)
  <x-slot name="actions">
    <div class="d-flex align-items-baseline">
      <x-jet-button>
        {{ __('Save') }}
      </x-jet-button>
    </div>
  </x-slot>
  @endif
</x-jet-form-section>
