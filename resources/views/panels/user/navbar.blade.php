@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
  <nav
    class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
    data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="{{ url('/') }}">
            <span class="brand-logo">
              <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                <defs>
                  <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                    <stop stop-color="#000000" offset="0%"></stop>
                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                  </lineargradient>
                  <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                  </lineargradient>
                </defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                    <g id="Group" transform="translate(400.000000, 178.000000)">
                      <path class="text-primary" id="Path"
                        d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                        style="fill:currentColor"></path>
                      <path id="Path1"
                        d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                        fill="url(#linearGradient-1)" opacity="0.2"></path>
                      <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                        points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                      <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                        points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                      <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                        points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                    </g>
                  </g>
                </g>
              </svg>
            </span>
            <h2 class="brand-text mb-0"></h2>
          </a>
        </li>
      </ul>
    </div>
  @else
    <nav
      class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
@endif
<div class="navbar-container d-flex content">
  <div class="bookmark-wrapper d-flex align-items-center">
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="bi bi-list font-medium-5"></i></i></a></li>
    </ul>
    @if (Request::is('**/trade*', '**/practice*'))
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a id="watcher" class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStart" aria-controls="offcanvasStart"><i class="bi bi-bookmark font-medium-5"></i>
            </a>
        </li>
    </ul>
    @endif
    @if(Request::is('**profile'))
    @else
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link bookmark-star">
                <i class="ficon bi bi-search font-medium-5"></i>
            </a>
            <div class="bookmark-input search-input">
                <div class="bookmark-input-icon">
                    <i class="bi bi-search"></i>
                </div>
                <input class="form-control input" type="text" placeholder="Explore Coins ..." tabindex="0"
                    data-search="coinlist">
                <ul class="search-list search-list-bookmark"></ul>
            </div>
        </li>
    </ul>
    {{-- <ul class="nav navbar-nav">
        <li class="nav-item nav-search">
        <a class="nav-link nav-link-search">
            <i class="ficon bi bi-search font-medium-5"></i>
        </a>
          <div class="search-input">
            <div class="search-input-icon"><i class="bi bi-search"></i></div>
            <input class="form-control input" type="text" placeholder="Explore Coins..." tabindex="-1" data-search="coinlist">
            <div class="search-input-close"><i class="bi bi-x-lg"></i></div>
            <ul class="search-list search-list-main"></ul>
          </div>
        </li>
    </ul> --}}
    @endif
  </div>

  <ul class="nav navbar-nav align-items-center ms-auto">
      <li class="nav-item dropdown">
        @if (Request::is('**/trade*'))
        <button type="button" class="btn btn-icon btn-outline-success mx-1" data-bs-toggle="collapse" data-bs-target="#Wallet"><span class="text-success">Trade: {{$general->cur_sym}} <livewire:partials.balance /></span></button>
        @elseif (Request::is('**/practice*'))
        <button type="button" class="btn btn-icon btn-outline-warning mx-1" data-bs-toggle="collapse" data-bs-target="#Wallet"><span class="text-warning">Practice: {{$general->cur_sym}} <livewire:partials.practice-balance /></span></button>
        @else
            <button type="button" class="btn btn-icon btn-outline-secondary mx-1" data-bs-toggle="collapse" data-bs-target="#Wallet"><span class="text-secondary">Select Wallet</span></button>
        @endif
    </li>

      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user"
            href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true">
            <div class="user-nav d-md-flex d-none">
                <span class="user-name fw-bolder">
                    @if (Auth::check())
                    {{ Auth::user()->name }}
                    @else
                    John Doe
                    @endif
                </span>
                <span class="user-status">
                    @if (auth()->user()->role_id == 1)
                                    Admin
                                @else
                                {{ set_id(auth()->user()->id) }}659512
                                @endif
                </span>
            </div>
            <span class="avatar">
                <img class="round"
                    src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('images/portrait/small/avatar-s-11.jpg') }}"
                    alt="avatar" height="40" width="40">
                <span class="avatar-status-online"></span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <h6 class="dropdown-header">Manage Profile</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item"
                href="{{ Route::has('user.profile.show') ? route('user.profile.show') : 'javascript:void(0)' }}">
                <i class="bi bi-person-circle me-50"></i> Profile
            </a>
            <a class="dropdown-item"
                href="{{ Route::has('ticket') ? route('ticket') : 'javascript:void(0)' }}">
                <i class="bi bi-person-circle me-50"></i> Support
            </a>
            @if (Auth::check())
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-in-left me-50"></i> Logout
            </a>
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
            </form>
            @endif
    </li>
  </ul>
