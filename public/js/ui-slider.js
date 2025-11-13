// ui-slider.js
(function(){
  const clamp = (v,min,max)=>Math.min(max,Math.max(min,v));
  const num = v => Number.isFinite(+v) ? +v : 0;

  function sync(el){
    const input = el.querySelector('.ui-slider__input');
    const track = el.querySelector('.ui-slider__track');
    const fill  = el.querySelector('.ui-slider__fill');
    const thumb = el.querySelector('.ui-slider__thumb');
    const out   = el.querySelector('.ui-slider__value');

    if(!input || !track || !fill || !thumb) return;

    const min  = num(input.min || el.dataset.min || 0);
    const max  = num(input.max || el.dataset.max || 100);
    const step = num(input.step || el.dataset.step || 1);

    let val = num(input.value ?? el.dataset.value ?? min);
    val = clamp(Math.round(val/step)*step, min, max);

    const pct = (max-min) ? ((val - min) / (max - min)) : 0;
    fill.style.width = (pct*100) + '%';
    thumb.style.left = (pct*100) + '%';
    if(out) out.textContent = String(val);

    el.setAttribute('role','slider');
    el.setAttribute('aria-valuemin', String(min));
    el.setAttribute('aria-valuemax', String(max));
    el.setAttribute('aria-valuenow', String(val));
  }

  function wire(el){
    // input nativo dispara toda la sincronización
    const input = el.querySelector('.ui-slider__input');
    if(!input) return;
    // si hay data-*, forzamos atributos del input
    if(el.dataset.min)  input.min  = el.dataset.min;
    if(el.dataset.max)  input.max  = el.dataset.max;
    if(el.dataset.step) input.step = el.dataset.step;
    if(el.dataset.value && !input.value) input.value = el.dataset.value;

    input.addEventListener('input', ()=> sync(el));
    input.addEventListener('change',()=> sync(el));

    // accesibilidad ligera con teclado en el wrapper
    el.tabIndex = 0;
    el.addEventListener('keydown', e=>{
      const step = num(input.step || 1);
      const min  = num(input.min || 0);
      const max  = num(input.max || 100);
      let v = num(input.value || min);
      if(e.key === 'ArrowLeft' || e.key === 'ArrowDown'){ v = clamp(v - step, min, max); input.value = v; input.dispatchEvent(new Event('input',{bubbles:true})); }
      if(e.key === 'ArrowRight'|| e.key === 'ArrowUp'  ){ v = clamp(v + step, min, max); input.value = v; input.dispatchEvent(new Event('input',{bubbles:true})); }
    });

    // opcional: click en carril mueve el valor
    const track = el.querySelector('.ui-slider__track');
    track.addEventListener('pointerdown', e=>{
      const rect = track.getBoundingClientRect();
      const min  = num(input.min || 0);
      const max  = num(input.max || 100);
      const step = num(input.step || 1);
      const dx = clamp((e.clientX - rect.left) / rect.width, 0, 1);
      const raw = min + dx*(max - min);
      const val = Math.round(raw/step)*step;
      input.value = val;
      input.dispatchEvent(new Event('input',{bubbles:true}));
    });

    // autoshow: sólo visible si tiene altura suficiente y está en viewport
    if(el.hasAttribute('data-autoshow')){
      const minH = num(el.dataset.minHeight || 0);
      const io = new IntersectionObserver(entries=>{
        for(const ent of entries){
          const hOk = ent.target.getBoundingClientRect().height >= minH;
          if(ent.isIntersecting && hOk) ent.target.classList.remove('is-hidden');
          else ent.target.classList.add('is-hidden');
        }
      }, { threshold: 0.01 });
      io.observe(el);
    }

    // primera sync
    sync(el);

    // re-sync en resize
    let t=null;
    window.addEventListener('resize', ()=>{
      clearTimeout(t); t=setTimeout(()=> sync(el), 80);
    });
  }

  // Construye wrapper si solo había <input type="range">
  function autoskinInput(input){
    if(input.closest('.ui-slider')) return;     // ya está dentro
    const wrap = document.createElement('div');
    wrap.className = 'ui-slider ui-slider--sm';
    // hereda atributos
    if(input.hasAttribute('min'))  wrap.dataset.min  = input.getAttribute('min');
    if(input.hasAttribute('max'))  wrap.dataset.max  = input.getAttribute('max');
    if(input.hasAttribute('step')) wrap.dataset.step = input.getAttribute('step');
    wrap.dataset.value = input.value || input.getAttribute('value') || wrap.dataset.min || '0';

    const track = document.createElement('div');
    track.className = 'ui-slider__track';
    track.innerHTML = '<div class="ui-slider__fill"></div><div class="ui-slider__thumb"></div>';

    const out = document.createElement('output');
    out.className = 'ui-slider__value';

    input.classList.add('ui-slider__input');
    input.parentNode.insertBefore(wrap, input);
    wrap.appendChild(input);
    wrap.appendChild(track);
    wrap.appendChild(out);

    wire(wrap);
  }

  function init(){
    // 1) Inicializa todos los wrappers declarativos
    document.querySelectorAll('.ui-slider').forEach(wire);
    // 2) “Pinta” globalmente cualquier <input type="range"> suelto
    document.querySelectorAll('input[type="range"]:not([data-noskin])').forEach(autoskinInput);
  }

  if(document.readyState === 'loading'){
    document.addEventListener('DOMContentLoaded', init);
  }else{
    init();
  }
})();
