@extends('layouts.app')
@section('page_name') Array @endsection
@section('section_header') Array @endsection
@section('breadcrumb')
<div class="breadcrumb-item"><a href="/">Home</a>
</div>
<div class="breadcrumb-item active">Array</div>
@endsection
@section('content')

<center><h2>Multidimensional Arrays </h2></center>
<pre>
       @php
      
            print_r($student);
        @endphp
</pre>
       

@endsection
