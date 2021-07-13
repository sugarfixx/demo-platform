import React, { Component } from 'react';
const url = "http://beffe.test/api/content";
class Content extends Component {
    constructor(props) {
        super(props);

        this.state={data : ''}
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
        fetch(url, {
            method : 'GET',
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + this.props.location.state.bearer
            },

        }).then((res)  => res.json())
            .then((data) => {
                console.log(data)
                this.setState({data:data})
            })
    }
}

export default Content;
