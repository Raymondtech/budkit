$(function () {
    //random data generator
    var data = [], totalPoints = 200;
    
    function getRandomData( reset ) {
        
        if(reset){
            data = [];
        }
        if (data.length > 0)
            data = data.slice(1);
	
        // do a random walk
        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
            if (y < 0)
                y = 0;
            if (y > 100)
                y = 100;
            data.push(y);
        }
	
        // zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i)
            res.push([i, data[i]])
        return res;
    }
                
    // setup plot
    var options = {
        yaxis: {
            min: 0, 
            ticks:[[0,""],[20,""],[40,""],[60,""],[80,""],[100,""]],
            max: 100
        },
        xaxis: {
            min: 0, 
            ticks:[[0,""],[20,""],[40,""],[60,""],[80,""],[100,""]],
            max: 100
        },
        colors: ["#519BC8"],
        series: {
            lines: { 
                lineWidth: 2, 
                fill: true,
                fillColor: {
                    colors: [ {
                        opacity: 0.2
                    }, {
                        opacity: 0
                    } ]
                },
                //"#dcecf9"
                steps: false
	
            }
        }
    };
    //Plot the graph
    $.plot( $("#placeholder1"), [ getRandomData() ], options );
    $.plot( $("#placeholder2"), [ getRandomData(true) ], options );
    $.plot( $("#placeholder3"), [ getRandomData(true) ], options );
    $.plot( $("#placeholder4"), [ getRandomData(true) ], options );
    
    options.colors = ["#D14836"];
    
    $.plot( $("#placeholder5"), [ getRandomData(true) ], options );
});
