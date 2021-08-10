import React, { Component } from 'react';
import ContentList from './ContentList';
const url = "http://beffe.test/api/content";
class Content extends Component {
    constructor(props) {
        super(props);

        this.state={data : ''}
    }

    render() {
        return (
            <React.Fragment>
                <h2>Content</h2>
                <ContentList dataList={this.state.data}/>
            </React.Fragment>
        );
    }
    componentDidMount() {
        // console.log(this.props.location.state.bearer)
        fetch(url, {
            method : 'GET',
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + this.props.location.state.bearer
            },
        }).then((res)  => res.json())
            .then((result) => {
                this.setState({
                    data: result
                })
            })
    }
}

export default Content;
