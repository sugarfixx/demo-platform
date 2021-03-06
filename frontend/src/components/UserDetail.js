import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import TenantList from './TenantList';
const url = "http://beffe.test/api/resources/user/";

class UserDetail extends Component {
    constructor(props) {
        super(props);

        this.state={
            user : {},
            homeTenant :{},
            remoteTenants : {}
        }
    }
    render() {
        const {params} = this.props.match;
        return (
            <React.Fragment>
                <h1>User details for user: {this.state.user.email}</h1>
                <span>User {this.state.user.email} is within the user population and can access data from the following tenants:
                <br/> Access granted as local population :
                    <Link to={{
                        pathname: '/content/',
                        state: { bearer: this.state.user.id + '.' + this.state.homeTenant.id}
                    }}>
                        <span>{this.state.homeTenant.name}</span>
                    </Link>

                </span>
                <TenantList dataList={this.state.remoteTenants} user={this.state.user.id}/>
            </React.Fragment>
        )
    }

    componentDidMount() {
        fetch(url + this.props.match.params.id, {
            Method : 'GET'
        }).then((res)  => res.json())
            .then((data) => {
                this.setState({
                    user:data,
                    homeTenant: data.home_tenant,
                    remoteTenants: data.remote_tenants
                })
            })
    }

}

export  default  UserDetail;