</div>
</nav>
<!-- END: Header-->
<div class="modal fade text-start" id="addWatchlist" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('locale.Add Crypto Currency')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('user.watchlist.store')}}" method="POST">
                <input type="hidden" id="inputfav" name="id">
                <div class="modal-body">
                    <p>{{ __('locale.Are you sure want to watchlist this coin')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                    <button type="submit" class="btn btn-success">{{ __('locale.Add')}}</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
<style>
    .bg-wallet {
        background-color: #2e385142
    }
    .bg-wallet:hover {
        background-color: #2e3851b7
    }
    .bg-wallet-active {
        background-color: #2e3851c4
    }
    .bg-wallet-active:hover {
        background-color: #2e3851
    }
</style>
<div id="Wallet" class="collapse position-absolute sticky-top end-0" style="top:65px;">
    <div class="card" style="background:#131722!important;box-shadow: 0 4px 24px 0 rgb(0 0 0 / 30%);">
        <div class="card-body">
            @if (Request::is('**/trade*'))
                <livewire:wallet.wallet />
            @elseif (Request::is('**/practice*'))
                <livewire:wallet.practice-wallet />
            @else
                <livewire:wallet.practice-wallet />
            @endif
        </div>
    </div>
</div>
<div class="modal fade custom--modal" id="practiceAmount">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('locale.Add Practice Balance')}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <form class="deposit-form" action="{{route('user.add.practice.balance')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>{{ __('locale.Are you sure you want to add practice balance')}}?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm text--white btn-danger" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                    <button type="submit" class="btn btn-primary btn-sm text--white btn-success">{{ __('locale.Confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (Request::is('**/trade*', '**/practice*'))
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasStart" aria-labelledby="offcanvasStartLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasStartLabel" class="offcanvas-title">Watchlist</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body mb-automx-0 flex-grow-0">
        <div id="watchlist" v-cloak></div>
        <div id="watched" class="@foreach ($watchlists as $watchlist){{ $watchlist->symbol }}|@endforeach"></div>
    </div>
</div>
<div id="deleteWatchlist" class="modal fade text-start" tabindex="-1" aria-hidden="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('locale.Delete Confirmation')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('user.watchlist.delete')}}" method="POST">
                @csrf
                <input type="hidden" name="id" id="bk">
                <div class="modal-body">
                    <p>{{ __('locale.Are you sure want to remove this coin from watchlist')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                    <button type="submit" class="btn btn-success">{{ __('locale.Delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@push('style')
<style>
.bookmarked {
    color: chocolate;
}
.bookmarked:hover {
    color: crimson;
}
</style>
@endpush
@push('script')
<script>
$(document).on("click", "#bookmarked", function () {
    document.getElementById('bk').value = document.getElementById('bookmarked').name;
});
$("#watcher").click(function(){
  $.getScript("{{ asset(mix('js/watchlist.js')) }}");
});
var assetPath = '../../../app-assets/'

if ($('body').attr('data-framework') === 'laravel') {
  assetPath = $('body').attr('data-asset-path')
}
  let url = window.location.href;
  if (url.includes('practice')) {
      var walletPath = 'user/practice/'
  } else if (url.includes('trade')) {
      var walletPath = 'user/trade/'
  } else {
    var walletPath = 'user/exchange/'
  }
  var $filename = $('.search-input input').data('search'),
    bookmarkWrapper = $('.bookmark-wrapper'),
    bookmarkStar = $('.bookmark-wrapper .bookmark-star'),
    bookmarkInput = $('.bookmark-wrapper .bookmark-input'),
    navLinkSearch = $('.nav-link-search'),
    searchInput = $('.search-input'),
    searchInputInputfield = $('.search-input input'),
    searchList = $('.search-input .search-list'),
    appContent = $('.app-content'),
    bookmarkSearchList = $('.bookmark-input .search-list')

  // Bookmark icon click
  bookmarkStar.on('click', function (e) {
    e.stopPropagation()
    bookmarkInput.toggleClass('show')
    bookmarkInput.find('input').val('')
    bookmarkInput.find('input').blur()
    bookmarkInput.find('input').focus()
    bookmarkWrapper.find('.search-list').addClass('show')

    var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
      $arrList = '',
      $activeItemClass = ''

    $('ul.search-list li').remove()

    for (var i = 0; i < arrList.length; i++) {
      if (i === 0) {
        $activeItemClass = 'current_item'
      } else {
        $activeItemClass = ''
      }

      var iconName = '',
        className = ''
      if ($(arrList[i].firstChild.firstChild).hasClass('feather')) {
        var classString = arrList[i].firstChild.firstChild.getAttribute('class')
        iconName = classString.split('feather-')[1].split(' ')[0]
        className = classString.split('feather-')[1].split(' ')[1]
      }

      $arrList +=
        '<li class="auto-suggestion ' +
        $activeItemClass +
        '">' +
        '<a class="d-flex align-items-center justify-content-between w-100" href=' +
        arrList[i].firstChild.href +
        '>' +
        '<div class="d-flex justify-content-start align-items-center">' +
        '<span>' +
        arrList[i].firstChild.dataset.bsOriginalTitle +
        '</span>' +
        '</div>' +
        '<i class="bi bi-bookmark text-warning bookmark-icon float-end"></i>' +
        '</a>' +
        '</li>'
    }

    $('ul.search-list').append($arrList)
  })

  // Navigation Search area Open
  navLinkSearch.on('click', function () {
    var $this = $(this)
    var searchInput = $(this).parent('.nav-search').find('.search-input')
    searchInput.addClass('open')
    searchInputInputfield.focus()
    searchList.find('li').remove()
    bookmarkInput.removeClass('show')
  })

  // Navigation Search area Close
  $('.search-input-close').on('click', function () {
    var $this = $(this),
      searchInput = $(this).closest('.search-input')
    if (searchInput.hasClass('open')) {
      searchInput.removeClass('open')
      searchInputInputfield.val('')
      searchInputInputfield.blur()
      searchList.removeClass('show')
      appContent.removeClass('show-overlay')
    }
  })

  // Filter
  if ($('.search-list-main').length) {
    var searchListMain = new PerfectScrollbar('.search-list-main', {
      wheelPropagation: false
    })
  }
  if ($('.search-list-bookmark').length) {
    var searchListBookmark = new PerfectScrollbar('.search-list-bookmark', {
      wheelPropagation: false
    })
  }
  // update Perfect Scrollbar on hover
  $('.search-list-main').mouseenter(function () {
    searchListMain.update()
  })

  searchInputInputfield.on('keyup', function (e) {
    $(this).closest('.search-list').addClass('show')
    if (e.keyCode !== 38 && e.keyCode !== 40 && e.keyCode !== 13) {
      if (e.keyCode == 27) {
        appContent.removeClass('show-overlay')
        bookmarkInput.find('input').val('')
        bookmarkInput.find('input').blur()
        searchInputInputfield.val('')
        searchInputInputfield.blur()
        searchInput.removeClass('open')
        if (searchInput.hasClass('show')) {
          $(this).removeClass('show')
          searchInput.removeClass('show')
        }
      }

      // Define variables
      var value = $(this).val().toLowerCase(), //get values of input on keyup
        activeClass = '',
        bookmark = false,
        liList = $('ul.search-list li') // get all the list items of the search
      liList.remove()
      // To check if current is bookmark input
      if ($(this).parent().hasClass('bookmark-input')) {
        bookmark = true
      }

      // If input value is blank
      if (value != '') {
        appContent.addClass('show-overlay')

        // condition for bookmark and search input click
        if (bookmarkInput.focus()) {
          bookmarkSearchList.addClass('show')
        } else {
          searchList.addClass('show')
          bookmarkSearchList.removeClass('show')
        }
        if (bookmark === false) {
          searchList.addClass('show')
          bookmarkSearchList.removeClass('show')
        }

        var $startList = '',
          $otherList = '',
          $htmlList = '',
          $bookmarkhtmlList = '',
          $pageList =
            '<li class="d-flex align-items-center">' +
            '<a href="#">' +
            '<h6 class="section-label mt-75 mb-0">Pages</h6>' +
            '</a>' +
            '</li>',
          $activeItemClass = '',
          $bookmarkIcon = '',
          $defaultList = '',
          a = 0

        // getting json data from file for search results
        $.getJSON(assetPath + 'data/' + $filename + '.json', function (data) {
          for (var i = 0; i < data.data.length; i++) {
            // if current is bookmark then give class to star icon
            // for laravel
            if ($('body').attr('data-framework') === 'laravel') {
              data.data[i].url = assetPath + walletPath + data.data[i].symbol + '/USDT'
            }

            if (bookmark === true) {
              activeClass = '' // resetting active bookmark class
              var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
                $arrList = ''
              // Loop to check if current seach value match with the bookmarks already there in navbar
              for (var j = 0; j < arrList.length; j++) {
                if (data.data[i].name === arrList[j].firstChild.dataset.bsOriginalTitle) {
                  activeClass = ' text-warning'
                  break
                } else {
                  activeClass = ''
                }
              }

              $bookmarkIcon = '<a id="" data-bs-toggle="modal" data-bs-target="#addWatchlist" id="coinfav" data-id="' + data.data[i].symbol + '" data-name="' + data.data[i].symbol + '" data-symbol="' + data.data[i].symbol + '"><i class="bi bi-bookmark bookmark-icon float-end ' + activeClass + '"></i></a>'
            }
            // Search list item start with entered letters and create list
            if (data.data[i].symbol.toLowerCase().indexOf(value) == 0 && a < 5 && data.data[i].status == 1) {
              if (a === 0) {
                $activeItemClass = 'current_item'
                document.getElementById('inputfav').value = data.data[i].symbol;
              } else {
                $activeItemClass = ''
              }
              $startList +=
                '<li class="auto-suggestion ' +
                $activeItemClass +
                '">' +
                '<a class="d-flex align-items-center justify-content-between w-100" href=' +
                data.data[i].url +
                '>' +
                '<div class="d-flex justify-content-start align-items-center">' +
              '<img class="me-1" style="height:30px;width:30px;" src="/assets/images/cryptoCurrency/'+(data.data[i].image).toLowerCase()+'"></img>' +
              '<span class="me-1">' +
                  data.data[i].name +
                  '</span>' +
                  '<span>' +
                  data.data[i].symbol +
                  '</span>' +
                '</div>' +
                $bookmarkIcon +
                '</a>' +
                '</li>'
              a++
            }
          }
          for (var i = 0; i < data.data.length; i++) {
            if (bookmark === true) {
              activeClass = '' // resetting active bookmark class
              var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
                $arrList = ''
              // Loop to check if current search value match with the bookmarks already there in navbar
              for (var j = 0; j < arrList.length; j++) {
                if (data.data[i].name === arrList[j].firstChild.dataset.bsOriginalTitle) {
                  activeClass = ' text-warning'
                } else {
                  activeClass = ''
                }
              }

              $bookmarkIcon = '<a data-bs-toggle="modal" data-bs-target="#addWatchlist" data-id="' + data.data[i].symbol + '" data-name="' + data.data[i].symbol + '" data-symbol="' + data.data[i].symbol + '"><i class="bi bi-bookmark bookmark-icon float-end ' + activeClass + '"></i></a>'
            }
            // Search list item not start with letters and create list
            if (
              !(data.data[i].name.toLowerCase().indexOf(value) == 0) &&
              data.data[i].name.toLowerCase().indexOf(value) > -1 &&
              a < 5
            ) {
              if (a === 0) {
                $activeItemClass = 'current_item'
              } else {
                $activeItemClass = ''
              }
              $otherList +=
                '<li class="auto-suggestion ' +
                $activeItemClass +
                '">' +
                '<a class="d-flex align-items-center justify-content-between w-100" href=' +
                data.data[i].url +
                '>' +
                '<div class="d-flex justify-content-start align-items-center">' +
                '<span>' +
                data.data[i].name +
                '</span>' +
                '</div>' +
                $bookmarkIcon +
                '</a>' +
                '</li>'
              a++
            }
          }
          $defaultList = $('.main-search-list-defaultlist').html()
          if ($startList == '' && $otherList == '') {
            $otherList = $('.main-search-list-defaultlist-other-list').html()
          }
          // concatinating startlist, otherlist, defalutlist with pagelist
          $htmlList = $pageList.concat($startList, $otherList, $defaultList)
          $('ul.search-list').html($htmlList)
          // concatinating otherlist with startlist
          $bookmarkhtmlList = $startList.concat($otherList)
          $('ul.search-list-bookmark').html($bookmarkhtmlList)
          // Feather Icons
          // if (feather) {
          //   featherSVG();
          // }
        })
      } else {
        if (bookmark === true) {
          var arrList = $('ul.nav.navbar-nav.bookmark-icons li'),
            $arrList = ''
          for (var i = 0; i < arrList.length; i++) {
            if (i === 0) {
              $activeItemClass = 'current_item'
            } else {
              $activeItemClass = ''
            }

            var iconName = '',
              className = ''
            if ($(arrList[i].firstChild.firstChild).hasClass('feather')) {
              var classString = arrList[i].firstChild.firstChild.getAttribute('class')
              iconName = classString.split('feather-')[1].split(' ')[0]
              className = classString.split('feather-')[1].split(' ')[1]
            }
            $arrList +=
              '<li class="auto-suggestion">' +
              '<a class="d-flex align-items-center justify-content-between w-100" href=' +
              arrList[i].firstChild.href +
              '>' +
              '<div class="d-flex justify-content-start align-items-center">' +
              '<span>' +
              arrList[i].firstChild.dataset.bsOriginalTitle +
              '</span>' +
              '</div>' +
              '<i class="bi bi-bookmark bookmark-icon float-end text-warning"></i>'
              '</a>' +
              '</li>'
          }
          $('ul.search-list').append($arrList)
          // Feather Icons
          // if (feather) {
          //   featherSVG();
          // }
        } else {
          // if search input blank, hide overlay
          if (appContent.hasClass('show-overlay')) {
            appContent.removeClass('show-overlay')
          }
          // If filter box is empty
          if (searchList.hasClass('show')) {
            searchList.removeClass('show')
          }
        }
      }
    }
  })

  // Add class on hover of the list
  $(document).on('mouseenter', '.search-list li', function (e) {
    $(this).siblings().removeClass('current_item')
    $(this).addClass('current_item')
  })
  $(document).on('click', '.search-list li', function (e) {
    e.stopPropagation()
  })

  $('html').on('click', function ($this) {
    if (!$($this.target).hasClass('bookmark-icon')) {
      if (bookmarkSearchList.hasClass('show')) {
        bookmarkSearchList.removeClass('show')
      }
      if (bookmarkInput.hasClass('show')) {
        bookmarkInput.removeClass('show')
        appContent.removeClass('show-overlay')
      }
    }
  })

  // Prevent closing bookmark dropdown on input textbox click
  $(document).on('click', '.bookmark-input input', function (e) {
    bookmarkInput.addClass('show')
    bookmarkSearchList.addClass('show')
  })

  // Favorite star click
  $(document).on('click', '.bookmark-input .search-list .bookmark-icon', function (e) {
    e.stopPropagation()
    if ($(this).hasClass('text-warning')) {
      $(this).removeClass('text-warning')
      var arrList = $('ul.nav.navbar-nav.bookmark-icons li')
      for (var i = 0; i < arrList.length; i++) {
        if (arrList[i].firstChild.dataset.bsOriginalTitle == $(this).parent()[0].innerText) {
          arrList[i].remove()
        }
      }
      e.preventDefault()
    } else {
      var arrList = $('ul.nav.navbar-nav.bookmark-icons li')
      $(this).addClass('text-warning')
      e.preventDefault()
      var $url = $(this).parent()[0].href,
        $name = $(this).parent()[0].innerText,
        $listItem = '',
        $listItemDropdown = ''
      if ($($(this).parent()[0].firstChild.firstChild).hasClass('feather')) {
        var classString = $(this).parent()[0].firstChild.firstChild.getAttribute('class')
        iconName = classString.split('feather-')[1].split(' ')[0]
      }
      $listItem =
        '<li class="nav-item d-none d-lg-block">' +
        '<a class="nav-link" href="' +
        $url +
        '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' +
        $name +
        '">' +
        '<i class="bi bi-bookmark bookmark-icon float-end"></i>'
        '</a>' +
        '</li>'
      $('ul.nav.bookmark-icons').append($listItem)
      $('[data-bs-toggle="tooltip"]').tooltip()
    }
  })

  // If we use up key(38) Down key (40) or Enter key(13)
  $(window).on('keydown', function (e) {
    var $current = $('.search-list li.current_item'),
      $next,
      $prev
    if (e.keyCode === 40) {
      $next = $current.next()
      $current.removeClass('current_item')
      $current = $next.addClass('current_item')
    } else if (e.keyCode === 38) {
      $prev = $current.prev()
      $current.removeClass('current_item')
      $current = $prev.addClass('current_item')
    }

    if (e.keyCode === 13 && $('.search-list li.current_item').length > 0) {
      var selected_item = $('.search-list li.current_item a')
      window.location = selected_item.attr('href')
      $(selected_item).trigger('click')
    }
  })
</script>
@endpush
