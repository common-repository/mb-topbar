import {PureComponent} from 'react';

class Viewport extends PureComponent {
  render() {
    const imageUrl =
      `${this.props.pluginUrl}skin/public/images/devices.png`;
    const style = {
      backgroundImage: `url(${imageUrl})`,
    };
    return (
      <div className="screen-wrapper">
        <button
          onClick={this.handleOnClick.bind(this, '100%')}
          id="desktop"
          className="btn-vieport-size desktop"
          title="View Desktop Version"
          style={style}
        />
        <button
          onClick={this.handleOnClick.bind(this, '1024px')}
          id="tabletLand"
          className="btn-vieport-size tablet-land"
          title="View Tablet Landscape (1024x768)"
          style={style}
        />
        <button
          onClick={this.handleOnClick.bind(this, '768px')}
          id="tabletPort"
          className="btn-vieport-size tablet-port"
          title="View Tablet Portrait (768x1024)"
          style={style}
        />
        <button
          onClick={this.handleOnClick.bind(this, '480px')}
          id="mobLand"
          className="btn-vieport-size mob-land"
          title="View Mobile Landscape (480x320)"
          style={style}
        />
        <button
          onClick={this.handleOnClick.bind(this, '320px')}
          id="mobPort"
          className="btn-vieport-size mob-port"
          title="View Mobile Portrait (320x480)"
          style={style}
        />
      </div>
    );
  }
  handleOnClick(value) {
    this.props.changeWidth(value);
  }
}

export default Viewport;
