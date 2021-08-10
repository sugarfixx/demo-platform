import React, { Component } from 'react';
import ContentList from './ContentList';
const url = "http://beffe.test/api/content";

class ContentScreen extends Component {
    constructor(props) {
        super(props);

        this.state={contents : ''}
    }

    render() {
        return (
            <React.Fragment>
                <h1>Contents</h1>
                <p>Select content to view details</p>
                <ContentList dataList={this.state.contents} />
            </React.Fragment>
        )
    }

    componentDidMount() {
        fetch(url, {
            Method : 'GET',
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + this.props.location.state.bearer
            }
        }).then((res)  => res.json())
            .then((data) => {
                if (data.original) {
                    let content = data.original;

                    this.setState({contents:content })
                }
                else {
                    this.setState({contents:data[0]})
                }

            })
    }
}


export default ContentScreen
