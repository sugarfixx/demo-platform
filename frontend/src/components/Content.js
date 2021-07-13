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
        console.log(this.props.match.params.token)
    }
}

export default Content;
