
document.addEventListener('DOMContentLoaded', () => {
  const $ = id => document.getElementById(id);
  const fmt = cents => (cents/100).toFixed(2);

  // Estado
  const backpacks = { red: 0, blue: 0, black: 0 };
  const priceCents = { red: 5990, blue: 5990, black: 7990 };
  // Opcional: catálogo estático si quieres
  const kitsInfo = [
    {id:1, name:"ELEMENTAL", cents:1490},
    {id:2, name:"BASIC",     cents:4990},
    {id:3, name:"MEDIC",     cents:6990},
    {id:4, name:"SURVIVOR",  cents:14990},
    {id:5, name:"TOTALLY",   cents:19990},
    {id:6, name:"KALYPSO",   cents:43990},
  ];

  let kitAll = null; // {id, name, cents} si se aplica a todas

  // Botones + y inputs visibles
  ['red','blue','black'].forEach(color => {
    const btn = $(`add_${color}`);   // <button id="add_red">+</button> etc.
    if (btn) btn.addEventListener('click', () => {
      backpacks[color]++;
      if ($(color)) $(color).value = backpacks[color]; // <input id="red">
      updateSubtotal();
    });
    const input = $(color);
    if (input) input.addEventListener('input', () => {
      const v = parseInt(input.value || '0', 10);
      backpacks[color] = isNaN(v) ? 0 : Math.max(0, v);
      updateSubtotal();
    });
  });

  function totalBackpacks() {
    return backpacks.red + backpacks.blue + backpacks.black;
  }

  function updateSubtotal() {
    let total = backpacks.red*priceCents.red + backpacks.blue*priceCents.blue + backpacks.black*priceCents.black;
    if (kitAll) total += totalBackpacks() * kitAll.cents;

    if ($('total')) $('total').value = fmt(total);
    // Mantén ints para enviar al backend
    if ($('total_cents')) $('total_cents').value = total;
    if ($('red_c')) $('red_c').value = backpacks.red;
    if ($('blue_c')) $('blue_c').value = backpacks.blue;
    if ($('black_c')) $('black_c').value = backpacks.black;
  }

  // Paso siguiente
  const btnNext = $('next');
  if (btnNext) btnNext.addEventListener('click', () => {
    if (totalBackpacks() === 0) {
      alert('Por favor, selecciona al menos una mochila.');
      return;
    }
    if ($('section1')) $('section1').style.display = 'none';
    if ($('selector')) $('selector').style.display = 'block';
  });

  // “Mismo kit para todas”
  const sameKitBtn = $('samekit');
  if (sameKitBtn) sameKitBtn.addEventListener('click', () => {
    if ($('selector')) $('selector').style.display = 'none';
    if ($('kits')) $('kits').style.display = 'block';
  });

  // Botones de kit: usa data-attributes en el HTML:
  // <button class="kit-btn" data-kit-id="2" data-kit-name="BASIC" data-kit-price="49.90">...</button>
  document.querySelectorAll('.kit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id    = parseInt(btn.dataset.kitId, 10);
      const name  = btn.dataset.kitName || '';
      const cents = Math.round(parseFloat(btn.dataset.kitPrice || '0') * 100);
      kitAll = { id, name, cents };

      // Guardar flags para backend (hidden inputs)
      if ($('kit_apply_all')) $('kit_apply_all').value = 1;
      if ($('kit_all_id'))    $('kit_all_id').value = id;

      // Render de preview (opcional)
      renderPreview();

      if ($('kits')) $('kits').style.display = 'none';
      if ($('pasotres')) $('pasotres').style.display = 'block';

      updateSubtotal();
    });
  });

  function renderPreview() {
    const cont = $('pasotres');
    if (!cont) return;
    cont.innerHTML = '<h5 style="font-size:25px;margin-top:40px;margin-bottom:30px;">Paso 3: Verifique su pedido</h5>';
    ['red','blue','black'].forEach(color => {
      for (let i=0; i<backpacks[color]; i++) {
        cont.appendChild(backpackTemplate(color, kitAll ? kitAll.cents : 0));
      }
    });
  }

  function backpackTemplate(color, kitCents) {
    const div = document.createElement('div');
    div.className = 'contentkit';
    const subDiv = document.createElement('div');
    subDiv.className = 'subcontentkit';

    let imgSrc = '', borderColor = '#282828';
    if (color === 'red')  { imgSrc = '/image/thumb/bag/red.png';  borderColor = '#c13434'; }
    if (color === 'blue') { imgSrc = '/image/thumb/bag/blue.png'; borderColor = '#243cb1'; }
    if (color === 'black'){ imgSrc = '/image/thumb/bag/black.png';borderColor = '#282828'; }

    const kitName = kitAll ? kitAll.name : 'SIN KIT';
    const img = document.createElement('img'); img.src = imgSrc; subDiv.appendChild(img);

    const title = document.createElement('div');
    title.className = 'titlekit'; title.style.color = borderColor; title.textContent = kitName;
    subDiv.style.border = '3px solid ' + borderColor;
    subDiv.appendChild(title);

    const etiquetas = document.createElement('div'); etiquetas.className = 'etiquetakit';
    const subEt = document.createElement('div'); subEt.className = 'subetiqueta';
    subEt.style.background = borderColor; subEt.style.borderColor = borderColor; subEt.style.color = borderColor;

    const subKit = document.createElement('div'); subKit.className = 'subkit'; subKit.textContent = kitName; subEt.appendChild(subKit);
    const subCosto = document.createElement('div'); subCosto.className = 'subcosto'; subCosto.textContent = `S/. ${(kitCents/100).toFixed(2)}`; subEt.appendChild(subCosto);
    etiquetas.appendChild(subEt); subDiv.appendChild(etiquetas);

    const subtotal = document.createElement('div'); subtotal.className = 'subtotal';
    const subPoint = document.createElement('div'); subPoint.className = 'subpoint';
    subPoint.style.background = borderColor; subPoint.style.borderColor = borderColor; subPoint.style.color = borderColor;

    const subtotalDesc = document.createElement('div'); subtotalDesc.className = 'subtotaldesc'; subtotalDesc.textContent = 'SUBTOTAL';
    const subTodo = document.createElement('div'); subTodo.className = 'subtodo';
    const bagCents = priceCents[color];
    subTodo.textContent = `S/. ${((bagCents + kitCents)/100).toFixed(2)}`;

    subPoint.appendChild(subtotalDesc); subPoint.appendChild(subTodo);
    subtotal.appendChild(subPoint); subDiv.appendChild(subtotal); div.appendChild(subDiv);
    return div;
  }

  // inicial
  updateSubtotal();
});

  