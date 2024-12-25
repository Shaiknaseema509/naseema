import React, { Component } from 'react';
import PureComp from './PureComp';
import RegComp from './RegComp';

class parentComp extends Component {

    constructor(props){
        super(props)

        this.state = {
            name:"Srikanth"
        }
    }

    componentDidMount(){
        setInterval(() => {
            this.setState({
                name:"srikanth" 
            })
        }, 2000);
    }
    render(){
        console.log("this is Parent component console---------------------------");
        return(
            <div>
                <PureComp name={this.state.name} />
                <RegComp name={this.state.name}/>
            </div>
        )
    }
}

export default parentComp;