@extends('layouts.app')

@section('title','Editar producto')

@section('content')
{{-- Necesario para fetch/AJAX --}}
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<div class="page" style="min-height:100vh;background:#f9fafb">
  <div class="wrap" style="max-width:1120px;margin:0 auto;padding:1rem">
    <div class="card" style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.04);padding:1rem">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
        <h1 style="font-weight:800;font-size:20px;color:#111827;margin:0">Editar: #{{ $search->id }}</h1>
        <a href="{{ route('admin.products.index') }}" style="text-decoration:none">Volver</a>
      </div>

      @if (session('status'))
        <div style="background:#ecfeff;border:1px solid #06b6d4;padding:.6rem 1rem;border-radius:8px;margin-bottom:1rem">
          {{ session('status') }}
        </div>
      @endif

      <form id="form-edit" method="POST" action="{{ route('admin.products.update', $search) }}">
        @csrf @method('PUT')

        {{-- Básicos --}}
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px">
          <div>
            <label>Nombre</label>
            <input name="name" required class="inp" value="{{ $search->name }}">
          </div>
          <div>
            <label>Tipo</label>
            <input name="tipo" type="number" class="inp" value="{{ $search->tipo }}">
          </div>
          <div>
            <label>Categoría</label>
            <input name="categoria" class="inp" value="{{ $search->categoria }}">
          </div>
          <div>
            <label>Código</label>
            <input name="codigo" class="inp" value="{{ $search->codigo }}">
          </div>

          <div>
            <label>Precio</label>
            <input name="precio" type="number" step="0.01" class="inp" value="{{ $search->precio }}">
          </div>
          <div>
            <label>Costo</label>
            <input name="costo" type="number" step="0.01" class="inp" value="{{ $search->costo }}">
          </div>
          <div>
            <label>Precio oferta</label>
            <input name="preciof" type="number" step="0.01" class="inp" value="{{ $search->preciof }}">
          </div>
          <div>
            <label>Stock</label>
            <input name="stock" class="inp" value="{{ $search->stock }}">
          </div>

          <div>
            <label>Volumen</label>
            <input name="volumen" type="number" step="0.01" class="inp" value="{{ $search->volumen }}">
          </div>
          <div>
            <label>Puntos</label>
            <input name="puntos" class="inp" value="{{ $search->puntos }}">
          </div>
          <div>
            <label>Fecha</label>
            <input name="fecha" class="inp" value="{{ $search->fecha }}">
          </div>

          <div style="display:flex;gap:10px;align-items:center">
            <label style="white-space:nowrap">Oferta</label>
            <input type="checkbox" name="oferta" value="1" {{ $search->oferta ? 'checked' : '' }}>
            <label style="white-space:nowrap">Preventa</label>
            <input type="checkbox" name="preventab" value="1" {{ $search->preventab ? 'checked' : '' }}>
            <label style="white-space:nowrap">Impropio</label>
            <input type="checkbox" name="impropio" value="1" {{ $search->impropio ? 'checked' : '' }}>
            <label style="white-space:nowrap">Solicitado</label>
            <input type="checkbox" name="soli" value="1" {{ $search->soli ? 'checked' : '' }}>
          </div>

          <div style="grid-column:1/3">
            <label>Imagen principal (ruta)</label>
            <input name="image" class="inp" value="{{ $search->image }}">
          </div>
          <div>
            <label>Thumb (ruta)</label>
            <input name="thumb" class="inp" value="{{ $search->thumb }}">
          </div>
          <div>
            <label>Imagen 1</label>
            <input name="image1" class="inp" value="{{ $search->image1 }}">
          </div>
          <div>
            <label>Imagen 2</label>
            <input name="image2" class="inp" value="{{ $search->image2 }}">
          </div>
          <div>
            <label>Imagen 3</label>
            <input name="image3" class="inp" value="{{ $search->image3 }}">
          </div>
        </div>

        <div style="margin-top:14px">
          <label>Descripción</label>
          <textarea name="description" rows="4" class="inp">{{ $search->description }}</textarea>
        </div>

        {{-- Características simples (varchar) como textarea editable --}}
        <div style="margin-top:14px">
          <label>Características (rápidas)</label>
          <textarea name="caracteristicas_raw" rows="3" class="inp" placeholder="Una por línea o separadas por coma">{{ $search->caracteristicas }}</textarea>
          <small style="color:#6b7280">Se guardan como texto plano concatenado por “ | ”.</small>
        </div>

        {{-- Builder: CARACTERISTICAS2 --}}
        <div style="margin-top:18px">
          <h3 style="margin:0 0 8px 0">Características 2</h3>
          <div id="car2-list" style="display:flex;flex-direction:column;gap:10px"></div>
          <div style="display:flex;gap:10px;margin-top:8px">
            <button type="button" class="btn" onclick="addCar2()">+ Agregar fila vacía</button>
          </div>
        </div>

        {{-- Builder: ESPECIFICACIONES --}}
        <div style="margin-top:18px">
          <h3 style="margin:0 0 8px 0">Especificaciones</h3>
          <div id="esp-list" style="display:flex;flex-direction:column;gap:10px"></div>
          <div style="display:flex;gap:10px;margin-top:8px">
            <button type="button" class="btn" onclick="addEsp()">+ Agregar fila vacía</button>
          </div>
          <small style="color:#6b7280;display:block;margin-top:6px">La columna “imagen” es opcional; guarda solo la ruta, ej: <code>iconos/peso.svg</code>.</small>
        </div>

        <div style="margin-top:18px;display:flex;gap:10px;justify-content:flex-end">
          <button type="button" class="btn" onclick="saveAjax()">Guardar sin recargar</button>
          <button type="submit" class="btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .inp{width:100%;padding:.55rem .65rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff}
  .btn{padding:.45rem .75rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;cursor:pointer}
  .btn-primary{padding:.6rem .95rem;border-radius:8px;background:#111827;color:#fff;border:none;cursor:pointer}
  .row{display:grid;grid-template-columns:1fr 1fr auto;gap:8px;align-items:center}
  .row-esp{display:grid;grid-template-columns:1.1fr 1fr 1.2fr auto;gap:8px;align-items:center}
  .x{border:1px solid #ef4444;background:#fff;color:#ef4444;border-radius:8px;padding:.35rem .6rem;cursor:pointer}
  label{display:block;font-size:.85rem;color:#374151;margin-bottom:.25rem}
  #toast{position:fixed;right:16px;bottom:16px;background:#111827;color:#fff;padding:.6rem .9rem;border-radius:10px;opacity:0;transform:translateY(10px);transition:all .25s}
  #toast.show{opacity:1;transform:translateY(0)}
  .modal-backdrop{
    position:fixed;inset:0;background:rgba(0,0,0,.45);
    display:none;align-items:center;justify-content:center;z-index:50
  }
  .modal{
    background:#fff;border:1px solid #e5e7eb;border-radius:12px;
    width:min(680px,92vw);padding:16px;box-shadow:0 10px 30px rgba(0,0,0,.2)
  }
  .modal h3{margin:.2rem 0 1rem 0}
</style>

<div id="toast">Guardado</div>

{{-- MODAL REUTILIZABLE (4.3.3) --}}
<div id="modal-backdrop" class="modal-backdrop">
  <div class="modal">
    <h3 id="modal-title">Editar</h3>

    <div id="modal-body">
      {{-- contenido dinámico --}}
    </div>

    <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:12px">
      <button type="button" class="btn" onclick="closeModal()">Cancelar</button>
      <button type="button" class="btn-primary" onclick="submitInline()">Guardar</button>
    </div>
  </div>
</div>

<script>
  // URLs, tokens, datos
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const inlineUrl = "{{ route('admin.products.inline', $search) }}";

  const car2Data = @json($search->caracteristicas2 ?? []);
  const espData  = @json($search->especificaciones ?? []);

  // Toast UX mínimo
  function toast(msg='Guardado') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(()=>t.classList.remove('show'), 1500);
  }

  // Guardado global sin recargar (mantén de Parte 3)
  async function saveAjax() {
    const form = document.getElementById('form-edit');
    const url  = form.action;
    const fd   = new FormData(form);
    fd.append('_method','PUT');
    try {
      const res = await fetch(url, {
        method: 'POST',
        headers: {'X-Requested-With': 'XMLHttpRequest','Accept':'application/json'},
        body: fd
      });
      if (!res.ok) {
        const data = await res.json().catch(()=>({}));
        const msg = data.message || 'Error al guardar';
        toast(msg);
        return;
      }
      toast('Cambios guardados');
    } catch (e) {
      toast('Error de red');
    }
  }

  // Helpers para índice DOM
  function getIndexFromRow(rowEl, parentId) {
    const list = Array.from(document.getElementById(parentId).children);
    return list.indexOf(rowEl);
  }

  // Render filas con botones Editar/Quitar (4.3.2)
  function addCar2(titulo='', valor='') {
    const wrap = document.getElementById('car2-list');
    const row = document.createElement('div');
    row.className = 'row';
    row.innerHTML = `
      <input name="car2_titulo[]" class="inp" placeholder="Título" value="${titulo}" readonly>
      <input name="car2_valor[]"  class="inp" placeholder="Valor" value="${valor}" readonly>
      <div style="display:flex;gap:6px">
        <button type="button" class="btn" onclick="openModal('caracteristicas2', this.closest('.row'))">Editar</button>
        <button type="button" class="x" onclick="deleteRowInline('caracteristicas2', this.closest('.row'))">Quitar</button>
      </div>
    `;
    wrap.appendChild(row);
  }

  function addEsp(img='', tit='', val='') {
    const wrap = document.getElementById('esp-list');
    const row = document.createElement('div');
    row.className = 'row-esp';
    row.innerHTML = `
      <input name="esp_imagen[]" class="inp" placeholder="imagen.svg (opcional)" value="${img}" readonly>
      <input name="esp_titulo[]" class="inp" placeholder="Título" value="${tit}" readonly>
      <input name="esp_valor[]"  class="inp" placeholder="Valor" value="${val}" readonly>
      <div style="display:flex;gap:6px">
        <button type="button" class="btn" onclick="openModal('especificaciones', this.closest('.row-esp'))">Editar</button>
        <button type="button" class="x" onclick="deleteRowInline('especificaciones', this.closest('.row-esp'))">Quitar</button>
      </div>
    `;
    wrap.appendChild(row);
  }

  // Precarga datos existentes
  if (car2Data.length) car2Data.forEach(i => addCar2(i.titulo ?? '', i.valor ?? ''));
  else addCar2();

  if (espData.length) espData.forEach(i => addEsp(i.imagen ?? '', i.titulo ?? '', i.valor ?? ''));
  else addEsp();

  // Modal state
  let currentField = null; // 'caracteristicas2' | 'especificaciones'
  let currentRowEl = null;
  let currentIndex = null;

  function openModal(field, rowEl) {
    currentField = field;
    currentRowEl = rowEl;
    currentIndex = getIndexFromRow(rowEl, field === 'caracteristicas2' ? 'car2-list' : 'esp-list');

    const mb = document.getElementById('modal-backdrop');
    const body = document.getElementById('modal-body');
    const title = document.getElementById('modal-title');

    if (field === 'caracteristicas2') {
      const titulo = rowEl.children[0].value || '';
      const valor  = rowEl.children[1].value || '';
      title.textContent = 'Editar característica';
      body.innerHTML = `
        <div class="row">
          <div><label>Título</label><input id="m_titulo" class="inp" value="${titulo}"></div>
          <div><label>Valor</label><input id="m_valor" class="inp" value="${valor}"></div>
        </div>
      `;
    } else {
      const img = rowEl.children[0].value || '';
      const tit = rowEl.children[1].value || '';
      const val = rowEl.children[2].value || '';
      title.textContent = 'Editar especificación';
      body.innerHTML = `
        <div class="row-esp">
          <div><label>Imagen (ruta .svg opcional)</label><input id="m_img"   class="inp" value="${img}"></div>
          <div><label>Título</label><input id="m_titulo" class="inp" value="${tit}"></div>
          <div><label>Valor</label><input id="m_valor"  class="inp" value="${val}"></div>
        </div>
      `;
    }

    mb.style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('modal-backdrop').style.display = 'none';
    currentField = null; currentRowEl = null; currentIndex = null;
  }

  async function submitInline() {
    // Construir payload según el tipo
    let value = {};
    if (currentField === 'caracteristicas2') {
      value = {
        titulo: document.getElementById('m_titulo').value.trim(),
        valor:  document.getElementById('m_valor').value.trim()
      };
    } else {
      value = {
        imagen: document.getElementById('m_img').value.trim(),
        titulo: document.getElementById('m_titulo').value.trim(),
        valor:  document.getElementById('m_valor').value.trim()
      };
    }

    try {
      const res = await fetch(inlineUrl, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
          field: currentField,
          op: 'update',
          index: currentIndex,
          value
        })
      });

      if (!res.ok) {
        const data = await res.json().catch(()=>({}));
        toast(data.message || 'Error al guardar');
        return;
      }

      // Reflejar cambios en el row sin recargar
      if (currentField === 'caracteristicas2') {
        currentRowEl.children[0].value = value.titulo || '';
        currentRowEl.children[1].value = value.valor  || '';
      } else {
        currentRowEl.children[0].value = value.imagen || '';
        currentRowEl.children[1].value = value.titulo || '';
        currentRowEl.children[2].value = value.valor  || '';
      }

      closeModal();
      toast('Actualizado');
    } catch (e) {
      toast('Error de red');
    }
  }

  async function deleteRowInline(field, rowEl) {
    const idx = getIndexFromRow(rowEl, field === 'caracteristicas2' ? 'car2-list' : 'esp-list');
    try {
      const res = await fetch(inlineUrl, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
          field: field,
          op: 'delete',
          index: idx
        })
      });
      if (!res.ok) {
        const data = await res.json().catch(()=>({}));
        toast(data.message || 'No se pudo eliminar');
        return;
      }
      rowEl.remove();
      toast('Eliminado');
    } catch (e) {
      toast('Error de red');
    }
  }
</script>
@endsection
