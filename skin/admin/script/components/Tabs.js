export default class Tabs {
  constructor(tabsSelector = 'ul.nav-tabs > li') {
    this.tabsSelector = tabsSelector;
    this.tabsElement = document.querySelectorAll(this.tabsSelector);

    this.ACTIVE_CLASS = 'active';

  }
  init() {

    for (let i = 0; i < this.tabsElement.length; i++) {
      this.tabsElement[i].addEventListener('click', this.switchTab);
    }
  }

  switchTab = (event) => {
    event.preventDefault();

    document.querySelector('ul.nav-tabs li.active').classList.remove(this.ACTIVE_CLASS);
    document.querySelector('.tab-pane.active').classList.remove(this.ACTIVE_CLASS);

    const clickedTab = event.currentTarget;
    const anchor = event.target;
    const activePaneID = anchor.getAttribute('href');

    clickedTab.classList.add(this.ACTIVE_CLASS);
    document.querySelector(activePaneID).classList.add(this.ACTIVE_CLASS);
  }
}
