import React, { Component } from 'react';

const url = "http://beffe.test/api/resources/user/";

class UserDetail extends Component {
    constructor(props) {
        super(props);

        this.state={user : ''}
    }
    render() {
        console.log(this.state.user)
        const {params} = this.props.match
        return (
            <React.Fragment>
                <h1>User details for user {params.id}</h1>
            </React.Fragment>
        )
    }

    componentDidMount() {
        fetch(url + this.props.match.params.id, {
            Method : 'GET'
        }).then((res)  => res.json())
            .then((data) => {
                this.setState({user:data})
            })
    }

}

export  default  UserDetail;
