import React, { PureComponent } from 'react';

class PureComp extends PureComponent{
    render(){
        console.log("this is pure component console");
        return(
            <div>
                <h2>This is Pure Component { this.props.name }</h2>
            </div>
        )
    }
}

export default PureComp;