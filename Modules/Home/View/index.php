<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://unpkg.com/codyhouse-framework/main/assets/css/style.min.css">

<link rel="stylesheet" href="/public/css/tabbed_navigation.css">
<link rel="stylesheet" href="/public/css/_1_circular-progress-bar.css">
<link rel="stylesheet" href="/public/css/global.css">


<div class="cards">
    <div class="card">
        <div class="tabs-v2 js-tabs">
            <nav>
                <ul class="tabs-nav-v2 js-tabs__controls js-tabs-nav-v2" aria-label='Tabs Interface'>
                    <li><a href="#tab2Panel1" class="tabs-nav-v2__item js-tab-focus" aria-selected="true">Profit Calculator</a></li>
                    <li><a href="#tab2Panel2" class="tabs-nav-v2__item js-tab-focus">NFT Upgrade Calculator</a></li>
                </ul>
            </nav>

            <div class="js-tabs__panels">
                <section id="tab2Panel1" class="padding-top-md js-tabs__panel">
                    <label>Shares a second</label>
                    <input type="number" id="sps" onkeyup="UpdatePrices()">

                    <div id="sph"></div>
                    <div id="spd"></div>
                    <div id="btkph"></div>
                    <div id="btkpd"></div>
                    <div id="waxph"></div>
                    <div id="waxpd"></div>
                    <div id="usdph"></div>
                    <div id="usdpd"></div>

                    <br><br>
                    <div id="current_wax_price"></div>
                    <div id="current_btk_price"></div>
                    <div id="current_btk_pps"></div>
                    <br>
                    <div id="time_till_update"></div>
                </section>

                <section id="tab2Panel2" class="padding-top-md js-tabs__panel">
                    <label>Class</label>
                    <input type="number" id="nft-class" value="0" readonly class="width-10%">
                    <select id="nft-rarity" onchange="LoadNftLevels(this)">
                        <option value="free">Free</option>
                        <option value="common">Common</option>
                        <option value="rare">Rare</option>
                        <option value="epic">Epic</option>
                        <option value="legendary">Legendary</option>
                    </select>
                    <select id="nft-level" onchange="LoadNftData(this)">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    <input type="checkbox" id="advanced_search" onchange="AdvancedSearchChecked(this)"> Advanced

                    <div id="advanced_search_section" style="display:none">
                        <input type="number" id="starting_level" placeholder="Starting Level" onkeyup="CalculateAdvanced()">
                        <input type="number" id="ending_level" placeholder="Ending Level" onkeyup="CalculateAdvanced()">
                    </div>

                    <div id="price" class="nft-calc-info"></div>
                    <div id="upgrade-time" class="nft-calc-info"></div>
                    <div id="speedup-price" class="nft-calc-info"></div>
                    <div id="mining-power" class="nft-calc-info"></div>
                    <div id="increased-mining-power" class="nft-calc-info"></div>
                    <div id="roi" class="nft-calc-info"></div>
                    <div id="roi-if-sped" class="nft-calc-info"></div>
                </section>
            </div>
        </div>
    </div>
    <div class="card">
        <h4>Donations</h4>
        <p>
            Help keep this site running!

            Renewal date is on the 5th of every month!

            <span>Send donations to <b>ifo2o.c.wam</b></span>
        
        </p>

        Server Cost Funded <?php echo $server_cost_donations; ?>/350 
        <progress id="file" value="<?php echo $server_cost_donations; ?>" max="350" style="width: 100%"> <?php echo ($server_cost_donations/150)*100; ?>% </progress>
        
        <br>
    </div>
</div>

<div id="ads" style="font-size: 12px;">
  <div class='sticky-ads' id='sticky-ads'>
    <div class='sticky-ads-close'><button id="adsCloseBtn" onclick="closestickyAds();">X</button></div>
    <div class='sticky-ads-content'>

      <h3>Big News!</h3>

      <p>The creator of this website is starting a telegram group called Safe BSC Pumps</p>
      <p>Link <a href="https://t.me/safe_bsc_pumps">https://t.me/safe_bsc_pumps</a></p>
      <p>The main goal of this group is a sniper bot but the same tokens the sniper chooses to snipe will be posted in this group</p>

      

    </div>

  </div>

</div>

<script>
    var wax_price = <?php echo $wax_price; ?>;
    var btk_price = <?php echo $btk_price; ?>;
    var btk_pps = <?php echo $btk_pps; ?>;

    function closestickyAds()
{
  var v = document.getElementById("foxads");
  v.style.display = "none";
}
</script>

<script src="/public/js/helpers.js"></script>
<script src="/public/js/profit_calculator.js?v=11"></script>
<script src="/public/js/util.js"></script>
<script src="/public/js/tabbed_navigation.js"></script>
<script src="/public/js/_1_circular-progress-bar.js"></script>
<script src="/public/js/nftmap.js?v=3"></script>
<script src="/public/js/nft_calculator.js?v=2"></script>