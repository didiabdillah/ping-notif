$(".peity-line").each(function() {
    $(this).peity("line", $(this).data())
}

),
$(".peity-bar").each(function() {
    $(this).peity("bar", $(this).data())
}

),
$("#datatable").DataTable();
var line=new Morris.Line( {
    element:"morris-line-chart", resize:!0, data:[ {
        y: "2016 Q1", SeriesA: 2666, SeriesB: 2666
    }
    , {
        y: "2016 Q2", SeriesA: 2778, SeriesB: 1778
    }
    , {
        y: "2016 Q3", SeriesA: 4912, SeriesB: 4512
    }
    , {
        y: "2016 Q4", SeriesA: 3767, SeriesB: 1567
    }
    , {
        y: "2017 Q1", SeriesA: 3810, SeriesB: 9510
    }
    , {
        y: "2017 Q2", SeriesA: 7670, SeriesB: 1670
    }
    , {
        y: "2017 Q3", SeriesA: 2820, SeriesB: 5820
    }
    , {
        y: "2017 Q4", SeriesA: 15073, SeriesB: 10073
    }
    , {
        y: "2018 Q1", SeriesA: 10687, SeriesB: 8687
    }
    , {
        y: "2018 Q2", SeriesA: 8432, SeriesB: 7432
    }
    ], xkey:"y", ykeys:["SeriesA", "SeriesB"], labels:["Series A", "Series B"], gridLineColor:"#eef0f2", lineColors:["#44a2d2", "#0acf97"], lineWidth:2, hideHover:"auto"
}

),
chart=new Chartist.Pie("#animating-donut", {
    series: [20, 20, 20], labels: [1, 2, 3]
}

, {
    donut: !0, showLabel: !1, donutWidth: 30, plugins: [Chartist.plugins.tooltip()]
}

);
chart.on("draw", function(e) {
    if("slice"===e.type) {
        var i=e.element._node.getTotalLength();
        e.element.attr( {
            "stroke-dasharray": i+"px "+i+"px"
        }
        );
        var t= {
            "stroke-dashoffset": {
                id: "anim"+e.index, dur: 1e3, from: -i+"px", to: "0px", easing: Chartist.Svg.Easing.easeOutQuint, fill: "freeze"
            }
        }
        ;
        0!==e.index&&(t["stroke-dashoffset"].begin="anim"+(e.index-1)+".end"), e.element.attr( {
            "stroke-dashoffset": -i+"px"
        }
        ), e.element.animate(t, !1)
    }
}

),
chart.on("created", function() {
    window.__anim21278907124&&(clearTimeout(window.__anim21278907124), window.__anim21278907124=null), window.__anim21278907124=setTimeout(chart.update.bind(chart), 1e4)
}

),
$("#world-map-markers").vectorMap( {
    map:"world_mill_en", scaleColors:["#eff0f1", "#eff0f1"], normalizeFunction:"polynomial", hoverOpacity:.7, hoverColor:!1, regionStyle: {
        initial: {
            fill: "#eff0f1"
        }
    }
    , markerStyle: {
        initial: {
            r: 4, fill: "#0acf97", "fill-opacity": .9, stroke: "#fff", "stroke-width": 5, "stroke-opacity": .4
        }
        , hover: {
            stroke: "#fff", "fill-opacity": 1, "stroke-width": 2
        }
    }
    , backgroundColor:"transparent", markers:[ {
        latLng: [61.52, 105.31], name: "Russia"
    }
    , {
        latLng: [-25.27, 133.77], name: "Australia"
    }
    , {
        latLng: [20.59, 78.96], name: "India"
    }
    , {
        latLng: [39.52, -87.12], name: "Brazil"
    }
    ], series: {
        regions:[ {
            values: {
                US: "#e0f9f2", AU: "#e0f9f2", IN: "#e0f9f2", RU: "#fde3e7"
            }
            , attribute:"fill"
        }
        ]
    }
}

);