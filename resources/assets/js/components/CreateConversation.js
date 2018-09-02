import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class CreateConversation extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render(){
        return <div className="btn btn-primary btn-block" onClick={this.props.create}>
            <i className="fa fa-comments"></i> Create New Conversation
        </div>;
    }
}

export default CreateConversation;