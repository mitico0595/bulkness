@extends('layouts.app')

@section('title','Nuevo producto')

@section('content')
<div class="page" style="min-height:100vh;background:#f9fafb">
  <div class="wrap" style="max-width:1120px;margin:0 auto;padding:1rem">
    <form method="POST" action="{{ route('admin.products.store') }}" class="card" style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.04);padding:1rem">
      @csrf

      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
        <h1 style="font-weight:800;font-size:20px;color:#111827;margin:0">Crear producto</h1>
        <a href="{{ route('admin.products.index') }}" style="text-decoration:none">Volver</a>
      </div>

      @if ($errors->any())
        <div style="background:#fef2f2;border:1px solid #ef4444;color:#991b1b;padding:.7rem 1rem;border-radius:8px;margin-bottom:1rem">
          <strong>Revisa los campos:</strong>
          <ul style="margin:.4rem 0 0 1rem">
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Básicos --}}
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px">
        <div>
          <label>Nombre</label>
          <input name="name" required class="inp">
        </div>
        <div>
          <label>Tipo</label>
          <input name="tipo" type="number" class="inp">
        </div>
        <div>
          <label>Categoría</label>
          <input name="categoria" class="inp">
        </div>
        <div>
          <label>Código</label>
          <input name="codigo" class="inp">
        </div>

        <div>
          <label>Precio</label>
          <input name="precio" type="number" step="0.01" class="inp">
        </div>
        <div>
          <label>Costo</label>
          <input name="costo" type="number" step="0.01" class="inp">
        </div>
        <div>
          <label>Precio oferta</label>
          <input name="preciof" type="number" step="0.01" class="inp">
        </div>
        <div>
          <label>Stock</label>
          <input name="stock" class="inp">
        </div>

        <div>
          <label>Volumen</label>
          <input name="volumen" type="number" step="0.01" class="inp">
        </div>
        <div>
          <label>Puntos</label>
          <input name="puntos" class="inp">
        </div>
        <div>
          <label>Fecha (texto)</label>
          <input name="fecha" class="inp" placeholder="YYYY-MM-DD o lo que uses">
        </div>
        <div style="display:flex;gap:10px;align-items:center">
          <label style="white-space:nowrap">Oferta</label>
          <input type="checkbox" name="oferta" value="1">
          <label style="white-space:nowrap">Preventa</label>
          <input type="checkbox" name="preventab" value="1">
          <label style="white-space:nowrap">Impropio</label>
          <input type="checkbox" name="impropio" value="1">
          <label style="white-space:nowrap">Solicitado</label>
          <input type="checkbox" name="soli" value="1">
        </div>

        <div style="grid-column:1/3">
          <label>Imagen principal (ruta)</label>
          <input name="image" class="inp">
        </div>
        <div>
          <label>Thumb (ruta)</label>
          <input name="thumb" class="inp">
        </div>
        <div>
          <label>Imagen 1</label>
          <input name="image1" class="inp">
        </div>
        <div>
          <label>Imagen 2</label>
          <input name="image2" class="inp">
        </div>
        <div>
          <label>Imagen 3</label>
          <input name="image3" class="inp">
        </div>
      </div>

      <div style="margin-top:14px">
        <label>Descripción</label>
        <textarea name="description" rows="4" class="inp"></textarea>
      </div>

      {{-- Características simples (varchar): escribe una por línea o separadas por coma --}}
      <div style="margin-top:14px">
        <label>Características (rápidas)</label>
        <textarea name="caracteristicas_raw" rows="3" class="inp" placeholder="Una por línea o separadas por coma"></textarea>
        <small style="color:#6b7280">Se guardan como texto plano concatenado. Para chips rápidos en el front.</small>
      </div>

      {{-- Builder: CARACTERISTICAS2 --}}
      <div style="margin-top:18px">
        <h3 style="margin:0 0 8px 0">Características 2</h3>
        <div id="car2-list" style="display:flex;flex-direction:column;gap:10px"></div>
        <button type="button" class="btn" onclick="addCar2()">+ Agregar fila</button>
      </div>

      {{-- Builder: ESPECIFICACIONES --}}
      <div style="margin-top:18px">
        <h3 style="margin:0 0 8px 0">Especificaciones</h3>
        <div id="esp-list" style="display:flex;flex-direction:column;gap:10px"></div>
        <button type="button" class="btn" onclick="addEsp()">+ Agregar fila</button>
        <small style="color:#6b7280;display:block;margin-top:6px">La columna “imagen” es opcional; guarda solo la ruta (ej. iconos svg).</small>
      </div>

      <div style="margin-top:18px;display:flex;justify-content:flex-end;gap:10px">
        <button type="submit" class="btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<style>
  .inp{width:100%;padding:.55rem .65rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff}
  .btn{padding:.4rem .7rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;cursor:pointer}
  .btn-primary{padding:.55rem .9rem;border-radius:8px;background:#111827;color:#fff;border:none;cursor:pointer}
  .row{display:grid;grid-template-columns:1fr 1fr auto;gap:8px}
  .row-esp{display:grid;grid-template-columns:1.1fr 1fr 1.2fr auto;gap:8px}
  .x{border:1px solid #ef4444;background:#fff;color:#ef4444;border-radius:8px;padding:.35rem .6rem;cursor:pointer}
  label{display:block;font-size:.85rem;color:#374151;margin-bottom:.25rem}
</style>

<script>
  function addCar2(titulo='', valor='') {
    const wrap = document.getElementById('car2-list');
    const row = document.createElement('div');
    row.className = 'row';
    row.innerHTML = `
      <input name="car2_titulo[]" class="inp" placeholder="Título" value="${titulo}">
      <input name="car2_valor[]" class="inp" placeholder="Valor" value="${valor}">
      <button type="button" class="x" onclick="this.parentElement.remove()">Quitar</button>
    `;
    wrap.appendChild(row);
  }

  function addEsp(img='', tit='', val='') {
    const wrap = document.getElementById('esp-list');
    const row = document.createElement('div');
    row.className = 'row-esp';
    row.innerHTML = `
      <input name="esp_imagen[]" class="inp" placeholder="imagen.svg (opcional)" value="${img}">
      <input name="esp_titulo[]" class="inp" placeholder="Título" value="${tit}">
      <input name="esp_valor[]"  class="inp" placeholder="Valor" value="${val}">
      <button type="button" class="x" onclick="this.parentElement.remove()">Quitar</button>
    `;
    wrap.appendChild(row);
  }

  // Arranca con una fila vacía en cada builder
  addCar2();
  addEsp();
</script>
@endsection
