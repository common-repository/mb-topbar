/* import style */
import '../scss/style.scss';
import {ReactApp} from './react-app.jsx';

/* import images */
const requireImages = require.context('../images', true, /\.(png|jpg)$/);
requireImages.keys().forEach(requireImages);

function init() {
  const reactApp = new ReactApp();

  reactApp.init();
}

window.onload = init;
