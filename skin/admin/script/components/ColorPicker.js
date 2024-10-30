import Picker from 'vanilla-picker';

export default class ColorPicker {
  constructor(colorPickerElement, colorPickerColorSelector = '.js-color-picker-color', colorPickerInputSelector = '.js-color-input') {

    this.colorPickerElement = colorPickerElement;
    this.colorPickerColorElement = document.querySelector(colorPickerColorSelector);
    this.colorPickerInputElement = document.querySelector(colorPickerInputSelector);

  }
  init() {

    const picker = new Picker({
      parent: this.colorPickerElement,
      popup: 'top',
      color: this.colorPickerInputElement.value || '#333643',
      editorFormat: 'hex',
      onDone: this.onColorPickedCallback,
      onChange: this.onColorPickedCallback,
    });


  }

  onColorPickedCallback = (color) => {
    this.colorPickerColorElement.style.backgroundColor = color.hex;
    this.colorPickerInputElement.value = color.hex;
  }

}
