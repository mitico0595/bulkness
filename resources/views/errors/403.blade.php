@extends('layouts.app')
@section('title', '403')
@section('content')
<div style="min-height:60vh;display:flex;align-items:center;justify-content:center;background:#f9fafb">
  <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:2rem;max-width:520px">
    <h2 style="margin:0 0 .5rem 0">403 · Acceso denegado</h2>
    <p style="color:#6b7280">No tienes permisos para ver esta sección.</p>
    <a href="{{ url('/') }}" style="display:inline-block;margin-top:1rem;background:#111827;color:#fff;padding:.5rem .9rem;border-radius:8px;text-decoration:none">Volver al inicio</a>
  </div>
</div>
@endsection
