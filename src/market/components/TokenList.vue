<template>
  <main class="page-wrap" :class="{ 'collapsed': header.collapsed, 'opaque': header.opaque }">
<div class="card-body">
    <!-- fixed list search/sorting controls -->
    <section class="page-topbar">
        <div class="flex-row flex-middle flex-space">

          <!-- control search -->
          <Search class="light" v-model="searchStr"></Search>

          <!-- control heading -->
          <div class="flex-1 text-clip text-big text-center me-1 if-medium">24h Change</div>

          <!-- control dropdown menus -->
          <div class="d-flex justify-content-between align-items-center">

            <div class="dropdown">
              <button class="btn btn-sm btn-secondary bi bi-chevron-down iconLeft" id="Limitmenu" data-bs-toggle="dropdown" aria-expanded="false"> {{ limitCountLabel }}</button>
              <div class="dropdown-menu" aria-labelledby="Limitmenu">
                <li class="heading px-1">
                  <span class="form-label">Limits</span>
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeLimit( 10 ) }" @click="limitList( 10 )">
                  <i class="bi bi-list-ul iconLeft"></i> 10 tokens
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeLimit( 20 ) }"  @click="limitList( 20 )">
                  <i class="bi bi-list-ul iconLeft"></i> 20 tokens
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeLimit( 50 ) }"  @click="limitList( 50 )">
                  <i class="bi bi-list-ul iconLeft"></i> 50 tokens
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeLimit( 100 ) }"  @click="limitList( 100 )">
                  <i class="bi bi-list-ul iconLeft"></i> 100 tokens
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeLimit( 0 ) }"  @click="limitList( 0 )">
                  <i class="bi bi-list-ul iconLeft"></i> All tokens
                </li>
              </div>
            </div>&nbsp;

            <div class="dropdown">
              <button class="btn btn-sm btn-secondary iconLeft" id="Sortingmenu" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-sort-down-alt"></i> {{ sortByLabel }}
              </button>
              <div class="dropdown-menu" aria-labelledby="Sortingmenu">
                <li class="heading px-1">
                  <span class="form-label">Sorting Options</span>
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeSort( 'token' ) }" @click="$sorter.sortOrder( 'ticker', 'token', 'asc' )">
                  <i class="bi bi-coin iconLeft"></i> Token
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeSort( 'percent' ) }" @click="$sorter.sortOrder( 'ticker', 'percent', 'desc' )">
                  <i class="bi bi-percent iconLeft"></i> Percent
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeSort( 'close' ) }" @click="$sorter.sortOrder( 'ticker', 'close', 'desc' )">
                  <i class="bi bi-graph-up iconLeft"></i> Price
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeSort( 'volatility' ) }" @click="$sorter.sortOrder( 'ticker', 'volatility', 'desc' )">
                  <i class="bi bi-graph-up iconLeft"></i> Volatility
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeSort( 'danger' ) }" @click="$sorter.sortOrder( 'ticker', 'danger', 'desc' )">
                  <i class="bi bi-exclamation-circle iconLeft"></i> Danger
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeSort( 'change' ) }" @click="$sorter.sortOrder( 'ticker', 'change', 'desc' )">
                  <i class="bi bi-clock iconLeft"></i> Change
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeSort( 'marketVolume' ) }" @click="$sorter.sortOrder( 'ticker', 'marketVolume', 'desc' )">
                  <i class="bi bi-bar-chart-line-fill iconLeft"></i> Volume
                </li>
                <li class="dropdown-item clickable" :class="{ 'active': activeSort( 'trades' ) }" @click="$sorter.sortOrder( 'ticker', 'trades', 'desc' )">
                  <i class="bi bi-arrow-left-right iconLeft"></i> Trades
                </li>
              </div>
            </div>&nbsp;

            <div class="dropdown">
              <button class="btn btn-sm btn-warning bi bi-star iconLeft" v-text="options.prices.market" id="Filtermenu" data-bs-toggle="dropdown" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="Filtermenu">
                <div class="px-1 mb-1">
                  <span class="form-label">Filter by Market</span>
                </div>
                <div class="tablelist-wrap">
                  <div class="tablelist-content">
                    <div class="tablelist-row flex-row flex-middle flex-stretch clickable" v-for="m of marketsData" :key="m.token" :class="{ 'active': activeMarket( m.token ) }" @click="toggleMarket( m.token )">
                      <div class="flex-1"><i class="bi bi-star iconLeft"></i> {{ m.token }}</div>
                      <div class="ps-1">{{ m.count }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>&nbsp;

            <div class="dropdown">
              <button class="btn btn-sm btn-warning bi bi-gear" id="Livemenu" data-bs-toggle="dropdown" aria-expanded="false"></button>
              <div class="dropdown-menu px-1" aria-labelledby="Livemenu">
                <div class="form-label mb-1 push-small">Live Price Options</div>
                <Toggle :text="'Show top coins price in header'" v-model="options.prices.header" @change="saveOptions"></Toggle>
                <Toggle :text="'Show price chart for in list'" v-model="options.prices.chart" @change="saveOptions"></Toggle>
              </div>
            </div>

          </div>

        </div>
    </section>

    <!-- empty list message -->
    <section class="mb-1" v-if="!listCount">
        <div class="card p-1 flex-row flex-middle flex-stretch">
          <div class="bi bi-info-circle iconLarge me-1"></div>
          <div class="text-clip flex-1">
            <div v-if="searchStr">
              <span class="text-dark">No match for <span class="text-secondary">{{ searchStr }}</span></span> <br />
              <span class="text-info">Can't find anything matching your search input.</span>
            </div>
            <div v-else>
              <span class="text-dark">No price data available</span> <br />
              <span class="text-info">Price data from remote API has not loaded yet.</span>
            </div>
          </div>
        </div>
    </section>

    <!-- live ticker price list -->
    <section class="pagelist-wrap">

        <div class="pagelist-item flex-row flex-middle flex-stretch shadow" style="background:rgb(255 255 255 / 6%);" v-if="tickerList.length">
          <div class="iconWidth me-1 if-small"></div>
          <div class="me-1 text-clip flex-1"><span class="clickable" @click="$sorter.sortOrder( 'ticker', 'token', 'asc' )">Token</span></div>
          <div class="me-1 text-clip flex-1"><span class="clickable" @click="$sorter.sortOrder( 'ticker', 'close', 'desc' )">Price</span></div>
          <div class="well me-1 flex-1 if-medium disabled" v-if="options.prices.chart"></div>
          <div class="me-1 text-clip flex-1"><span class="clickable" @click="$sorter.sortOrder( 'ticker', 'percent', 'desc' )">Percent</span></div>
          <div class="me-1 text-clip flex-1 if-medium"><span class="clickable" @click="$sorter.sortOrder( 'ticker', 'marketVolume', 'desc' )">Volume</span></div>
          <div class="text-end text-clip flex-1 if-large"><span class="clickable" @click="$sorter.sortOrder( 'ticker', 'trades', 'desc' )">Book</span></div>
        </div>

        <div v-for="p in tickerList" class="pagelist-item flex-row flex-middle flex-stretch clickable shadow" :class="p.style" @click.stop="setRoute( p.route )" :key="p.symbol">

          <div class="me-1 if-small" :class="{ 'alarm-bubble': p.alarms }">
            <TokenIcon :image="p.image" :alt="p.token"></TokenIcon>
          </div>

          <div class="me-1 text-clip flex-1">
            <big class="text-warning">{{ p.token }}</big> <br />
            <span class="text-secondary">{{ p.name }}</span>
          </div>

          <div class="me-1 text-clip flex-1" style="margin-left: -45px;">
            <big class="text-nowrap text-dark fw-bold">{{ p.close | toFixed( p.market ) }} <span class="text-secondary">{{ p.market }}</span></big> <br />
            <span class="text-nowrap color fw-bold">{{ p.sign }}{{ p.change | toFixed( p.market ) }} <span class="text-secondary">24H</span></span>
          </div>

          <div class="well me-1 flex-1 if-medium" v-if="options.prices.chart">
            <LineChart :width="200" :height="28" :values="p.history"></LineChart>
          </div>

          <div class="me-1 text-clip flex-1">
            <big class="text-nowrap color fw-bold">{{ p.sign }}{{ p.percent | toMoney( 3 ) }}%</big> <br />
            <span class="bi bi-bar-chart" title="High/Low Volatility Score" v-tooltip> {{ p.volatility | toFixed( 3 ) }}</span>
          </div>

          <div class="me-1 text-clip flex-1 if-medium">
            <big class="text-nowrap text-dark fw-bold">{{ p.marketVolume | toMoney }} <span class="text-nowrap text-secondary">{{ p.market }}</span></big> <br />
            <span class="text-nowrap text-secondary">{{ p.tokenVolume | toMoney }} <span class="text-nowrap text-secondary">{{ p.token }}</span></span>
          </div>

          <div class="text-end text-clip flex-1 if-large">
            <big class="text-nowrap text-dark fw-bold">{{ p.trades | toMoney }}</big> <br />
            <button class="text-primary-hover" :title="'Trade '+ p.token" v-tooltip>Trades</button>
          </div>

        </div>

        <!-- if there are more items not included in list due to limit option -->
        <div class="pagelist-item flex-row flex-middle flex-space shadow" style="background:rgb(255 255 255 / 6%);" v-if="listCount">
          <div class="text-secondary bi bi-list iconLeft">{{ listLeftText }}</div>
          <button v-if="listLeft" class="text-dark bi bi-list-ul iconLeft" @click="limitList( 0 )"> Show all</button>
        </div>

    </section>

    <!-- list spinner -->
    <Spinner class="fixed" ref="spinner"></Spinner>
</div>
  </main>
</template>

<script>
import Spinner from './Spinner.vue';
import Search from './Search.vue';
import TokenIcon from './TokenIcon.vue';
import Dropdown from './Dropdown.vue';
import Toggle from './Toggle.vue';
import LineChart from './LineChart.vue';

// component
export default {

  // component list
  components: { Spinner, Search, TokenIcon, Dropdown, Toggle, LineChart },

  // component props
  props: {
    header: { type: Object, default() { return {} } },
    options: { type: Object, default() { return {} }, required: true },
    sortData: { type: Object, default() { return {} }, required: true },
    priceData: { type: Array, default() { return [] }, required: true },
    marketsData: { type: Object, default() { return {} }, required: true },
    tickerStatus: { type: Number, default: 0 },
  },

  // comonent data
  data() {
    return {
      searchStr: '',
      listCount: 0,
      listLeft: 0,
    }
  },

  // watch methods
  watch: {

    priceData() {
      this.updateSpinner();
    },
    tickerStatus() {
      this.updateSpinner();
    },
  },

  // computed methods
  computed: {

    // get filtered and sorted ticker list for display
    tickerList() {
      let { market } = this.options.prices;
      let { column, order } = this.sortData.ticker;

      let limit  = parseInt( this.options.prices.limit ) | 0;
      let search = String( this.searchStr ).replace( /[^A-Z0-9]+/gi, '' );
      let regex  = ( search.length > 1 ) ? new RegExp( search, 'i' ) : null;
      let count  = this.priceData.length;
      let list   = [];

      // filter the list
      while ( count-- ) {
        let p = this.priceData[ count ];
        if ( market && p.market !== market ) continue;
        if ( regex && !( regex.test( p.token ) || regex.test( p.name ) ) ) continue;
        list.push( p );
      }
      // sort the list
      list = this.$utils.sort( list, column, order );

      // update paging totals
      let total = list.length;
      this.listCount = total;
      this.listLeft = 0;

      // trim the list
      if ( total && limit && limit < total ) {
        list = list.slice( 0, limit );
        this.listLeft = ( total - list.length );
      }
      return list;
    },

    // sort-by label for buttons, etc
    sortByLabel() {
      let { column } = this.sortData.ticker;
      switch ( column ) {
        case 'token'        :  return 'Token';
        case 'percent'      :  return 'Percent';
        case 'close'        :  return 'Price';
        case 'volatility'   :  return 'Volatility';
        case 'danger'       :  return 'Danger';
        case 'change'       :  return 'Change';
        case 'marketVolume' :  return 'Volume';
        case 'tokenVolume'  :  return 'Volume';
        case 'trades'       :  return 'Trades';
        default             :  return 'Default';
      }
    },

    // text to show in limit filter controls
    limitCountLabel() {
      let limit = parseInt( this.options.prices.limit ) | 0;
      if ( limit && limit < this.listCount ) return limit +'/'+ this.listCount;
      return 'All '+ this.listCount;
    },

    // text about hidden list pair
    listLeftText() {
      let total  = this.listCount;
      let remain = this.listLeft;
      let market = this.options.prices.market;
      let limit  = this.options.prices.limit;
      let count  = this.$utils.noun( total, market +' token pair', market +' token pairs' );
      if ( remain ) return 'Showing '+ limit +' of '+ count;
      return 'Showing all '+ count;
    },
  },

  // custom mounted
  methods: {

    // check if key is active sort option
    activeSort( column ) {
      return ( this.sortData.ticker.column === column );
    },

    // check if num is active list limit option
    activeLimit( limit ) {
      return ( this.options.prices.limit === limit );
    },

    // check if market is active selected market
    activeMarket( market ) {
      return ( this.options.prices.market === market );
    },

    // apply options
    saveOptions() {
      this.$opts.saveOptions( this.options );
    },

    // set app url route
    setRoute( route ) {
      this.$router.setRoute( route );
    },

    /*Link() {
      let { token, market } = this.modalData;
      //this.$bus.emit( 'handleClick', '/user/trade/'+ token +'_'+ market +'/', '_blank' );
        if (window.location.href.indexOf("practice") > -1) {
            window.open("/user/practice/" + token, "_self")
        } else {
            window.open("/user/trade/" + token, "_self")
        }
    },*/

    // set list limit value
    limitList( num ) {
      this.options.prices.limit = parseInt( num ) | 0;
      this.saveOptions();
    },

    // filter by asset
    toggleMarket( market ) {
      this.options.prices.market = String( market || 'USDT' );
      this.saveOptions();
    },

    // update page spinner
    updateSpinner() {
      if ( !this.$refs.spinner ) return;
      if ( this.tickerList.length ) return this.$refs.spinner.hide();
      if ( this.tickerStatus === 0 ) return this.$refs.spinner.error( 'Socket API not connected' );
      if ( this.tickerStatus === 1 ) return this.$refs.spinner.show( 'Waiting for price data' );
    },
  },

  // on component mounted
  mounted() {
    this.updateSpinner();
  }
}
</script>

<style lang="scss">
@import "../scss/variables";
.pagelist-item-chart {
  padding: .5em;
  background-image: radial-gradient( ellipse at top right, rgba( #000, 0.2 ) 0%, rgba( #000, 0 ) 100% );
  border-radius: $lineJoin;
}
</style>
