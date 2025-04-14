 // Gauge config
 var opts = {
    angle: 0.1,
    lineWidth: 0.3,
    radiusScale: 1,
    pointer: {
        length: 0.6,
        strokeWidth: 0.035,
        color: '#FFF'
    },
    limitMax: false,
    limitMin: false,
    colorStart: '#6FADCF',
    colorStop: '#8FC0DA',
    strokeColor: '#EEEEEE',
    generateGradient: true,
    highDpiSupport: true,
    staticZones: [
        { strokeStyle: "#30B32D", min: 0, max: 100 }
    ]
};

var gauge1 = new Gauge(document.getElementById('gauge1')).setOptions(opts);
gauge1.maxValue = 100;
gauge1.setMinValue(0);
gauge1.set(23.9);
document.getElementById('tempValue').innerText = '23.9';

var gauge2 = new Gauge(document.getElementById('gauge2')).setOptions(opts);
gauge2.maxValue = 100;
gauge2.setMinValue(0);
gauge2.set(59.3);
document.getElementById('humidityValue').innerText = '59.3';
