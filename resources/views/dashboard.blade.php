@extends('layout')

@section('content')
<h1>Dashboard</h1>

<script>
let data, temperature, humidity

const form = new FormData()
form.append('_token', '{{ csrf_token() }}')

const httpRequest = new XMLHttpRequest()
httpRequest.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    data = JSON.parse(this.responseText)
    temperature = convertData(data, 'temperatura')
    humidity = convertData(data, 'humedad')
  }
}

window.addEventListener('DOMContentLoaded', () => {
  getData()
  // setInterval(getData, 2000)
})

const getData = () => {
  httpRequest.open('POST', "/loadData")
  httpRequest.send(form)
}

const convertData = (data, dataType) => {
  let convertedData = data.map((obj) => {
    return {
      x: new Date(obj.fecha).toLocaleString("es-VE", { timeZone: 'America/Caracas', dateStyle: 'short', timeStyle: 'medium' }),
      y: obj[dataType]
    }
  });

  return convertedData
}
</script>
@endsection