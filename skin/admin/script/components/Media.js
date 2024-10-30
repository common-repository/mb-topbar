/* global wp */
import {__} from '@wordpress/i18n';

export default class Media {
  constructor(imageElement, mediaSelector = '.js-logo-media-btn', removeSelector = '.js-logo-media-remove-btn', inputSelector = '.js-logo-url') {

    this.imageElement = imageElement;
    this.removeElement = document.querySelector(removeSelector);
    this.mediaElement = document.querySelector(mediaSelector);
    this.inputElement = document.querySelector(inputSelector);

    this.EMPTY_CLASS = 'empty';

    this.mediaUploader = false;

  }
  init() {
    this.mediaElement.addEventListener('click', this.mediaOnClickCallback);
    this.removeElement.addEventListener('click', this.mediaOnRemoveCallback);

    this.mediaUploader = wp.media({
      title: __('Choose a Logo Image', 'mb-topbar'),
      button: {
        text: __('Choose Logo', 'mb-topbar'),
      },
      multiple: false,
    });

    this.mediaUploader.on('select', this.mediaOnSelectCallback);

  }

  mediaOnClickCallback = (e) => {
    e.preventDefault();

    if (this.mediaUploader) {
      this.mediaUploader.open();
    }
  }

  mediaOnSelectCallback = () => {
    const attachment = this.mediaUploader.state().get('selection').first().toJSON();
    this.imageElement.style.backgroundImage = `url(${attachment.url})`;
    this.inputElement.value = attachment.url;
    this.imageElement.classList.remove(this.EMPTY_CLASS);
    this.mediaElement.textContent = __('Edit', 'mb-topbar');
  }

  mediaOnRemoveCallback = (e) => {
    e.preventDefault();
    this.imageElement.classList.add(this.EMPTY_CLASS);
    this.imageElement.style.backgroundImage = '';
    this.inputElement.value = '';
    this.mediaElement.textContent = __('Upload', 'mb-topbar');
  }
}
