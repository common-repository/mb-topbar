import {Component} from 'react';
import {HashRouter, Switch, Route} from 'react-router-dom';
import App from './components/App.jsx';


class Routes extends Component {
  render() {
    const routes = this.bindRoutes(this);
    return (
      <HashRouter >
        <Switch>
          {routes}
        </Switch>
      </HashRouter >
    );
  }
  bindRoutes() {
    let items = [];
    let home = false;
    const {projects, customHomepage} = this.props.context.wpApi;

    if (projects.length >= 1) {
      items = projects.map((project, index) => {

        let slug = `/${project.slug}`;

        if (customHomepage) {

          if (!home) {
            if (project.is_home) {

              slug = '/';
              project.slug = '/';
              home = true;
            } else if (index === projects.length - 1) {

              slug = '/';
              project.slug = '/';
            }
          }
        } else if (index === 0) {

          slug = '/';
          project.slug = '/';
        }

        return (
          <Route key={index} path={slug} exact={true} render={
            () => {
              return (<App context={this.props.context} selectedProject={project} />);
            }
          } />
        );
      });
    }
    return items;
  }
}


export default Routes;
