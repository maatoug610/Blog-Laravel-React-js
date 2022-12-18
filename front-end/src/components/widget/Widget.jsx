import React, { Component } from 'react';
import './widget.scss';
import KeyboardDoubleArrowUpIcon from '@mui/icons-material/KeyboardDoubleArrowUp';
import PersonIcon from '@mui/icons-material/Person';
const Widget = ({title,counter,percentage}) => {

        return (
            <div className='widget'>
                <div className="left">
                    <span className='title'>{title}</span>
                    <span className='counter'>{counter}$</span>
                    <span className='link'>See all users</span>
                </div>
                <div className="right">
                    <div className="percentage positive">
                        <KeyboardDoubleArrowUpIcon />
                        {percentage}%
                    </div>
                    <PersonIcon className="icon"/>
                </div>
            </div>
        );
    
}
 
export default Widget;