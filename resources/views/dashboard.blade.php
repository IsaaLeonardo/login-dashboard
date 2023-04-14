@extends('layout')

@section('content')
<h1>Dashboard</h1>

<script>
// Un array de objetos:
let data = @json($measurements);
</script>
@endsection