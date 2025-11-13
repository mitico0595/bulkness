const tarjeta = document.querySelector('#tarjeta'),
	  btnAbrirFormulario = document.querySelector('#btn-abrir-formulario'),
	  formulario = document.querySelector('#checkout-form'),
	  numeroTarjeta = document.querySelector('#tarjeta .numero'),
	  nombreTarjeta = document.querySelector('#tarjeta .nombre'),
	  logoMarca = document.querySelector('#logo-marca'),
	  firma = document.querySelector('#tarjeta .firma p'),


      inputNombre = document.querySelector('#card-name'),
      inputApellido = document.querySelector('#card-lastname');

// * Volteamos la tarjeta para mostrar el frente.
const mostrarFrente = () => {
	if(tarjeta.classList.contains('active')){
		tarjeta.classList.remove('active');
	}
}

// * Rotacion de la tarjeta
tarjeta.addEventListener('click', () => {
	tarjeta.classList.toggle('active');
});



// * Select del mes generado dinamicamente.


// * Select del año generado dinamicamente.

// * Input numero de tarjeta


// * Input nombre de tarjeta
inputNombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	inputNombre.value = valorInput.replace(/[0-9]/g, '');
	nombreTarjeta.textContent = valorInput;
	firma.textContent = valorInput;

	if(valorInput == ''){
		nombreTarjeta.textContent = 'Insertar';
	}

	mostrarFrente();
});
inputApellido.addEventListener('keyup', (e) => {
	let valorInputo = e.target.value;

	inputApellido.value = valorInputo.replace(/[0-9]/g, '');
	nombreTarjeta.textContent = inputNombre.value +' '+valorInputo;
	firma.textContent = valorInputo;

	if(valorInputo == ''){
		nombreTarjeta.textContent = 'Insertar';
	}

	mostrarFrente();
});

// * Select mes


// * Select Año


// * CCV

