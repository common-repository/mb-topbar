import {PureComponent} from 'react';

class IframeContainer extends PureComponent {
  render() {
    const style = {
      width: this.props.width,
    };
    const url = this.props.selectedProject.link;
    return (
      <div id="iframeContainer" className="container-iframe" style={style}>
        <iframe title="page" id="iframe" src={url} frameBorder="0" />
      </div>
    );
  }
}

export default IframeContainer;
