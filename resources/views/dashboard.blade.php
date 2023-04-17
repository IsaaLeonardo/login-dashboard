@extends('layout')

@section('content')
<h1>Dashboard</h1>

<div id="chartTemperatura"></div>

<div id="chartHumedad"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
let data, temperature, humidity

const form = new FormData()
form.append('_token', '{{ csrf_token() }}')

const httpRequest = new XMLHttpRequest()
httpRequest.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    data = JSON.parse(this.responseText)
    temperature = convertData(data, 'temperatura')
    generateGraph('Temperatura')
    humidity = convertData(data, 'humedad')
    generateGraph('Humedad')
    console.log(temperature)
  }
}

window.addEventListener('DOMContentLoaded', () => {
  getData()
})

const getData = () => {
  httpRequest.open('POST', "/loadData")
  httpRequest.send(form)
}

const convertData = (data, dataType) => {
  let convertedData = data.map((obj) => {
    return {
      x: Date.parse(obj.fecha),
      y: obj[dataType]
    }
  });

  return convertedData
}

function generateGraph(title) {
  let options = {
    chart: {
      height: 500,
      width: "100%",
      type: "line",
      animations: {
        initialAnimation: {
          enabled: true
        },
        enabled: true,
        easing: 'linear',
        dynamicAnimation: {
          speed: 1000
        }
      },
      toolbar: {
        show: false
      },
      zoom: {
        enabled: false
      }
    },
    title: {
      text: title,
      align: 'center'
    },
    stroke: {
      curve: 'smooth'
    },
    markers: {
      size: 0
    },
    legend: {
      show: false
    },
    series: [
      {
        name: title,
        data: title == "Temperatura" ? temperature
            : title == "Humedad" ? humidity
            : null
      },
    ],
    xaxis: {
      type: "datetime"
    }
  };

  let chart = new ApexCharts(document.getElementById("chart" + title), options);

  chart.render();

  // setInterval(getData, 2000)
  // chart.updateSeries([{
  //     data: data
  //   }])
}
</script>
@endsection