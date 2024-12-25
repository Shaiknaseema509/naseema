import React, { Component } from 'react';

class RegComp extends Component{
    render(){
        console.log("this is Regular component console");
        return(
            <div>
                <h2>This is Regular Component { this.props.name }</h2>
            </div>
        )
    }
}

export default RegComp;