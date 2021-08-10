import React from 'react';

const ContentList = (props) => {

    const renderList = ({dataList}) => {
        console.log(dataList);
        if (dataList) {
            return dataList.map((content) => {
                return (
                    <li key={content.id}>
                        <div>
                            <img src={content.image_url} alt={content.name}/>
                            <br />
                            {content.name}
                            <br/>
                            {content.commands}
                        </div>

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
