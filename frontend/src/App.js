import React, { useEffect, useState } from 'react';
import './App.css';
import List from './components/List';
import withListLoading from './components/withListLoading';
function App() {
    const ListLoading = withListLoading(List);
    const [appState, setAppState] = useState({
        loading: false,
        users: null,
    });

    useEffect(() => {
        setAppState({ loading: true });
        const apiUrl = `http://beffe.test/api/resources/user`;
        fetch(apiUrl)
            .then((res) => res.json())
            .then((users) => {
                setAppState({ loading: false, users: users });
            });
    }, [setAppState]);
    return (
        <div className='App'>
            <div className='container'>
                <h1>App Users</h1>
            </div>
            <div className='repo-container'>
                <ListLoading isLoading={appState.loading} users={appState.users} />
            </div>
            <footer>
                <div className='footer'>
                    Built{' '}
                    <span role='img' aria-label='love'>
            💚
          </span>{' '}
                    with by Shedrack Akintayo
                </div>
            </footer>
        </div>
    );
}
export default App;
