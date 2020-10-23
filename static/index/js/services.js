function chart_render() {
    let chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        backgroundColor: "transparent",
        data: [{
            type: "doughnut",
            innerRadius: "40%",
            showInLegend: true,
            legendText: "{label}",
            indexLabel: "{label}: #percent%",
            dataPoints: [
                {label: "TEAM", y: 40000000},
                {label: "ICO", y: 70000000},
                {label: "Public account and Mobile App", y: 80000000},
                {label: "Advisors", y: 10000000}
            ]
        }]
    });
    chart.render();
}

function clock(date) {
    let _id = "clock";
    let _t = document.createElement("script");
    _t.src = "static/index/js/timer.min.js";
    let _f = function (_k) {
        let l = new MegaTimer(_id, {
            "view": [1, 1, 1, 1],
            "type": {
                "currentType": "1",
                "params": {
                    "usertime": true, "tz": "3", "utc": date
                }
            },
            "design": {
                "type": "plate",
                "params": {
                    "round": "10",
                    "background": "gradient",
                    "background-color": ["#f9cf6c", "#ff8c00"],
                    "effect": "flipchart",
                    "space": "2",
                    "separator-margin": "20",
                    "number-font-family": {
                        "family": "Comfortaa",
                        "link": "<link href='http://fonts.googleapis.com/css?family=Comfortaa&subset=latin,cyrillic' rel='stylesheet' type='text/css'>"
                    },
                    "number-font-size": "40",
                    "number-font-color": "#ffe599",
                    "padding": "12",
                    "separator-on": false,
                    "separator-text": ":",
                    "text-on": false,
                    "text-font-family": {
                        "family": "Comfortaa",
                        "link": "<link href='http://fonts.googleapis.com/css?family=Comfortaa&subset=latin,cyrillic' rel='stylesheet' type='text/css'>"
                    },
                    "text-font-size": "12",
                    "text-font-color": "red"
                }
            }, "designId": 2, "theme": "white", "width": 510, "height": 66
        });
        if (_k != null) l.run();
    };
    _t.onload = _f;
    _t.onreadystatechange = function () {
        if (_t.readyState === "loaded") _f(1);
    };
    let _h = document.head || document.getElementsByTagName("head")[0];
    _h.appendChild(_t);
}