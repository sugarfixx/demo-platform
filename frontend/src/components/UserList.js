import React from 'react';
import {Link} from 'react-router-dom';

const UserList = (props) => {

    const renderList = ({dataList}) => {
        // console.log(dataList);
        if (dataList) {
            return dataList.map((item) => {
                return (
                    <li key={item.id}>
                        <Link to={`/user/${item.id}`}>
                            <span>{item.email}</span>
                        </Link>
                    </li>
                )
            })
        }
    }
    return (
        <div>
            <ul>
                { renderList(props) }
            </ul>

        </div>
    )
}

export default UserList;
