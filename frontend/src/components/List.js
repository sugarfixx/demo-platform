import React from 'react';
import {useParams, Link} from 'react-router-dom';
const List = (props) => {
    const { users } = props;
    if (!users || users.length === 0) return <p>No users, sorry</p>;
    return (
        <ul>
            <h2 className='list-head'>Available Users</h2>
            {users.map((user) => {
                return (
                    <li key={user.id} className='list'>
                        <Link to={`/user/${user.id}`}>
                            <span className='repo-text'>{user.email} </span>
                        </Link>
                    </li>
                );
            })}
        </ul>
    );
};
export default List;
