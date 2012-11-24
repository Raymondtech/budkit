$(function () {
    //random data generator
    var data = [], totalPoints = 30;
    
    function getRandomData( reset ) {
        
        if(reset){
            data = [];
        }
        if (data.length > 0)
            data = data.slice(1);
	
        // do a random walk
        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + (Math.random() * 10) - 5;
            if (y < 0)
                y = 0;
            if (y > 100)
                y = 100;
            data.push(y);
        }
	
        // zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i)
            //Generate UTC Timestap
            
            res.push([i, data[i]])
        return res;
    }
    

                
    // setup plot
    var options = {
        yaxis: {
            min: 0, 
            tickSize: 0,
            max: 100
            //labelMargin: 10
        },
        xaxis: {
            
        //max: 31
        },
        colors: ["#519BC8", "#C51800"],
        series: {
            points: {
                show: true
            },
            lines: {
                show: true, 
                fill: false, 
                steps: false
            }
        },
        grid: {
            clickable: true,
            hoverable: true,
            autoHighlight: true
            //labelMargin: 5
        }
    };
    //Plot the graph
    $.plot( $("#dashboard-stats"), [ getRandomData() , getRandomData(true) ], options );
    
    function showTooltip(x, y, contents) {
        $('<div id="tooltip" >' + contents + '</div>"').css({
            position: 'absolute',
            display: 'none',
            top: y -13,
            left: x + 10
        }).appendTo("body").show();
    }

    var previousPoint = null;
    
    $("#dashboard-stats").bind("plothover", function(event, pos, item) {
												
        $("#x").text(pos.x);
        $("#y").text(pos.y);

        if (item) {
            highlight(item.series, item.datapoint);
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;

                $(this).attr('title',item.series.label);
                $(this).trigger('click');
                $("#tooltip").remove();
                var x = item.datapoint[0],
                y = item.datapoint[1];

                //showTooltip(item.pageX, item.pageY,  "<p>Point clicked</p><b>" + item.series.label + "</b> : " + y);
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });

});
