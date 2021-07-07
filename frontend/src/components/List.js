import React from 'react';
const List = (props) => {
    const { users } = props;
    if (!users || users.length === 0) return <p>No users, sorry</p>;
    return (
        <ul>
            <h2 className='list-head'>Available Users</h2>
            {users.map((user) => {
                return (
                    <li key={user.id} className='list'>
                        <span className='repo-text'>{user.email} </span>
                        <span className='repo-description'>{user.employer}</span>
                    </li>
                );
            })}
        </ul>
    );
};
export default List;
