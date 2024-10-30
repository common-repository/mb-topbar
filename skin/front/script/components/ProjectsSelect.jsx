import {Component} from 'react';
import {withRouter} from 'react-router-dom';
import Select from 'react-select';
import chroma from 'chroma-js';

class ProjectsSelect extends Component {

  bindSelectItems() {
    let items = [];
    if (this.props.projects.length >= 1) {
      items = this.props.projects.map((options) => {
        return {value: options.slug, label: options.title, color: options.color};
      });
    }
    return items;
  }
  render() {
    const selectItems = this.bindSelectItems();
    const defBgColor = '#E1E3E1';

    const colourStyles = {
      control: (styles) => ({
        ...styles,
        backgroundColor: defBgColor,
      }),
      container: (styles) => ({
        ...styles,
        margin: '0 10px',
        minWidth: '200px',
      }),
      menuList: (styles) => ({
        ...styles,
        padding: 0,
      }),
      option: (styles, {
        data,
        isFocused,
      }) => {

        const color = chroma(data.color);

        return {
          ...styles,
          backgroundColor: isFocused ? color.alpha(0.7).css() : defBgColor,
          color: isFocused ? defBgColor : data.color,
          cursor: 'default',
        };
      },
      singleValue: (styles, {
        data,
      }) => {
        return {
          ...styles,
          color: data.color,
        };
      },
    };

    return (
      <Select
        styles={colourStyles}
        value={this.props.selectedProject}
        onChange={this.handleOnChange}
        options={selectItems}
        theme={(theme) => ({
          ...theme,
          borderRadius: 0,
          spacing: {
            ...theme.spacing,
            baseUnit: 4,
            menuGutter: 0,
          },
        })}
      />
    );
  }

  handleOnChange = (selectedOption) => {

    if (this.props.history.location.pathname !== selectedOption.value) {
      this.props.history.push(selectedOption.value);
    }
  }
}

export default withRouter(ProjectsSelect);
