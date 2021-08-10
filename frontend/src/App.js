import React, { Component } from 'react';
import { BrowserRouter as Router, Switch, Route, Link } from 'react-router-dom';
import Tenant from './components/Tenant';
import ContentScreen from './components/ContentScreen';
import UserScreen from './components/UserScreen';
import UserDetail from './components/UserDetail';
import './App.css';

class App extends Component  {
    render() {
        return (
            <Router>
                <div className="container">
                    <nav className="navbar navbar-expand-lg navbar-light bg-light">
                        <ul className="navbar-nav mr-auto">
                            <li><Link to={'/'} className="nav-link"> Home </Link></li>
                        </ul>
                    </nav>
                    <hr />
                    <Switch>
                        <Route exact path='/' component={UserScreen} />
                        <Route path="/user/:id" component={UserDetail}/>
                        <Route path='/tenant' component={Tenant} />
                        <Route path='/content' component={ContentScreen} />
                    </Switch>
                </div>
            </Router>
        )
    }
}
export default App;
