@extends('layout')

@section('content')
<h1>Dashboard</h1>

<script>
let data

const form = new FormData()
form.append('_token', '{{ csrf_token() }}')

const httpRequest = new XMLHttpRequest()
httpRequest.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    data = JSON.parse(this.responseText)
    console.log(data)
  }
}

window.addEventListener('DOMContentLoaded', () => {
  getData()
  setInterval(getData, 2000)
})

const getData = () => {
  httpRequest.open('POST', "/loadData")
  httpRequest.send(form)
}
</script>
@endsection