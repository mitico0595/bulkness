const mix = require('laravel-mix');
const fs  = require('fs');
const path = require('path');

mix.setPublicPath('public');
mix.options({ processCssUrls: false });
mix.disableNotifications();

function hasRes(type, file) {
  return fs.existsSync(path.join('resources', type, file));
}
function pub(type, file) {
  return path.join('public', type, file);
}
function safeCopy(from, to, label) {
  if (!fs.existsSync(from)) {
    console.warn('[mix] SKIP (' + label + ') no existe:', from);
    return;
  }
  if (path.resolve(from) === path.resolve(to)) {
    console.warn('[mix] SKIP (' + label + ') mismo origen/destino:', from);
    return;
  }
  mix.copy(from, to);
}

const cssFiles = [
  'adler.css','adminventa.css','app.css','articulo.css','auth.css',
  'bootstrap-select.min.css','boton.css','cart-mobile.css','checkout-mobile.css',
  'dapp.css','envio.css','estilos.css','fonts.css','footer.css','glider.css',
  'lightslider.css','load.css','materialize.css','mobile.css','pagos.css',
  'product.css','register-version.css','splide.css','splide.min.css',
  'sty-mobile.css','sty.css','styles.css','terminos.css','tienda.css',
  'ui-slider.css','user.css','viewer.css','yape.css'
];

const jsFiles = [
  'app.js','appnew.js','bootstrap-select.min.js','clock.js','dapp.js',
  'district.js','form.js','glider.min.js','jquery.min.js','kit.js',
  'lightslider.js','load.js','main.js','main2.js','materialize.js',
  'particle.js','regist.js','slide-adler.js','splide-extension-grid.js',
  'splide.js','splide.min.js','ui-slider.js','user.js','viewer.js'
];

// CSS
cssFiles.forEach(file => {
  if (hasRes('css', file)) {
    mix.postCss(`resources/css/${file}`, `public/css/${file}`, [require('autoprefixer')]);
  } else {
    safeCopy(pub('css', file), `public/css/${file}`, 'CSS');
  }
});

// JS
jsFiles.forEach(file => {
  if (hasRes('js', file)) {
    mix.js(`resources/js/${file}`, `public/js/${file}`);
  } else {
    safeCopy(pub('js', file), `public/js/${file}`, 'JS');
  }
});

if (mix.inProduction()) {
  mix.version();
} else {
  mix.sourceMaps();
}
