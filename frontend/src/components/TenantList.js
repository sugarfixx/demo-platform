import React from 'react';
import {Link} from 'react-router-dom';

const TenantList = (props) => {
    const renderList = ({dataList}) => {
        console.log(dataList);
        if (dataList && dataList.length > 0) {
            return dataList.map((item) => {
                return (
                    <li key={item.id}>
                        <Link to={`/content`}>
                            <span>{item.name}</span>
                        </Link>
                    </li>
                )
            })
        }
    }
    return (
        <div>
            <span>Other Tenants</span>
            <ul>
                { renderList(props) }
            </ul>
        </div>
    )
}

export default TenantList;
