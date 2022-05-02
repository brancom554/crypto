<template>
  <section :class="modalData.style">

    <!--  coin name and price -->
    <div class="flex-row flex-middle flex-space">

      <div class="text-nowrap me-1">
        <div class="flex-row flex-middle">
          <div class="me-1 if-medium">
            <TokenIcon :image="modalData.image" :alt="modalData.token"></TokenIcon>
          </div>
          <div>
            <div class="form-label">{{ modalData.token }} <span v-if="coinRank">#{{ coinRank | toMoney }}</span></div>
            <big class="text-dark">{{ modalData.name }}</big>
          </div>
        </div>
      </div>

      <div class="text-nowrap text-end me-1">
        <div class="form-label">{{ modalData.market }} Price</div>
        <big class="text-dark">{{ modalData.close | toFixed( modalData.market ) }}</big>
      </div>

      <div class="text-nowrap text-end me-1">
        <div class="form-label">Chg 24h</div>
        <big class="color">{{ modalData.sign }}{{ modalData.percent | toFixed( 3 ) }}%</big>
      </div>

      <div class="text-nowrap">
        <button class="btn btn-sm btn-warning bi bi-bar-chart iconLeft" @click="Link()"> Trade</button>
      </div>

    </div>

    <hr />

    <div class="flex-grid mb-1">

      <div class="flex-1 well text-nowrap">
        <div class="form-label">High 24h</div>
        <big class="text-dark">{{ modalData.high | toFixed( modalData.market ) }}</big>
      </div>

      <div class="flex-1 well text-nowrap">
        <div class="form-label">Low 24h</div>
        <big class="text-dark">{{ modalData.low | toFixed( modalData.market ) }}</big>
      </div>

      <div class="flex-1 well text-nowrap">
        <div class="form-label">{{ modalData.market }} Vol 24h</div>
        <big class="text-dark">{{ modalData.marketVolume | toMoney }}</big>
      </div>

      <div class="flex-1 well text-nowrap">
        <div class="form-label">{{ modalData.token }} Vol 24h</div>
        <big class="text-dark">{{ modalData.tokenVolume | toMoney }}</big>
      </div>

      <div class="flex-1 well text-nowrap">
        <div class="form-label">Market Cap USD</div>
        <big class="text-dark">{{ marketCap | toMoney }}</big>
      </div>

      <div class="flex-1 well text-nowrap">
        <div class="form-label">Current Supply</div>
        <big class="text-dark">{{ totalSupply | toMoney }}</big>
      </div>

      <div class="flex-1 well text-nowrap">
        <div class="form-label">Volume USD 24H</div>
        <big class="text-dark">{{ totalVolume | toMoney }}</big>
      </div>

      <div class="flex-1 well text-nowrap">
        <div class="form-label">Price USD</div>
        <big class="text-dark">${{ usdPrice | toMoney( 3 ) }}</big>
      </div>

    </div>

    <!-- draw line chart for symbol using candle data -->
    <div class="text-nowrap well mb-1">
      <div class="flex-row flex-middle flex-space">
        <div class="form-label text-clip me-1">7D Graph</div>
        <div class="form-label text-clip me-1">24h Volatility <span class="text-dark">{{ modalData.volatility | toFixed( 1 ) }}%</span></div>
        <div class="form-label text-clip">P&amp;D Danger <span class="text-dark">{{ modalData.danger | toFixed( 1 ) }}%</span></div>
      </div>
      <LineChart :width="chartWidth" :height="chartHeight" :values="chartData"></LineChart>
      <Spinner class="abs rounded" ref="chartSpinner"></Spinner>
    </div>

    <!-- events and alarms -->
    <!-- <Tabs class="tokenpage-tabs" :data="{ alarmsCount, newsCount }">
      <section btn-class="bi bi-alarm iconLeft" :btn-name="[ 'Alarms ('+ alarmsCount +')' ]" active>
        <AlarmsList :alarmsData="alarmsData" :pairData="modalData" @listCount="onAlarmsCount"></AlarmsList>
      </section>
      <section btn-class="bi bi-calendar iconLeft" :btn-name="[ 'News ('+ newsCount +')' ]">
        <NewsList :newsEntries="newsEntries" :pairData="modalData" @listCount="onNewsCount"></NewsList>
      </section>
    </Tabs> -->

    <AlarmsList :alarmsData="alarmsData" :pairData="modalData" @listCount="onAlarmsCount"></AlarmsList>

  </section>
