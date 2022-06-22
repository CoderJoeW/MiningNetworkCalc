GetPrices();

var secondsBetweenActions = 5;
var secondsRemaining = secondsBetweenActions;
setInterval( function() {
    UpdateStatus( secondsRemaining );
    secondsRemaining--;
    if( secondsRemaining <= 0 ) {
        GetPrices();
        secondsRemaining = secondsBetweenActions;
    }
}, 1000 );

function UpdateStatus(seconds){
    document.getElementById('time_till_update').innerHTML = '<b>Time remaining till price update:</b> ' + seconds + 's';
}

function GetPrices(){
    $.get("/home/GetBitcakePrice", function(data){
        btk_price = data;
    });

    $.get("/home/GetBtkPPS", function(data){
        btk_pps = data;
    });

    var current_wax_pricet = document.getElementById('current_wax_price');
    var current_btk_pricet = document.getElementById('current_btk_price');
    var current_btk_ppst = document.getElementById('current_btk_pps');

    current_wax_pricet.innerHTML = 'Current Wax Price: ' + wax_price;
    current_btk_pricet.innerHTML = 'Current BTK Price: ' + btk_price;
    current_btk_ppst.innerHTML = '10,000SH = ' + btk_pps + ' BTK';

    UpdatePrices();
}

function UpdatePrices(){
    var sps = document.getElementById('sps').value;

    var spht = document.getElementById('sph');
    var spdt = document.getElementById('spd');
    var btkpht = document.getElementById('btkph');
    var btkpdt = document.getElementById('btkpd');
    var waxpht = document.getElementById('waxph');
    var waxpdt = document.getElementById('waxpd');
    var usdpht = document.getElementById('usdph');
    var usdpdt = document.getElementById('usdpd');

    var sph = (sps * 60) * 60;
    var spd = (sph * 24);
    var btkph = (((sps * 60) * 60) / 10000) * btk_pps;
    var btkpd = btkph * 24;

    var waxph = btkph * btk_price;
    var waxpd = waxph * 24;

    var usdph = waxph * wax_price;
    var usdpd = usdph * 24;

    spht.innerHTML = 'Shares Per Hour: ' + FormatNumber(sph);
    spdt.innerHTML = 'Shares Per Day: ' + FormatNumber(spd);
    btkpht.innerHTML = 'BTK Per Hour: ' + btkph;
    btkpdt.innerHTML = 'BTK Per Day: ' + btkpd;
    waxpht.innerHTML = 'Wax Per Hour: ' + waxph;
    waxpdt.innerHTML = 'Wax Per Day: ' + waxpd;
    usdpht.innerHTML = 'USD Per Hour: ' + usdph;
    usdpdt.innerHTML = 'USD Per Day: ' + usdpd;
}