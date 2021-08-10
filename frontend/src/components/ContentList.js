import React from 'react';
import {Link} from 'react-router-dom';

const ContentList = (props) => {
    const renderList = ({dataList}) => {
        if (dataList && dataList.length > 0) {
            return dataList.map((item) => {
                return (
                    <li key={item.id}>
                        <span>{item.name}</span>
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

export default ContentList;
