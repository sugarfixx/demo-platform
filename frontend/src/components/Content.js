import React, { Component } from 'react';
import ContentList from './ContentList';
const url = "http://beffe.test/api/content";
class Content extends Component {
    constructor(props) {
        super(props);

        this.state={content : ''}
    }

    render() {
        return (
            <React.Fragment>
                <h2>Content</h2>
                <ContentList dataList={this.state.content}/>
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
            .then((data) => {
                console.log('result',data);
                this.setState({
                    content: data
                })
            })
    }
}

export default Content;
