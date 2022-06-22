function ForHumans ( seconds ) {
    var levels = [
        [Math.floor(seconds / 31536000), 'years'],
        [Math.floor((seconds % 31536000) / 86400), 'days'],
        [Math.floor(((seconds % 31536000) % 86400) / 3600), 'hours'],
        [Math.floor((((seconds % 31536000) % 86400) % 3600) / 60), 'minutes'],
        [(((seconds % 31536000) % 86400) % 3600) % 60, 'seconds'],
    ];
    var returntext = '';        
    for (var i = 0, max = levels.length; i < max; i++) {
        if ( levels[i][0] === 0 ) continue;
        returntext += ' ' + levels[i][0] + ' ' + (levels[i][0] === 1 ? levels[i][1].substr(0, levels[i][1].length-1): levels[i][1]);
    };
    return returntext.trim();
}

function FormatNumber(number){
    var unitlist = ["","K","M","T"];
    let sign = Math.sign(number);
    let unit = 0;

    while(Math.abs(number) > 1000)
    {
      unit = unit + 1; 
      number = Math.floor(Math.abs(number) / 100)/10;
    }
    return sign*Math.abs(number) + unitlist[unit];
}