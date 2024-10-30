/* global topbarOptions */
import React, {Component} from 'react';

// first we will make a new context
export const MyContext = React.createContext();

// Then create a provider Component
class MyProvider extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isLoaded: false,
      width: '100%',
      homeUrl: topbarOptions.homeUrl,
      logoUrl: '',
      pluginUrl: '',
      selectTitle: '',
      customHomepage: false,
      projects: [],
    };
  }

  componentDidMount() {
    fetch(topbarOptions.restUrl)
      .then((res) => res.json())
      .then(
        (result) => {
          this.setState({
            isLoaded: true,
            projects: result.projects,
            logoUrl: result.logo_url,
            pluginUrl: result.plugin_url,
            selectTitle: result.select_title,
            customHomepage: result.custom_homepage,
          });
        },

        // Note: it's important to handle errors here instead of a catch() block so that
        // we don't swallow exceptions from actual bugs in components.
        (error) => {
          this.setState({isLoaded: true, error});
        }
      );
  }

  render() {
    return (
      <MyContext.Provider value={{
        wpApi: this.state,
        changeWidth: (width) => this.setState({
          width,
        }),
      }}>
        {this.props.children}
      </MyContext.Provider>
    );
  }
}
export default MyProvider;
