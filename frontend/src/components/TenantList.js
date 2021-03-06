import React from 'react';
import {Link} from 'react-router-dom';

const TenantList = (props) => {
    const renderList = ({dataList, user}) => {
        if (dataList && dataList.length > 0) {
            return dataList.map((item) => {
                return (
                    <li key={item.id}>
                        <Link to={{
                            pathname: '/content/',
                            state: { bearer: user + '.' + item.id}
                            }
                        }>
                            <span>{item.name}</span>
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

export default TenantList;
