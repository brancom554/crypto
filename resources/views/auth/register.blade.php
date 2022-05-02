<?php
    $info = json_decode(json_encode(getIpInfo()), true);
    $country_code = @implode(',', $info['code']);
?>
@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-2">
      <div class="auth-inner my-2">
          <!-- Register Basic -->
          <div class="card mb-0">
              <div class="card-body">
                  <a href="#" class="col d-flex justify-content-center mb-1">
                      <img style="height:50px;" src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}"
                          alt="{{ __('locale.image')}}">
                      <div class="brand-text"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"
                              alt="{{ __('locale.image')}}"></div>
                  </a>

                  <h4 class="card-title mb-1">Adventure starts here 🚀</h4>
                  <p class="card-text mb-2">Register to access the trading platform!</p>

                  <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
                      @csrf
                      <div class="row">
                          <div class="col-lg-6 mb-1">
                              <label for="register-username" class="form-label">Username</label>
                              <input type="text" class="form-control @error('username') is-invalid @enderror"
                                  id="register-username" name="username" placeholder="johndoe"
                                  aria-describedby="register-username" tabindex="1" autofocus
                                  value="{{ old('username') }}" />
                              @error('username')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                          <div class="col-lg-6 m mb-1">
                              <label for="register-email" class="form-label">Email</label>
                              <input type="text" class="form-control @error('email') is-invalid @enderror"
                                  id="register-email" name="email" placeholder="john@example.com"
                                  aria-describedby="register-email" tabindex="2" value="{{ old('email') }}" />
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-6 mb-1">
                              <label for="register-password" class="form-label">Password</label>

                              <div
                                  class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                                  <input type="password"
                                      class="form-control form-control-merge @error('password') is-invalid @enderror"
                                      id="register-password" name="password"
                                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                      aria-describedby="register-password" tabindex="3" />
                                  <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                              </div>
                              @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>

                          <div class="col-lg-6 mb-1">
                              <label for="register-password-confirm" class="form-label">Confirm Password</label>

                              <div class="input-group input-group-merge form-password-toggle">
                                  <input type="password" class="form-control form-control-merge"
                                      id="register-password-confirm" name="password_confirmation"
                                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                      aria-describedby="register-password" tabindex="3" />
                                  <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                              </div>
                          </div>
                      </div>
              <div class="row">
                  <div class="mb-1 col-md-6">
                      <label class="form-label" for="firstname">First Name</label>
                      <input type="text" name="firstname" id="firstname"
                          class="form-control @error('firstname') is-invalid @enderror" placeholder="John"
                          aria-describedby="register-firstname" tabindex="4" autofocus value="{{ old('firstname') }}" />
                      @error('firstname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="mb-1 col-md-6">
                      <label class="form-label" for="lastname">Last Name</label>
                      <input type="text" name="lastname" id="lastname"
                          class="form-control @error('lastname') is-invalid @enderror" placeholder="Doe"
                          aria-describedby="register-lastname" tabindex="5" autofocus value="{{ old('lastname') }}" />
                      @error('lastname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6 mb-1">
                      <label class="form-label" for="mobile">Mobile number</label>
                      <div class="input-group">
                          <select name="country_code">
                              @include('partials.country_code')
                          </select>
                          <input type="text" name="mobile" id="mobile"
                              class="form-control @error('mobile') is-invalid @enderror mobile-number-mask"
                              placeholder="(472) 765-3654" aria-describedby="register-mobile" tabindex="6" autofocus
                              value="{{ old('mobile') }}" />
                      </div>
                      @error('mobile')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="mb-1 col-md-6">
                      <label class="form-label" for="country">Country</label>
                      <div class="input-group">
                          <span class="input-group-text h-100">
                              <i class="bi bi-globe"></i>
                          </span>
                          <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                              name="country" placeholder="Country" aria-describedby="country" tabindex="7"
                              value="{{ old('country') }}" required="" readonly="" />
                      </div>
                  </div>
              </div>
              <div class="col-12 mb-1">
                  <label class="form-label" for="address">Address</label>
                  <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                      placeholder="Address" aria-describedby="register-address" tabindex="8" autofocus
                      value="{{ old('address') }}" />
                  @error('address')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>

              <div class="col-12 mb-1">
                  <label class="form-label" for="town">Town</label>
                  <input type="text" name="town" id="town" class="form-control @error('town') is-invalid @enderror"
                      placeholder="Town, Area, Street, Sector, Village" aria-describedby="register-town" tabindex="9"
                      autofocus value="{{ old('town') }}" />
                  @error('town')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="row">
                  <div class="mb-1 col-md-8">
                      <label class="form-label" for="city">City</label>
                      <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror"
                          placeholder="City" aria-describedby="register-city" tabindex="10" autofocus
                          value="{{ old('city') }}" />
                      @error('city')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="col-md-4 mb-1">
                      <label class="form-label" for="zip">Zip code</label>
                      <input type="text" name="zip" id="zip"
                          class="form-control @error('zip') is-invalid @enderror zip-code-mask" placeholder="Code"
                          maxlength="6" aria-describedby="register-zip" tabindex="11" autofocus
                          value="{{ old('zip') }}" />
                      @error('zip')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
              </div>
              @if(session()->get('reference') != null)
              <div class="row">
                  <div class="col-12 mt-1">
                      <label for="multiStepsreferenceBy" class="form-label">Reference By</label>
                      <input type="text" class="form-control" id="multiStepsreferenceBy" name="multiStepsreferBy"
                          placeholder="johndoe" aria-describedby="referenceBy" tabindex="1" autofocus
                          value="{{session()->get('reference')}}" readonly />
                  </div>
              </div>
              @endif

              @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
              <div class="mb-1">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="terms" name="terms" tabindex="4" />
                      <label class="form-check-label" for="terms">
                          I agree to the <a href="{{ route('terms.show') }}" target="_blank">Terms of Service</a> and
                          <a href="{{ route('policy.show') }}" target="_blank">Privacy Policy</a>
                      </label>
                  </div>
              </div>
              @endif
              <button type="submit" class="btn btn-primary w-100" tabindex="5">Sign up</button>
              </form>

              <p class="text-center mt-2">
                  <span>Already have an account?</span>
                  @if (Route::has('login'))
                  <a href="{{ route('login') }}">
                      <span>Sign in instead</span>
                  </a>
                  @endif
              </p>

              {{-- <div class="divider my-2">
                  <div class="divider-text">or</div>
              </div>

              <div class="auth-footer-btn d-flex justify-content-center">
                  <a href="#" class="btn btn-facebook">
                      <i data-feather="facebook"></i>
                  </a>
                  <a href="#" class="btn btn-twitter white">
                      <i data-feather="twitter"></i>
                  </a>
                  <a href="#" class="btn btn-google">
                      <i data-feather="mail"></i>
                  </a>
                  <a href="#" class="btn btn-github">
                      <i data-feather="github"></i>
                  </a>
              </div> --}}
          </div>
      </div>
      <!-- /Register basic -->
  </div>
  </div>
@endsection
@push('script')
    <script>
      "use strict";
      @if($country_code)
        $(`option[data-code={{ $country_code }}]`).attr('selected','');
      @endif
        $('select[name=country_code]').change(function(){
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();
    </script>
@endpush
