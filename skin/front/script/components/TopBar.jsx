import {Component} from 'react';
import {
  FacebookShareButton,
  LinkedinShareButton,
  TwitterShareButton,
  FacebookIcon,
  LinkedinIcon,
  TwitterIcon,
} from 'react-share';
import Logo from './Logo.jsx';
import ProjectsSelect from './ProjectsSelect.jsx';
import Viewport from './Viewport.jsx';

class TopBar extends Component {
  shouldComponentUpdate() {
    return false;
  }
  render() {
    const selectTitleElement = (this.props.context.wpApi.selectTitle) ? this.props.context.wpApi.selectTitle : '';
    const styleTopbar = {
      backgroundColor: this.props.selectedProject.color,
    };

    const sharebgColor = {
      fill: '#333643',
    };

    return (
      <div style={styleTopbar} className="top-bar">
        <Logo
          homeUrl={this.props.context.wpApi.homeUrl}
          logoUrl={this.props.context.wpApi.logoUrl}
        />
        <div className="header-text">
          {selectTitleElement}
        </div>
        <ProjectsSelect
          selectedProject={{
            value: this.props.selectedProject.slug,
            label: this.props.selectedProject.title,
            color: this.props.selectedProject.color,
          }}
          projects={this.props.context.wpApi.projects}
        />
        <Viewport
          pluginUrl={this.props.context.wpApi.pluginUrl}
          changeWidth={this.props.context.changeWidth}
        />
        <div className="social">
          <FacebookShareButton className="share-item" url={this.props.context.wpApi.homeUrl}>
            <FacebookIcon
              round={true}
              size={32}
              iconBgStyle={sharebgColor}
              logoFillColor="#E1E3E1"
            />
          </FacebookShareButton>
          <TwitterShareButton className="share-item" url={this.props.context.wpApi.homeUrl}>
            <TwitterIcon
              round={true}
              size={32}
              iconBgStyle={sharebgColor}
              logoFillColor="#E1E3E1"
            />
          </TwitterShareButton>
          <LinkedinShareButton className="share-item" url={this.props.context.wpApi.homeUrl}>
            <LinkedinIcon
              round={true}
              size={32}
              iconBgStyle={sharebgColor}
              logoFillColor="#E1E3E1"
            />
          </LinkedinShareButton>
        </div>
      </div>
    );
  }
}

export default TopBar;
