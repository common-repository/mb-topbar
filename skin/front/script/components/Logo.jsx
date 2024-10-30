import {PureComponent} from 'react';
import {__} from '@wordpress/i18n';
import icons from '../icons';

class Logo extends PureComponent {

  getLogoElement = () => {

    if (this.props.logoUrl) {
      const logoStyle = {
        backgroundImage: `url(${this.props.logoUrl})`,
      };
      return (
        <div className="mb-topbar-logo" style={logoStyle}></div>
      );
    }
    return (
      <div className="mb-topbar-logo">
        {icons.default}
      </div>
    );
  }
  render() {
    const logoElement = this.getLogoElement();
    return (
      <a
        className="logo"
        href={this.props.homeUrl}
        title={__('Homepage Link', 'mb-topbar')}>
        {logoElement}
      </a>
    );
  }
}

export default Logo;
