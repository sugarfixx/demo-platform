import React, { Component } from 'react';

class Content extends Component {
    constructor(props) {
        super(props);

        this.state={token : ''}
    }

    render() {
        return (
            <div>
                <h2>Content</h2>
            </div>
        );
    }
    componentDidMount() {
        console.log(this.props.location.state.bearer)
    }
}

export default Content;
