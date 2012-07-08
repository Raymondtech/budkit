$(function () {
    var a = [],
    b = [
    [1.3242528e+12, 90],
    [1.3243392e+12, 102],
    [1.3244256e+12, 57],
    [1.324512e+12, 40],
    [1.3245984e+12, 0],
    [1.3246848e+12, 0],
    [1.3247712e+12, 0],
    [1.3248576e+12, 0],
    [1.324944e+12, 1],
    [1.3250304e+12, 89],
    [1.3251168e+12, 99],
    [1.3252032e+12, 108],
    [1.3252896e+12, 150],
    [1.325376e+12, 170],
    [1.3254624e+12, 190],
    [1.3255488e+12, 185],
    [1.3256352e+12, 187],
    [1.3257216e+12, 197],
    [1.325808e+12, 200],
    [1.3258944e+12, 225],
    [1.3259808e+12, 209],
    [1.3260672e+12, 227],
    [1.3261536e+12, 231],
    [1.32624e+12, 235],
    [1.3263264e+12, 237],
    [1.3264128e+12, 242],
    [1.3264992e+12, 230],
    [1.3265856e+12, 229]
    ],
    c = [],
    d = [
    [1.3242528e+12, 2],
    [1.3243392e+12, 2],
    [1.3244256e+12, 2],
    [1.324512e+12, 3],
    [1.3245984e+12, 0],
    [1.3246848e+12, 0],
    [1.3247712e+12, 0],
    [1.3248576e+12, 0],
    [1.324944e+12, 1],
    [1.3250304e+12, 2],
    [1.3251168e+12, 0],
    [1.3252032e+12, 0],
    [1.3252896e+12, 0],
    [1.325376e+12, 0],
    [1.3254624e+12, 0],
    [1.3255488e+12, 0],
    [1.3256352e+12, 0],
    [1.3257216e+12, 0],
    [1.325808e+12, 0],
    [1.3258944e+12, 45],
    [1.3259808e+12, 100],
    [1.3260672e+12, 197],
    [1.3261536e+12, 201],
    [1.32624e+12, 225],
    [1.3263264e+12, 207],
    [1.3264128e+12, 172],
    [1.3264992e+12, 150],
    [1.3265856e+12, 189]
    ],
    options = {
         series: {
             //shadowSize: 1,
             bars: {
                 show: true,
                 barWidth: 25*60*60*300,
                 align: 'center'
             }
         },
         grid:{
             borderWidth: 0
         },
         yaxis: {
             min: 0,
             tickLength: 0,
             show: false
         },
         xaxis: {
             mode: 'time',
             timeformat: "%b %d",
             minTickSize: [1, "month"],
             tickSize: [5, "day"]
             //autoscaleMargin: .10
         }
     },
     data = [
        {
            label: "Product 1",
            data: a,
            bars: {
                show: true,
                barWidth: 25*60*60*300,
                fill: true,
                lineWidth: 1,
                order: 1,
                fillColor:  "#AA4643",
                 align: 'center'
            },
            color: "#AA4643"
        },
        {
            label: "Product 2",
            data: b,
            bars: {
                show: true,
                barWidth: 25*60*60*300,
                fill: true,
                lineWidth: 1,
                order: 2,
                fillColor:  "#89A54E",
                 align: 'center'
            },
            color: "#89A54E"
        },
        {
            label: "Product 3",
            data: c,
            bars: {
                show: true,
                barWidth: 25*60*60*300,
                fill: true,
                lineWidth: 1,
                order: 3,
                fillColor:  "#4572A7",
                 align: 'center'
            },
            color: "#4572A7"
        },
        {
            label: "Product 4",
            data: d,
            bars: {
                    show: true,
                barWidth: 25*60*60*300,
                fill: true,
                lineWidth: 1,
                order: 4,
                fillColor:  "#80699B",
                 align: 'center'
            },
            color: "#80699B"
        }
    ];
    // first correct the timestamps - they are recorded as the daily
    // midnights in UTC+0100, but Flot always displays dates in UTC
    // so we have to add one hour to hit the midnights in the plot
    for (var i = 0; i < d.length; ++i) {
        d[i][0] += 60 * 60 * 1000;
    }
    for (var i = 0; i < a.length; ++i) {
        a[i][0] += 60 * 60 * 1000;
    }
 
    $.plot($('#placeholder'), data, options);
});
