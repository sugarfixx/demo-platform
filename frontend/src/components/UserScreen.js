import React, { Component } from 'react';
import UserList from './UserList';
const url = "http://beffe.test/api/resources/user/";

class UserScreen extends Component {
    constructor(props) {
        super(props);

        this.state={users : ''}
    }

    render() {
        return (
            <React.Fragment>
                <h1>Users</h1>
                <p>Select one of the users bellow to continue</p>
                <UserList dataList={this.state.users} />
            </React.Fragment>
        )
    }

    componentDidMount() {
        fetch(url, {
            Method : 'GET'
        }).then((res)  => res.json())
            .then((data) => {
                this.setState({users:data})
            })
    }
}


export default UserScreen
