LoadNftLevels(document.getElementById("nft-rarity"));

function LoadNftLevels(select){
    var nftLevels = document.getElementById("nft-level");

    let nftClass = nftMap["0"][select.value];

    nftLevels.options.length = 0;

    Object.entries(nftClass).forEach(([key, value]) => {
        var newOptionElement = document.createElement('option');
        newOptionElement.value = key;
        newOptionElement.innerHTML = key;
        nftLevels.appendChild(newOptionElement);
    });

    LoadNftData(document.getElementById('nft-level'));
}

function LoadNftData(select,isAdvancedSearch = false, advancedSearchData = null){
    let info = {
        price: 0,
        upgradeTime: 0,
        speedupPrice: 0,
        miningPower: 0,
        increasedMiningPower: 0,
        roi: 0,
        roiIfSped: 0
    }

    if(isAdvancedSearch){
        info.price = FormatNumber(advancedSearchData.price);
        info.upgradeTime = ForHumans(advancedSearchData.upgradeTime);
        info.speedupPrice = FormatNumber(advancedSearchData.speedupPrice);
        info.miningPower = advancedSearchData.miningPower;
        info.increasedMiningPower = advancedSearchData.increasedMiningPower;
        info.roi = ForHumans(advancedSearchData.roi);
        info.roiIfSped = ForHumans(advancedSearchData.roiIfSped);
    }else{
        var nftRarity = document.getElementById("nft-rarity");

        let nftData = nftMap["0"][nftRarity.value][select.value];

        info.price = FormatNumber(nftData.price);
        info.upgradeTime = ForHumans(nftData.time);
        info.speedupPrice = FormatNumber(nftData.speedUpPrice);
        info.miningPower = nftData.miningPower;
        info.increasedMiningPower = nftData.increasedMiningPower;
        info.roi = ForHumans(nftData.ROI);
        info.roiIfSped = ForHumans(nftData.ROIIfSped);
    }

    var pricet = document.getElementById("price");
    var upgradeTimet = document.getElementById("upgrade-time");
    var speedupPricet = document.getElementById("speedup-price");
    var miningPowert = document.getElementById("mining-power");
    var increasedMiningPowert = document.getElementById("increased-mining-power");
    var roit = document.getElementById("roi");
    var roiIfSpedt = document.getElementById("roi-if-sped");

    pricet.innerHTML = "<b>Upgrade Cost:</b> " + info.price;
    upgradeTimet.innerHTML = "<b>Upgrade Time:</b> " + info.upgradeTime;
    speedupPricet.innerHTML = "<b>Speed Up Cost:</b> " + info.speedupPrice;
    miningPowert.innerHTML = "<b>New Mining Power:</b> " + info.miningPower;
    increasedMiningPowert.innerHTML = "<b>Mining Power Increase:</b> " + info.increasedMiningPower;
    roit.innerHTML = "<b>Time till upgrade ROI:</b> " + info.roi;
    roiIfSpedt.innerHTML = "<b>Time till upgrade ROI with speed up:</b> " + info.roiIfSped;
}

function CalculateAdvanced(){
    var starting_level = parseInt(document.getElementById("starting_level").value);
    var ending_level = parseInt(document.getElementById("ending_level").value);

    var nftRarity = document.getElementById("nft-rarity");

    var nftData = nftMap["0"][nftRarity.value];

    var advancedSearchData = {
        price: 0,
        upgradeTime: 0,
        speedupPrice: 0,
        miningPower: 0,
        increasedMiningPower: 0,
        roi: 0,
        roiIfSped: 0
    }

    for(var i = starting_level; i < ending_level; i++){
        var localData = nftData[i];
        
        advancedSearchData.price += localData.price;
        advancedSearchData.upgradeTime += localData.time;
        advancedSearchData.speedupPrice += localData.speedUpPrice;
        advancedSearchData.increasedMiningPower += localData.increasedMiningPower;
        advancedSearchData.roi += localData.ROI;
        advancedSearchData.roiIfSped += localData.ROIIfSped;
    }

    //console.log(advancedSearchData);

    advancedSearchData.roi = (advancedSearchData.price/advancedSearchData.increasedMiningPower);
    advancedSearchData.miningPower = nftData[ending_level].miningPower;

    LoadNftData(document.getElementById('nft-level'),true,advancedSearchData);
}

function AdvancedSearchChecked(checkbox){
    var advanced_search_section = document.getElementById("advanced_search_section");

    if(checkbox.checked == true){
        document.getElementById("nft-level").disabled = true;
        advanced_search_section.style.display = 'block';
    }else{
        document.getElementById("nft-level").disabled = false;
        advanced_search_section.style.display = 'none';
    }
}