</template>

<script>
import Spinner from './Spinner.vue';
import Tabs from './Tabs.vue';
import TokenIcon from './TokenIcon.vue';
import LineChart from './LineChart.vue';
import AlarmsList from './AlarmsList.vue';
// import NewsList from './NewsList.vue';

// component
export default {

  // component list
  components: {
    Spinner,
    Tabs,
    TokenIcon,
    LineChart,
    AlarmsList,
    // NewsList,
  },

  // component props
  props: {
    modalData: { type: Object, default() { return {} }, required: true }, // pair data
    alarmsData: { type: Array, default() { return [] } },
    newsEntries: { type: Array, default() { return [] } },
  },

  // comonent data
  data() {
    return {
      coinRank: this.modalData.rank,
      marketCap: this.modalData.capusd,
      totalSupply: this.modalData.supply,
      totalVolume: this.modalData.marketVolume,
      curPrice: this.modalData.close,
      usdPrice: 0,
      alarmsCount: 0,
      newsCount: 0,
      // line chart
      chartWidth: 800,
      chartHeight: 120,
      chartData: [],
    }
  },

  // watch methods
  watch: {

    // update title as token data changes
    modalData: function() {
      let p = this.modalData;
      this.$bus.emit( 'setTitle', p.pair +' '+ p.arrow +' '+ p.sign + p.percent );
    }
  },

  // component methods
  methods: {

    Link() {
      let { token, market } = this.modalData;
      //this.$bus.emit( 'handleClick', '/user/trade/'+ token +'_'+ market +'/', '_blank' );
        if (window.location.href.indexOf("practice") > -1) {
            window.open("/user/practice/" + token + '/' + market, "_self")
        } else if (window.location.href.indexOf("trade") > -1) {
            window.open("/user/trade/" + token + '/' + market, "_self")
        } else {
            window.open("/user/exchange/" + token + '/' + market, "_self")
        }
    },

    // update alarms count for this token
    onAlarmsCount( count ) {
      this.alarmsCount = count;
    },

    // update events count for this token
    onNewsCount( count ) {
      this.newsCount = count;
    },

    // spinner helper
    spinner( name, method, message ) {
      if ( !this.$refs[ name ] || !method ) return;
      this.$refs[ name ][ method ]( message );
    },

    // fetch token data from api
    fetchGlobalData() {
      this.$coincap.fetchCoin( this.modalData.id, data => {
        let { rank, marketCapUsd, supply, volumeUsd24Hr, priceUsd } = data;
        this.coinRank     = rank || this.coinRank;
        this.marketCap    = marketCapUsd || this.marketCap;
        this.totalSupply  = supply || this.totalSupply;
        this.totalVolume  = volumeUsd24Hr || this.totalVolume;
        this.usdPrice     = priceUsd || this.usdPrice;
      });
    },

    // fetch last 24h candle data
    fetchChartData() {
      let symbol = this.modalData.symbol;
      this.spinner( 'chartSpinner', 'show', 'Loading chart data' );
      this.$binance.fetchChartData( symbol, prices => {
        if ( prices.length ) {
          this.spinner( 'chartSpinner', 'hide' );
          this.chartData = prices;
        } else {
          this.spinner( 'chartSpinner', 'error', 'No data for '+ symbol );
        }
      });
    },
  },

  // component mounted
  mounted() {
    this.fetchGlobalData();
    this.fetchChartData();
  },
}
</script>

