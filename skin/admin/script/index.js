import generalHelper from '../../helpers/general-helper';
import Tabs from './components/Tabs';
import Media from './components/Media';
import ColorPicker from './components/ColorPicker';

generalHelper.domReady(() => {

  // initialize tabs on showcase page
  const tabs = new Tabs('ul.nav-tabs > li');
  tabs.init();

  // initialize upload media for logo on dashboard page
  const imageElement = document.querySelector('.js-logo-image');
  if (imageElement) {
    const media = new Media(imageElement);
    media.init();
  }

  // initialize color picker
  const colorPickerElement = document.querySelector('.js-color-picker-button');
  if (colorPickerElement) {
    const colorPicker = new ColorPicker(colorPickerElement);
    colorPicker.init();
  }

});
