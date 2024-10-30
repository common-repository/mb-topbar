import {PureComponent} from 'react';
import TopBar from './TopBar.jsx';
import IframeContainer from './IframeContainer.jsx';

class App extends PureComponent {
  render() {
    return (
      <div className="react-container">
        <TopBar
          context={this.props.context}
          selectedProject={this.props.selectedProject}
        />
        <IframeContainer
          width={this.props.context.wpApi.width}
          selectedProject={this.props.selectedProject}
        />
      </div>
    );
  }
}

export default App;
