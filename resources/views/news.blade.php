@extends('layouts.app')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

  <h2 class="text-success mb-4"><i class="bi bi-newspaper"></i> Noticias deportivas</h2>

  <div class="row">
    @foreach (range(1, 6) as $i)
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="news-item">
        <img src="https://via.placeholder.com/80x80/333/fff?text=NEWS+{{ $i }}" alt="Noticia {{ $i }}">
        <div class="news-item-content">
          <h6><i class="bi bi-megaphone"></i> Título de la noticia {{ $i }}</h6>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.</p>
          <small><i class="bi bi-clock"></i> Hace {{ rand(1, 12) }}h • <i class="bi bi-eye"></i> {{ rand(100, 1000) }} visitas</small>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
