import React from 'react';
import {render} from 'react-dom';
import MyProvider, {MyContext} from './containers/Context.jsx';
import Routes from './Routes.jsx';

class ReactApp {
  init() {
    render(
      <MyProvider>
        <MyContext.Consumer>
          {(context) => (
            <Routes context={context} />
          )}
        </MyContext.Consumer>
      </MyProvider>,
      document.getElementById('react-topbar')
    );
  }
}


export {
  ReactApp,
};
